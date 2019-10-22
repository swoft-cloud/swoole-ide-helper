<?php declare(strict_types=1);

namespace IDEHelper;

use Reflection;
use ReflectionClass;
use ReflectionException;
use ReflectionExtension;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use ReflectionParameter;
use ReflectionProperty;
use RuntimeException;
use function strpos;
use Swoole\Coroutine;
use Swoole\Coroutine\Channel;

/**
 * Class ExtDocsGenerator
 *
 * ExtensionDocument, ExtDocsGenerator
 * ExtDocDumper, ExtDocExporter
 * ExtStubExporter
 *
 * @noinspection AutoloadingIssuesInspection
 */
class ExtStubExporter
{
    public const SPACE4 = '    ';

    public const FUNC_PREFIX = 'Func:';

    /**
     * @var string
     */
    public $lang = 'zh-CN';

    /**
     * @var string
     */
    public $outDir;

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $extName;

    /**
     * @var ReflectionExtension
     */
    private $rftExt;

    /**
     * @var array
     */
    private $config = [];

    /**
     * @var array
     */
    private $stats = [
        'class'    => 0,
        'method'   => 0,
        'function' => 0,
        'constant' => 0,
    ];

    /**
     * @var array Short alias class.
     */
    private $shortAliases = [];

    /**
     * @param string $lang
     *
     * @return self
     */
    public static function create(string $lang = 'en'): self
    {
        return new static($lang);
    }

    /**
     * Class constructor
     *
     * @param string $lang
     */
    public function __construct(string $lang = 'en')
    {
        $this->lang    = $lang ?: 'en';
        $this->extName = 'swoole';
    }

    /**
     * @param string $outDir
     * @throws ReflectionException
     */
    public function export(string $outDir = ''): void
    {
        $this->println('Generate IDE Helper Classes For Swoole Extension');

        $this->prepare();
        $this->doExport($outDir);

        $this->config = [];
        $this->rftExt = null;

        $this->println("\nStats Information:\n" . json_encode($this->stats, JSON_PRETTY_PRINT));
        $this->println('Export Successful :)');
    }

    /**
     * @throws ReflectionException
     */
    private function prepare(): void
    {
        if (!extension_loaded($this->extName)) {
            throw new RuntimeException("no '{$this->extName}' extension.");
        }

        $this->rftExt  = new ReflectionExtension($this->extName);
        $this->version = $this->rftExt->getVersion();

        $this->println('> Swoole Version: v' . $this->version . "\n");

        // load config data
        $confFile = dirname(__DIR__) . "/config/{$this->lang}.meta.php";
        if (file_exists($confFile)) {
            /** @noinspection PhpIncludeInspection */
            $this->config = require $confFile;
            $this->println(" - Load config data(lang:{$this->lang})");
        }
    }

    /**
     * @param string $outDir
     * @throws ReflectionException
     */
    public function doExport(string $outDir = ''): void
    {
        $this->outDir = $outDir = $outDir ?: dirname(__DIR__) . '/output';
        if (file_exists($outDir)) {
            $this->println(' - Clear old files ...');
            exec("rm -rf {$outDir}");
        }

        // create output directory
        $this->createDir($outDir);
        $this->println(' - Parse and export constants');

        // Get all the global constants
        $defines = $this->getGlobalConstants();
        $this->writePhpFile($outDir . '/constants.php', $defines);
        $this->println(' - Parse and export functions');

        // Get all functions defines
        $funcCodes = $this->getFunctionsDef();
        $this->writePhpFile($outDir . '/functions.php', $funcCodes);

        // Get all classes defines
        $this->println(' - Parse and export classes');
        $classes  = '';
        $aliasTpl = "\nclass %s extends %s{}\n";

        /**
         * @var string          $className
         * @var ReflectionClass $ref
         */
        foreach ($this->rftExt->getClasses() + SwooleLibrary::loadLibClass() as $className => $ref) {
            // 短命名别名
            if (stripos($className, 'co\\') === 0) {
                $this->exportShortAlias($className);
                // 标准命名空间的类名，如 Swoole\Server
            } elseif (false !== strpos($className, '\\')) {
                $this->exportNamespaceClass($className, $ref);
                // 下划线分割类别名
            } else {
                $classes .= sprintf($aliasTpl, $className, self::getNamespaceAlias($className));
            }
        }

        $this->writePhpFile($outDir . '/classes.php', $classes);

        $shortAliases  = '';
        $shortClassTpl = "namespace %s\n{\n%s\n}\n\n";
        foreach ($this->shortAliases as $np => $aliases) {
            $shortAliases .= sprintf($shortClassTpl, $np, implode("\n", $aliases));
        }

        $this->writePhpFile($outDir . '/aliases.php', $shortAliases);
    }

