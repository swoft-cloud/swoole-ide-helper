<?php

use Swoole\Coroutine;
use Swoole\Coroutine\Channel;

define('OUTPUT_DIR', __DIR__ . '/src');
define('CONFIG_DIR', __DIR__ . '/config');
define('LANGUAGE', 'chinese');

/**
 * Class ExtensionDocument - ExtDocsGenerator
 *
 * @noinspection AutoloadingIssuesInspection
 */
class ExtensionDocument
{
    public const EXTENSION_NAME = 'swoole';

    public const C_METHOD   = 1;
    public const C_PROPERTY = 2;
    public const C_CONSTANT = 3;

    public const SPACE5 = '     ';

    /**
     * @var string
     */
    public $outDir;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var ReflectionExtension
     */
    protected $rftExt;

    public static $phpKeywords = [
        // 'exit',
        'die',
        'echo',
        'class',
        'interface',
        'function',
        'public',
        'protected',
        'private'
    ];

    public static $intVars = [
        'port',
        'fd',
        'pid',
        'uid',
        'conn_fd',
        'offset',
        'worker_id',
        'dst_worker_id',
        'reactor_id',
        'timer_id',
        'length',
        'opcode',
        'len',
        'chunk_size',
        'size',
        'worker_num',
        'signal_no',
        'start_fd',
        'find_count',
        'ms',
        'cid',
        'limit',
        'exit_code',
    ];

    public static $floatVars = [
        'timeout'
    ];

    public static $boolVars = [
        'is_protected',
        'reset',
    ];

    public static $arrVars = [
        'settings',
        'read_array',
        'write_array',
        'error_array',
        'headers',
        'cookies',
        'params',
    ];

    public static $strVars = [
        'host',
        'event_name',
        'reason',
        'send_data',
        'filename',
        'message',
        'sql',
        'process_name',
        'content',
        'hostname',
        'domain_name',
        'command',
        'string',
        'path',
        'method',
        'name',
    ];

    protected static $mixedArgs = [
        'func',
        'callback'
    ];

    protected static $specialArgs = [
        // Server:sendMessage($message)
        'Server:sendMessage' => [
            'message' => 'mixed'
        ]
    ];

    public static function isPHPKeyword(string $word): bool
    {
        return in_array($word, self::$phpKeywords, true);
    }

    public static function formatComment(string $comment): string
    {
        $lines = explode("\n", $comment);

        foreach ($lines as &$li) {
            $li = ltrim($li);
            if (isset($li[0]) && $li[0] !== '*') {
                $li = self::SPACE5 . '*' . $li;
            } else {
                $li = self::SPACE5 . $li;
            }
        }

        return implode("\n", $lines) . "\n";
    }

    public function exportShortAlias(string $className): void
    {
        if (stripos($className, 'co') !== 0) {
            return;
        }

        $ns = explode('\\', $className);
        foreach ($ns as $k => $n) {
            $ns[$k] = ucfirst($n);
        }

        $path = OUTPUT_DIR . '/alias/' . implode('/', array_slice($ns, 1)) . '.php';
        $this->createDir(dirname($path)); // create dir

        // Write to file
        file_put_contents($path, sprintf("<?php\nnamespace %s \n{\n" . self::SPACE5 . "class %s extends \%s {}\n}\n",
            implode('\\', array_slice($ns, 0, count($ns) - 1)), end($ns),
            str_replace('Co\\', 'Swoole\\Coroutine\\', ucwords($className, "\\"))));
    }

    public static function getNamespaceAlias($className)
    {
        $lowerName = strtolower($className);

        if ($lowerName === 'co') {
            return Coroutine::class;
        }

        if ($lowerName === 'chan') {
            return Channel::class;
        }

        if ($lowerName === 'swoole_websocket_close_frame') {
            return 'Swoole\\Websocket\\CloseFrame';
        }

        return str_replace('_', '\\', ucwords($className, '_'));
    }

    public function getConfig($class, $name, $type)
    {
        switch ($type) {
            case self::C_CONSTANT:
                $dir = 'constant';
                break;
            case self::C_METHOD:
                $dir = 'method';
                break;
            case self::C_PROPERTY:
                $dir = 'property';
                break;
            default:
                return false;
        }

        $file = CONFIG_DIR . '/' . LANGUAGE . '/' . strtolower($class) . '/' . $dir . '/' . $name . '.php';

        if (is_file($file)) {
            return include $file;
        }

        return [];
    }

