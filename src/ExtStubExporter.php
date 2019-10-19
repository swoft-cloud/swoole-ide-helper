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
use Throwable;

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
    public const METHOD   = 1;
    public const PROPERTY = 2;
    public const CONSTANT = 3;

    public const SPACE4 = '    ';
    public const SPACE5 = '     ';

    public const FUNC_PREFIX  = 'Func:';
    public const PHP_KEYWORDS = [
        // 'exit',
        'die',
        'echo',
        'class',
        'interface',
        'function',
        'public',
        'protected',
        'private',
    ];

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
     * [
     *  'Server:send' => [
     *      'desc' => '',
     *      'var0' => 'int Description',
     *      'var1' => 'string Description',
     *  ],
     * ]
     *
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
     * @param string $word
     *
     * @return bool
     */
    public static function isPHPKeyword(string $word): bool
    {
        return in_array($word, self::PHP_KEYWORDS, true);
    }

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
     */
    public function export(string $outDir = ''): void
    {
        $this->println('Generate IDE Helper Classes For Swoole Extension');

        try {
            $this->prepare();
            $this->doExport($outDir);

            $this->config = [];
            $this->rftExt = null;

            $this->println("\nStats Information:\n" . json_encode($this->stats, JSON_PRETTY_PRINT));
            $this->println('Export Successful :)');
        } catch (Throwable $e) {
            $this->println("\nExport Failure!\nException:", $e->getMessage());
        }
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

            $inNamespace = $function->inNamespace();
            $name = $inNamespace ? $function->getShortName() : $function->getName();
            $fnArgs  = [];
            $comment = "/**\n";
            $comment .= $this->getDescription($name, true);
            if ($params = $function->getParameters()) {
                foreach ($params as $k1 => $p) {
                    [$pName, $pType, $default] = $this->getParameter($function, $p);

                    if (!empty($pType) && $pType !== '...') {
                        $pType .= ' ';
                    }

                    $comment .= sprintf(' * @param %s$%s', $pType, $pName) . "\n";
                    $canType = $pType && $pType !== 'mixed ';

                    if (is_string($default)) {
                        $fnArgs[] = sprintf('%s$%s = %s', $canType ? $pType : '', $pName, $default);
                    } else {
                        $fnArgs[] = sprintf('%s$%s', $canType ? $pType : '', $pName);
                    }
                }
            }

            $returnType = $this->getReturnType($function);
            if ($returnType) {
                if ($returnType === 'mixed') {
                    $return = '';
                    $comment .= " * @return mixed\n";
                } else {
                    // $return = ": {$returnType}";
                    $comment .= " * @return {$returnType}\n";
                }
            }

            $comment .= " */\n";
            $comment .= sprintf("function %s(%s)%s{}\n\n", $name, implode(', ', $fnArgs), $return ?? '');

            if ($inNamespace) {
                $ns = $function->getNamespaceName();
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
            $code .= "namespace {$ns} {\n\n    {$funcCode}\n}\n\n";
        }

        if (isset($all['_'])) {
            $code .= $all['_'];
        }

        return $code;
    }

    /***************************************************************************
     * Parse Class
     * - Property Definition
     **************************************************************************/

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

        $propString = self::SPACE4 . "// property of the class $classname\n";

        $parentsClassNames = $this->getParentsClasss($rftClass);

        foreach ($props as $k => $prop) {
            if ($parentsClassNames[$prop->getDeclaringClass()->getName()] ?? false) {
                continue;
            }
            $modifiers  = implode(' ', Reflection::getModifierNames($prop->getModifiers()));
            $propString .= self::SPACE4 . "{$modifiers} $" . $prop->name . ";\n";
        }

        return $propString;
    }

    /***************************************************************************
     * Parse Class
     * - Constant Definition
     **************************************************************************/

    /**
     * @param string $classname
     * @param array  $consts
     *
     * @return string
     */
    public function getConstantsDef(string $classname, array $consts): string
    {
        if (!$consts) {
            return '';
        }

        $all = self::SPACE4 . "// constants of the class $classname\n";
        $sp4 = self::SPACE4;

        foreach ($consts as $k => $v) {
            $all .= "{$sp4}public const {$k} = ";
            $v = var_export($v, true);
            $all .= "{$v};\n";
        }

        return $all;
    }

    /***************************************************************************
     * Parse Class
     * - Method Definition
     **************************************************************************/

    /**
     * @param string          $classname
     * @param ReflectionClass $rftClass
     *
     * @return string
     * @throws ReflectionException
     */
    public function getMethodsDef(string $classname, ReflectionClass $rftClass): string
    {
        $methods = $rftClass->getMethods(
            ReflectionMethod::IS_PUBLIC |
            ReflectionMethod::IS_PROTECTED |
            ReflectionMethod::IS_STATIC |
            ReflectionMethod::IS_ABSTRACT |
            ReflectionMethod::IS_FINAL
        );

        // var_dump("getMethodsDef: " . $classname);
        $all = [];
        $sp4 = self::SPACE4;
        $tpl = "$sp4%s function %s(%s)";

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
            $methodName = $m->name;
            if (self::isPHPKeyword($methodName)) {
                $methodName = '_' . $methodName;
            }

            $fnArgs = [];

            $comment = "$sp4/**\n";
            $comment .= $this->getDescription("{$classname}:$methodName");

            if ($params = $m->getParameters()) {
                foreach ($params as $k1 => $p) {
                    [$pName, $pType, $default] = $this->getParameter($m, $p);

                    if (!empty($pType) && $pType !== '...') {
                        $pType .= ' ';
                    }

                    $comment .= sprintf('%s * @param %s$%s', $sp4, $pType, $pName) . "\n";
                    $canType = $pType && $pType !== 'mixed ';

                    if (is_string($default)) {
                        $fnArgs[] = sprintf('%s$%s = %s', $canType ? $pType : '', $pName, $default);
                    } else {
                        $fnArgs[] = sprintf('%s$%s', $canType ? $pType : '', $pName);
                    }
                }
            }

            $returnType = $this->getReturnType($m);
            if ($returnType) {
                if ($returnType === 'mixed') {
                    $return = '';
                    $comment .= self::SPACE5 . "* @return mixed\n";
                } else {
                    // $return = ": {$returnType}";
                    $comment .= self::SPACE5 . "* @return {$returnType}\n";
                }
            }

            $comment   .= "$sp4 */\n";
            $modifiers = implode(' ', Reflection::getModifierNames($m->getModifiers()));
            $comment   .= sprintf($tpl, $modifiers, $methodName, implode(', ', $fnArgs));
            $comment   .= $return ?? '';
            $comment   .= $m->isAbstract() ? ';' : '{}';

            $all[] = $comment;
        }

        return implode("\n\n", $all);
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

        // var_dump($classname . '-'. $name);
        $this->stats['class']++;
        // create dir
        $this->createDir($dir);
        // var_dump($classname);

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
        $constString = $this->getConstantsDef($classname, $rftClass->getConstants());

        // 获取方法定义
        $methodString = $this->getMethodsDef($classname, $rftClass);

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
        $parentsClass = $rftClass->getParentClass();
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
     * @param ReflectionFunctionAbstract $function
     * @return string
     */
    public function getFunPathName(ReflectionFunctionAbstract $function): ?string
    {
        if ($function instanceof ReflectionFunction) {
            $inNamespace = $function->inNamespace();
            $name = $inNamespace ? $function->getShortName() : $function->getName();
        } elseif ($function instanceof ReflectionMethod) {
            $name = $function->getDeclaringClass()->getName() . '::' . $function->getName();
        }
        return $name ?? null;
    }

    /**
     * @param ReflectionFunctionAbstract $fun
     * @param ReflectionParameter        $p
     * @return array
     * @throws ReflectionException
     */
    private function getParameter(ReflectionFunctionAbstract $fun, ReflectionParameter $p): array
    {
        $pName = $p->getName();
        $mthKey = $this->getFunPathName($fun);

        if ($p->isVariadic()) {
            $pType = '...';
        } elseif ($pt = $p->getType()) {
            $name = $pt->getName();
            $name = TypeMeta::$classMapping[$name] ?? $name;
            // is class
            if (strpos($name, '\\') > 0) {
                $name = '\\' . $name;
            }
            $pType = $name;
        } elseif ($mthKey && isset(TypeMeta::$special[$mthKey][$pName])) {
            $special = TypeMeta::$special[$mthKey][$pName];
            if (is_array($special)) {
                $pType = $special[0];
                $pDefaultVal = $special[1];
            } else {
                $pType = TypeMeta::$special[$mthKey][$pName];
            }
        } else {
            $pType = $this->getParameterType($pName);
        }
        if (!$p->isVariadic() && $p->isOptional()) {
            $pDefaultVal = $this->getParameterDefaultValue($p, $pDefaultVal ?? null);
        }

        return [$pName, $pType, $pDefaultVal ?? null];
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
     * @return string
     * @throws ReflectionException
     */
    public function getParameterDefaultValue(ReflectionParameter $parameter, $default = null): string
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
        } else {
            // 使用 symfony/var-dumper 可以更好的渲染值
            $defaultValue = var_export($defaultValue, true);
        }
        return $defaultValue;
    }

    /**
     * @param string $key
     * @param bool   $isFunc
     *
     * @return string
     */
    private function getDescription(string $key, bool $isFunc = false): string
    {
        $desc = '';
        if ($isFunc) {
            $key = self::FUNC_PREFIX . $key;
        }

        if (isset($this->config[$key]['_desc'])) {
            $str  = $this->config[$key]['_desc'];
            $desc = self::formatComment(ucfirst($str), $isFunc);
        }

        return $desc;
    }

    /**
     * @param ReflectionFunctionAbstract $function
     * @return string
     */
    private function getReturnType(ReflectionFunctionAbstract $function): ?string
    {
        if (!$function->hasReturnType()) {
            if ($function instanceof ReflectionFunction) {
                $pathKey = self::FUNC_PREFIX . $this->getFunPathName($function);
            } else {
                $pathKey = $this->getFunPathName($function);
            }
            return TypeMeta::$returnTypes[$pathKey] ?? 'mixed';
        }
        $returnType = $function->getReturnType();
        if (!$returnType->isBuiltin() && strpos((string) $returnType, '\\') > 0) {
            $return = '\\' . (string) $returnType;
        } else {
            $return = (string) $returnType;
        }
        return ($returnType->allowsNull() ? '?' : '') . $return;
    }

    /**
     * @param string $comment
     * @param bool   $isFunc
     *
     * @return string
     */
    public static function formatComment(string $comment, bool $isFunc = false): string
    {
        if (!$comment = trim($comment)) {
            return '';
        }

        $indent = $isFunc ? ' ' : self::SPACE5;
        $lines  = explode("\n", $comment);

        foreach ($lines as &$li) {
            // $li = $indent . '* '. ltrim($li, '*');
            $li = $indent . '* ' . ltrim($li);
        }

        return implode("\n", $lines) . "\n";
    }

    /**
     * @param string $comment
     * @param bool   $isFunc
     *
     * @return string
     */
    public static function formatArgComment(string $comment, bool $isFunc = false): string
    {
        if (!$comment = trim($comment)) {
            return '';
        }

        // TODO ...
        return $comment;
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
        $phpText = <<<PHP
<?php /** @noinspection ALL - For disable PhpStorm check */

$content
PHP;

        file_put_contents($filepath, $phpText);
    }

    /**
     * @param mixed ...$args The args allow int, string
     */
    private function println(...$args): void
    {
        echo implode(' ', $args), "\n";
    }

    /**
     * @return array
     */
    public function getStats(): array
    {
        return $this->stats;
    }

    /**
     * @return string
     */
    public function getExtName(): string
    {
        return $this->extName;
    }
}