    /**
     * @param string $className
     */
    public function exportShortAlias(string $className): void
    {
        $ns = explode('\\', $className);
        foreach ($ns as $k => $n) {
            $ns[$k] = ucfirst($n);
        }

        $namespace   = implode('\\', array_slice($ns, 0, count($ns) - 1));
        $parentClass = str_replace('Co\\', 'Swoole\\Coroutine\\', ucwords($className, "\\"));

        // $classTpl = "namespace %s \n{\n" . self::SPACE5 . "class %s extends \%s {}\n}\n";
        $classTpl = self::SPACE4 . "class %s extends \%s{}";
        $content  = sprintf($classTpl, end($ns), $parentClass);

        $this->shortAliases[$namespace][] = $content;
    }

    public static function getNamespaceAlias(string $className)
    {
        $lowerName = strtolower($className);
        if ($lowerName === 'co') {
            return Coroutine::class;
        }

        if ($lowerName === 'chan') {
            return Channel::class;
        }

        if ($lowerName === 'swoole_websocket_closeframe') {
            return 'Swoole\\Websocket\\CloseFrame';
        }

        return str_replace('_', '\\', ucwords($className, '_'));
    }

    /***************************************************************************
     * Parse Global Constants Definition
     **************************************************************************/

    /**
     * @return string
     */
    private function getGlobalConstants(): string
    {
        $defines = '';
        foreach ($this->rftExt->getConstants() as $name => $value) {
            if (!is_numeric($value)) {
                $value = "'$value'";
            }

            $this->stats['constant']++;
            $defines .= "define('$name', $value);\n";
        }

        return $defines;
    }

    /***************************************************************************
     * Parse Functions Definition
     **************************************************************************/

    /**
     * @return string
     * @throws ReflectionException
     */
    public function getFunctionsDef(): string
    {
        $all = [];

        /** @var $v ReflectionFunction */
        foreach ($this->rftExt->getFunctions() + SwooleLibrary::loadLibFun() as $function) {
            $this->stats['function']++;

            $comment = $this->exportFunctions($function) . "\n\n";

            if ($function->inNamespace()) {
                $ns       = $function->getNamespaceName();
                $all[$ns] = ($all[$ns] ?? '') . $comment;
            } else {
                $all['_'] = ($all['_'] ?? '') . $comment;
            }
        }

        $code = '';
        foreach ($all as $ns => $funcCode) {
            if ('_' === $ns) {
                continue;
            }
            $funcCode = preg_replace('/\n/m', "\n" . self::SPACE4, $funcCode);
            $code     .= "namespace {$ns} {\n\n    {$funcCode}\n}\n\n";
        }

        if (isset($all['_'])) {
            $code .= $all['_'];
        }

        return $code;
    }

    /**
     * @param string $annotate
     * @return array|null
     */
    public function parseAnnotate(string $annotate): ?array
    {
        $preg   = '/^(?<type>[\w\|\[\]\\\\]+)\s?(?:\((?<default>.+)\))?(?:\:(?<desc>[\S\s]+))?/m';
        $result = preg_match_all($preg, $annotate, $matches);
        if ($result) {
            return ['type' => $matches['type'][0], 'default' => $matches['default'][0], 'desc' => $matches['desc'][0]];
        };
        return null;
    }