    public function getFunctionsDef(array $funcs): string
    {
        $all = '';
        /** @var $v ReflectionFunction */
        foreach ($funcs as $name => $v) {
            $comment = '';
            $fnArgs  = [];

            if ($params = $v->getParameters()) {
                $comment = "/**\n";
                foreach ($params as $k1 => $v1) {
                    $pName = $v1->name;
                    $pType = $this->getParameterType($pName);

                    $comment .= sprintf(' * @param %s$%s', $pType, $pName);

                    if ($v1->isOptional()) {
                        $comment  .= " [optional]\n";
                        $fnArgs[] = sprintf('%s$%s = null', $pType, $pName);
                    } else {
                        $comment  .= " [required]\n";

                        if ($pType && $pType !== 'mixed') {
                            $fnArgs[] = $pType . '$' . $pName;
                        } else {
                            $fnArgs[] = '$' . $pName;
                        }
                    }
                }

                $comment .= " * @return mixed\n";
                $comment .= " */\n";
            }
            $comment .= sprintf("function %s(%s){}\n\n", $name, implode(', ', $fnArgs));
            $all     .= $comment;
        }

        return $all;
    }

    /**
     * @param       $classname
     * @param array $props
     *
     * @return string
     */
    public function getPropertyDef(string $classname, array $props): string
    {
        $propStr = '';
        $sp4     = str_repeat(' ', 4);

        /** @var $v ReflectionProperty */
        foreach ($props as $k => $v) {
            $modifiers = implode(' ', Reflection::getModifierNames($v->getModifiers()));
            $propStr   .= "$sp4{$modifiers} $" . $v->name . ";\n";
        }

        return $propStr;
    }

    /**
     * @param string $classname
     * @param array  $consts
     *
     * @return string
     */
    public function getConstantsDef(string $classname, array $consts): string
    {
        $all = '';
        $sp4 = str_repeat(' ', 4);
        foreach ($consts as $k => $v) {
            $all .= "{$sp4}const {$k} = ";
            if (is_int($v)) {
                $all .= "{$v};\n";
            } else {
                $all .= "'{$v}';\n";
            }
        }
        return $all;
    }

    /**
     * @param string $classname
     * @param array  $methods
     *
     * @return string
     */
    public function getMethodsDef(string $classname, array $methods): string
    {
        // var_dump("getMethodsDef: " . $classname);
        $all = '';
        $sp4 = str_repeat(' ', 4);

        /** @var $v ReflectionMethod */
        foreach ($methods as $k => $v) {
            if ($v->isFinal()) {
                continue;
            }

            $methodName = $v->name;
            $methodKey  = "{$classname}:$methodName";
            if (self::isPHPKeyword($methodName)) {
                $methodName = '_' . $methodName;
            }

            $arguments = [];
            $comment   = "$sp4/**\n";

            $config = $this->getConfig($classname, $methodName, self::C_METHOD);
            if (!empty($config['comment'])) {
                $comment .= self::formatComment($config['comment']);
            }

            $params = $v->getParameters();
            if ($params) {
                foreach ($params as $k1 => $v1) {
                    $pName = $v1->name;
                    $pType = $this->getParameterType($pName, $methodKey);

                    $comment .= sprintf('%s * @param %s$%s', $sp4, $pType, $pName);
                    $canType = $pType && $pType !== 'mixed ';

                    if ($v1->isOptional()) {
                        $comment     .= " [optional]\n";
                        $arguments[] = sprintf('%s$%s = null', ($canType ? $pType : ''), $pName);
                    } else {
                        $comment .= " [required]\n";
                        $arguments[] = ($canType ? $pType : '') . '$' . $pName;
                    }
                }
            }

            if (!isset($config['return'])) {
                $comment .= self::SPACE5 . "* @return mixed\n";
            } elseif (!empty($config['return'])) {
                $comment .= self::SPACE5 . "* @return {$config['return']}\n";
            }

            $comment   .= "$sp4 */\n";
            $modifiers = implode(' ', Reflection::getModifierNames($v->getModifiers()));
            $comment   .= sprintf("$sp4%s function %s(%s){}\n\n", $modifiers, $methodName, implode(', ', $arguments));

            $all .= $comment;
        }

        return $all;
    }

    /**
     * @param string          $classname
     * @param ReflectionClass $ref
     */
    public function exportNamespaceClass(string $classname, $ref): void
    {
        $ns = explode('\\', $classname);
        if (strtolower($ns[0]) !== self::EXTENSION_NAME) {
            return;
        }

        array_walk($ns, function (&$v) use (&$ns) {
            $v = ucfirst($v);
        });

        $path = OUTPUT_DIR . '/namespace/' . implode('/', array_slice($ns, 1));

        $namespace = implode('\\', array_slice($ns, 0, -1));

        $dir  = dirname($path);
        $name = basename($path);

        // var_dump($classname . '-'. $name);

        $this->createDir($dir); // create dir

        $content = "<?php\nnamespace {$namespace};\n\n" . $this->getClassDef($name, $ref);
        file_put_contents($path . '.php', $content);
    }