    /**
     * @param string          $classname
     * @param ReflectionClass $rftClass
     *
     * @return string
     */
    public function getPropertyDef(string $classname, ReflectionClass $rftClass): string
    {
        $props = $rftClass->getProperties(
            ReflectionProperty::IS_PUBLIC |
            ReflectionProperty::IS_PROTECTED |
            ReflectionProperty::IS_STATIC
        );
        if (!$props) {
            return '';
        }

        $sp4        = self::SPACE4;
        $propString = '';

        $parentsClassNames = $this->getParentsClasss($rftClass);

        foreach ($props as $prop) {
            $class = $prop->getDeclaringClass();
            if ($parentsClassNames[$class->getName()] ?? false) {
                // 跳过父类属性
                continue;
            }
            $modifiers = implode(' ', Reflection::getModifierNames($prop->getModifiers()));
            /** @var string $annotate */
            $annotate = $this->config[$class->getName()]["\${$prop->getName()}"] ?? null;
            if ($annotate && $result = $this->parseAnnotate($annotate)) {
                $propString .= "{$sp4}/**\n";
                if (!empty($result['desc'])) {
                    $propString .= "{$sp4} * {$result['desc']}\n";
                }
                $propString .= "{$sp4} * @var {$result['type']}\n{$sp4} */\n";
            }
            $propString .= "{$sp4}{$modifiers} $" . $prop->name . ";\n";
        }

        if (!empty($propString)) {
            $propString = "{$sp4}// property of the class $classname\n{$propString}";
        }

        return $propString;
    }

    /**
     * @param string          $classname
     * @param ReflectionClass $rftClass
     * @return string
     */
    public function getConstantsDef(string $classname, ReflectionClass $rftClass): string
    {
        $consts = $rftClass->getReflectionConstants();
        if (!$consts) {
            return '';
        }

        $all = '';
        $sp4 = self::SPACE4;

        foreach ($consts as $k => $v) {
            if ($v->getModifiers() & ReflectionMethod::IS_PROTECTED
                || $v->getModifiers() & ReflectionMethod::IS_PRIVATE
            ) {
                continue;
            }
            $modifiers = implode(' ', Reflection::getModifierNames($v->getModifiers()));
            $all       .= "{$sp4}{$modifiers} const {$v->getName()} = ";
            $v         = var_export($v->getValue(), true);
            $all       .= "{$v};\n";
        }

        if (!empty($all)) {
            $all = "{$sp4}// constants of the class $classname\n{$all}";
        }


        return $all;
    }

    /**
     * @param ReflectionClass $rftClass
     *
     * @return string
     * @throws ReflectionException
     */
    public function getMethodsDef(ReflectionClass $rftClass): string
    {
        $methods = $rftClass->getMethods(
            ReflectionMethod::IS_PUBLIC |
            ReflectionMethod::IS_PROTECTED |
            ReflectionMethod::IS_STATIC |
            ReflectionMethod::IS_ABSTRACT |
            ReflectionMethod::IS_FINAL
        );

        $all               = [];
        $parentsClassNames = $this->getParentsClasss($rftClass);
        /**
         * @var string           $k The method name
         * @var ReflectionMethod $m
         */
        foreach ($methods as $k => $m) {
            if ($m->isFinal() || $m->isDestructor()) {
                continue;
            }
            if ($parentsClassNames[$m->getDeclaringClass()->getName()] ?? false) {
                continue;
            }
            $this->stats['method']++;
            $all[] = $this->exportFunctions($m);
        }

        return implode("\n\n", $all);
    }

    /**
     * @param ReflectionFunctionAbstract $func
     * @return string
     * @throws ReflectionException
     */
    public function exportFunctions(ReflectionFunctionAbstract $func): ?string
    {
        $isMethod = false;

        if ($func instanceof ReflectionMethod) {
            $isMethod = true;
            $sp4      = self::SPACE4;
            $class    = $func->getDeclaringClass();
            $funcName = $func->getName();
            /** @var array $config */
            $config = $this->config[$class->getName()][$func->getName()] ?? null;
        } elseif ($func instanceof ReflectionFunction) {
            $sp4      = '';
            $funcName = $func->inNamespace() ? $func->getShortName() : $func->getName();
            /** @var array $config */
            $config = $this->config[self::FUNC_PREFIX . $func->getName()] ?? null;
        } else {
            return null;
        }

        $fnArgs  = [];
        $comment = "$sp4/**\n";
        if ($config['desc'] ?? null) {
            $comment .= "$sp4 * {$config['desc']}\n";
        }

        if ($params = $func->getParameters()) {
            foreach ($params as $k1 => $p) {
                [$pName, $pType, $default, $desc] = $this->getParameter($p, $config);

                if (!empty($pType) && $pType !== '...') {
                    $pType .= ' ';
                }
                if (!empty($desc)) {
                    $desc = ' ' . $desc;
                }

                $comment .= sprintf('%s * @param %s$%s%s', $sp4, $pType, $pName, $desc ?: '') . "\n";
                if (trim($pType) === 'mixed' || false !== strpos($pType, '|')) {
                    $pType = '';
                }

                if (is_string($default) || is_numeric($default)) {
                    $fnArgs[] = sprintf('%s$%s = %s', $pType, $pName, $default);
                } else {
                    $fnArgs[] = sprintf('%s$%s', $pType, $pName);
                }
            }
        }

        $returnType = $this->getReturnType($func, $config);
        if ($returnType) {
            if ($annotate = $this->parseAnnotate($returnType)) {
                $returnType = $annotate['type'] ?: 'mixed';
                if (!empty($annotate['desc'])) {
                    $returnDesc = ' ' . $annotate['desc'];
                }
            }
            $returnType = $this->paddingNsRoot($returnType);
            $comment .= sprintf("%s * @return %s%s\n", $sp4, $returnType, $returnDesc ?? '');
        }
        if (!empty($returnType)
            && $returnType !== 'mixed'
            && false === strpos($returnType, '|')
            && false === strpos($returnType, '[]')
        ) {
            $returnStr = ": {$returnType}";
        }

        $comment .= "$sp4 */\n";
        if ($isMethod) {
            $modifiers = implode(' ', Reflection::getModifierNames($func->getModifiers()));
        } else {
            $modifiers = '';
        }
        if (!empty($modifiers)) {
            $modifiers .= ' ';
        }

        $isReference = $func->returnsReference() ? '&' : '';
        $tpl = "{$sp4}%sfunction {$isReference}%s(%s)";
        $comment .= sprintf($tpl, $modifiers, $funcName, implode(', ', $fnArgs));
        $comment .= $returnStr ?? '';
        if ($isMethod) {
            $comment .= $func->isAbstract() ? ';' : '{}';
        } else {
            $comment .= '{}';
        }


        return $comment;
    }

    /**
     * @param string          $classname
     * @param ReflectionClass $ref
     * @throws ReflectionException
     */
    public function exportNamespaceClass(string $classname, $ref): void
    {
        $arr = explode('\\', $classname);
        if (strtolower($arr[0]) !== $this->extName) {
            return;
        }

        array_walk($arr, function (&$v) {
            $v = ucfirst($v);
        });

        $path = $this->outDir . '/namespace/' . implode('/', array_slice($arr, 1));

        // namespace
        $ns   = implode('\\', array_slice($arr, 0, -1));
        $dir  = dirname($path);
        $name = basename($path);

        $this->stats['class']++;
        // create dir
        $this->createDir($dir);

        $content = "namespace {$ns};\n\n" . $this->getClassDef($name, $ref);
        $this->writePhpFile($path . '.php', $content);
    }