    /**
     * @param string          $classname
     * @param ReflectionClass $ref
     *
     * @return string
     */
    public function getClassDef(string $classname, $ref): string
    {
        //获取属性定义
        $props = $this->getPropertyDef($classname, $ref->getProperties());
        //获取常量定义
        $consts = $this->getConstantsDef($classname, $ref->getConstants());
        //获取方法定义
        $mdefs = $this->getMethodsDef($classname, $ref->getMethods());

        if ($ref->getParentClass()) {
            $classname .= ' extends \\' . $ref->getParentClass()->name;
        }

        $modifier = $ref->isInterface() ? 'interface' : 'class';
        $classDef = sprintf("/**\n * @since %s\n */\n%s %s\n{\n%s\n%s\n%s\n}\n", $this->version, $modifier, $classname,
            $consts, $props, $mdefs);
        return $classDef;
    }

    /**
     * @param string $name
     * @param string $mdKey method key
     *
     * @return string
     */
    private function getParameterType(string $name, string $mdKey = ''): string
    {
        if ($mdKey && isset(self::$specialArgs[$mdKey][$name])) {
            return self::$specialArgs[$mdKey][$name] . ' ';
        }

        if (in_array($name, self::$intVars, true)) {
            return 'int ';
        }

        if (in_array($name, self::$strVars, true)) {
            return 'string ';
        }

        if (in_array($name, self::$floatVars, true)) {
            return 'float ';
        }

        if (in_array($name, self::$boolVars, true)) {
            return 'bool ';
        }

        if (in_array($name, self::$arrVars, true)) {
            return 'array ';
        }

        if (in_array($name, self::$mixedArgs, true)) {
            return 'mixed ';
        }

        return '';
    }

    /**
     * 支持层级目录的创建
     *
     * @param            $path
     * @param int|string $mode
     * @param bool       $recursive
     *
     * @return bool
     */
    public function createDir($path, $mode = 0775, $recursive = true): bool
    {
        return (is_dir($path) || !(!@mkdir($path, $mode, $recursive) && !is_dir($path))) && is_writable($path);
    }

    /**
     * ExtensionDocument constructor.
     *
     * @param string $outDir
     *
     * @throws ReflectionException
     */
    public function __construct(string $outDir = '')
    {
        if (!extension_loaded(self::EXTENSION_NAME)) {
            throw new RuntimeException('no ' . self::EXTENSION_NAME . ' extension.');
        }

        $this->rftExt  = new ReflectionExtension(self::EXTENSION_NAME);
        $this->version = $this->rftExt->getVersion();
        $this->outDir  = $outDir ?: OUTPUT_DIR;
    }

    public function export(): void
    {
        echo " - Clear old by 'rm -rf src' \n";
        $srcDir = __DIR__ . '/src';
        exec("rm -rf $srcDir");

        // 获取所有define常量
        $consts  = $this->rftExt->getConstants();
        $defines = '';
        foreach ($consts as $className => $ref) {
            if (!is_numeric($ref)) {
                $ref = "'$ref'";
            }

            $defines .= "define('$className', $ref);\n";
        }

        $outDir = $this->outDir;
        $this->createDir($outDir); // create dir

        file_put_contents($outDir . '/constants.php', "<?php\n" . $defines);

        /**
         * 获取所有函数
         */
        $funcs = $this->rftExt->getFunctions();
        $fdefs = $this->getFunctionsDef($funcs);

        file_put_contents($outDir . '/functions.php', "<?php\n" . $fdefs);

        /**
         * 获取所有类
         */
        $classes    = $this->rftExt->getClasses();
        $classAlias = "<?php\n";

        /**
         * @var string          $className
         * @var ReflectionClass $ref
         */
        foreach ($classes as $className => $ref) {
            // 短命名别名
            if (stripos($className, 'co\\') === 0) {
                $this->exportShortAlias($className);
            } // 标准命名空间的类名，如 Swoole\Server
            elseif (false !== strpos($className, '\\')) {
                $this->exportNamespaceClass($className, $ref);
            } //下划线分割类别名
            else {
                $classAlias .= sprintf("\nclass %s extends %s\n{\n\n}\n", $className,
                    self::getNamespaceAlias($className));
            }
        }

        file_put_contents($outDir . '/classes.php', $classAlias);
    }
}

echo "Generate IDE Helper Classes For Swoole Ext\n\n";
echo 'Swoole Version: ' . swoole_version() . "\n";
try {
    (new ExtensionDocument())->export();
    echo " - Dump successful.\n";
} catch (Throwable $e) {
    echo " - Dump failure.\n error:", $e->getMessage();
}