    /**
     * @param string          $classname
     * @param ReflectionClass $rftClass
     *
     * @return string
     * @throws ReflectionException
     */
    public function getClassDef(string $classname, ReflectionClass $rftClass): string
    {
        // 获取属性定义
        $propString = $this->getPropertyDef($classname, $rftClass);

        // 获取常量定义
        $constString = $this->getConstantsDef($classname, $rftClass);

        // 获取方法定义
        $methodString = $this->getMethodsDef($rftClass);

        // build class line
        $classLine = $classname;

        // parent class
        if ($pClass = $rftClass->getParentClass()) {
            $classLine .= ' extends \\' . $pClass->name;
        }

        // interface classes
        if ($faceNames = $rftClass->getInterfaceNames()) {
            $ignoreInterfaces = [];
            foreach ($faceNames as $faceName) {
                try {
                    $ifRef = new ReflectionClass($faceName);
                } catch (ReflectionException $e) {
                    continue;
                }

                foreach ($faceNames as $subi => $subFaceName) {
                    if ($ifRef->isSubclassOf($subFaceName)) {
                        $ignoreInterfaces[] = $subFaceName;
                    }
                }
            }

            $faceNames = array_filter($faceNames, function ($name) use ($ignoreInterfaces) {
                return !in_array($name, $ignoreInterfaces, true);
            });

            $classLine .= ' implements \\' . implode(', \\', $faceNames);
        }

        $version  = $this->version;
        $modifier = 'class';
        if ($rftClass->isInterface()) {
            $modifier = 'interface';
        } elseif ($rftClass->isAbstract()) {
            $modifier = 'abstract class';
        }

        $classBody = <<<PHP
/**
 * @since $version
 */
$modifier $classLine
{
$constString
$propString
$methodString
}
PHP;
        return $classBody;
    }

    /***************************************************************************
     * Build function,method's comments
     * - description
     * - params
     * - return
     **************************************************************************/

    /**
     * @param ReflectionClass $rftClass
     * @return string[]
     */
    public function getParentsClasss(ReflectionClass $rftClass): array
    {
        $parentsClassNames = [];
        $parentsClass      = $rftClass->getParentClass();
        do {
            if ($parentsClass) {
                $parentsClassNames[$parentsClass->getName()] = true;

            } else {
                break;
            }
        } while ($parentsClass = $parentsClass->getParentClass());
        return $parentsClassNames;
    }

    /**
     * @param string $type
     * @return string
     */
    private function paddingNsRoot(string $type)
    {
        if (strpos($type, '|') > 0) {
            $types = explode('|', $type);
            $types = array_map([$this, 'paddingNsRoot'], $types);
            return implode('|', $types);
        }
        // is class
        $pos = strpos($type, '\\');
        if ($pos > 0 || (0 !== $pos && class_exists($type))) {
            $type = '\\' . $type;
        }
        return $type;
    }

    /**
     * @param ReflectionParameter $p
     * @param array|null          $config
     * @return array
     * @throws ReflectionException
     */
    private function getParameter(ReflectionParameter $p, ?array $config = null): array
    {
        $pName = $p->getName();

        /** @var string $pAnnotate */
        $pAnnotate = $config ? ($config["\${$p->getName()}"] ?? null) : null;

        if ($pAnnotate && $annotate = $this->parseAnnotate($pAnnotate)) {
            $pType       = $annotate['type'];
            $pDefaultVal = $annotate['default'] ?: null;
            $desc        = $annotate['desc'] ?: null;

        } elseif ($p->isVariadic()) {
            $pType = '...';
        } elseif ($pt = $p->getType()) {
            $name = $pt->getName();
            $name = TypeMeta::$classMapping[$name] ?? $name;
            $pType = $name;
        } else {
            $pType = $this->getParameterType($pName);
        }

        // is class
        $pType = $this->paddingNsRoot($pType);

        if ((!$p->isVariadic() && $p->isOptional()) || isset($pDefaultVal)) {
            $pDefaultVal = $this->getParameterDefaultValue($p, $pDefaultVal ?? null);
        }

        return [$pName, $pType, $pDefaultVal ?? null, $desc ?? null];
    }

    /**
     * @param $name
     * @return string
     */
    public function getParameterType($name): string
    {
        if (in_array($name, TypeMeta::INT, true)) {
            return 'int';
        }

        if (in_array($name, TypeMeta::STRING, true)) {
            return 'string';
        }

        if (in_array($name, TypeMeta::FLOAT, true)) {
            return 'float';
        }

        if (in_array($name, TypeMeta::BOOL, true)) {
            return 'bool';
        }

        if (in_array($name, TypeMeta::ARRAY, true)) {
            return 'array';
        }

        if (in_array($name, TypeMeta::MIXED, true)) {
            return 'mixed';
        }

        return '';
    }

    /**
     * 获取默认值
     * @param ReflectionParameter $parameter
     * @param null                $default
     * @return string|int
     * @throws ReflectionException
     */
    public function getParameterDefaultValue(ReflectionParameter $parameter, $default = null)
    {
        if ($parameter->isDefaultValueAvailable() && $parameter->isDefaultValueConstant()) {
            $defaultValue = $parameter->getDefaultValueConstantName();
            while (!defined($defaultValue)) {
                $pos = strpos($defaultValue, '\\');
                if (false !== $pos) {
                    $defaultValue = substr($defaultValue, $pos + 1);
                } else {
                    $defaultValue = null;
                    break;
                }
            }
            if (null !== $defaultValue) {
                return $defaultValue;
            }
        } elseif ($parameter->isDefaultValueAvailable()) {
            $defaultValue = $parameter->getDefaultValue();
        } else {
            $defaultValue = $default;
        }

        if ([] === $defaultValue) {
            $defaultValue = '[]';
        } elseif ($defaultValue === null) {
            $defaultValue = 'null';
        } elseif (is_bool($defaultValue)) {
            $defaultValue = $defaultValue ? 'true' : 'false';
        } elseif (is_string($defaultValue) && defined($defaultValue)) {
        } elseif (is_numeric($defaultValue)) {
        } else {
            // 使用 symfony/var-dumper 可以更好的渲染值
            $defaultValue = var_export($defaultValue, true);
        }
        return $defaultValue;
    }

    /**
     * @param ReflectionFunctionAbstract $function
     * @param array|null                 $config
     * @return string
     */
    private function getReturnType(ReflectionFunctionAbstract $function, ?array $config): ?string
    {
        if (!$function->hasReturnType()) {
            if ($config && ($config['return'] ?? null)) {
                return $config['return'];
            }
            return 'mixed';
        }
        $returnType = $function->getReturnType();
        if (!$returnType->isBuiltin() && strpos((string) $returnType, '\\') > 0) {
            $return = '\\' . (string) $returnType;
        } else {
            $return = (string) $returnType;
        }
        return ($returnType->allowsNull() ? '?' : '') . $return;
    }

    /***************************************************************************
     * Helper methods
     **************************************************************************/

    /**
     * 支持层级目录的创建
     *
     * @param string     $path
     * @param int|string $mode
     * @param bool       $recursive
     *
     * @return bool
     */
    public function createDir(string $path, int $mode = 0775, bool $recursive = true): bool
    {
        return (is_dir($path) || !(!@mkdir($path, $mode, $recursive) && !is_dir($path))) && is_writable($path);
    }

    /**
     * @param string $filepath
     * @param string $content
     */
    private function writePhpFile(string $filepath, string $content): void
    {
        $phpText = "<?php /** @noinspection ALL - For disable PhpStorm check */\n\n{$content}";
        file_put_contents($filepath, $phpText);
    }

    /**
     * @param mixed ...$args The args allow int, string
     */
    private function println(...$args): void
    {
        echo implode(' ', $args), "\n";
    }
}
