<?php

use Swoole\Coroutine;
use Swoole\Coroutine\Channel;

define('OUTPUT_DIR', __DIR__ . '/src');
define('CONFIG_DIR', __DIR__ . '/config');
define('LANGUAGE', 'chinese');

/**
 * Class ExtDocsGenerator - ExtensionDocument, ExtDocsGenerator
 *
 * @noinspection AutoloadingIssuesInspection
 */
class ExtDocsGenerator
{
    public const EXTENSION_NAME = 'swoole';

    public const C_METHOD   = 1;
    public const C_PROPERTY = 2;
    public const C_CONSTANT = 3;

    public const SPACE4 = '    ';
    public const SPACE5 = '     ';

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

    /**
     * @var array All int arguments name list
     */
    public static $intArgs = [
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
        'pipe_type',
        'server_socket',
        'ipc_type',
        'msgqueue_key',
        'backlog',
        'http_code',
    ];

    /**
     * @var array All float arguments name list
     */
    public static $floatArgs = [
        'timeout'
    ];

    /**
     * @var array All bool arguments name list
     */
    public static $boolArgs = [
        'is_protected',
        'reset',
        'blocking',
        'enable_coroutine',
        'redirect_stdin_and_stdout',
    ];

    /**
     * @var array All array arguments name list
     */
    public static $arrArgs = [
        'settings',
        'read_array',
        'write_array',
        'error_array',
        'headers',
        'cookies',
        'params',
        'options',
        'server_config',
    ];

    /**
     * @var array All string arguments name list
     */
    public static $strArgs = [
        'host',
        'domain',
        'address',
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
        'ip',
        'iterator_class',
        'username',
        'password',
        'pattern',
        'location',
    ];

    protected static $mixedArgs = [
        'data',
        'func',
        'callback',
        'read_callback',
        'write_callback',
        'finish_callback',
        'cmp_function',
    ];

    protected static $specialArgs = [
        // Server:sendMessage($message)
        'Server:sendMessage' => [
            'message' => 'mixed'
        ],
        'Server:addProcess'  => [
            'process' => '\\' . Swoole\Process::class
        ],
    ];

    protected static $returnTypes = [
        'Process:exportSocket' => '\\' . Swoole\Coroutine\Socket::class,
        'Channel:isEmpty'      => 'bool',
        'Channel:isFull'       => 'bool'
    ];

    /**
     * @var string
     */
    public $outDir;

    /**
     * @var string
     */
    private $version;

    /**
     * @var ReflectionExtension
     */
    private $rftExt;

    /**
     * @var array
     */
    private $stats = [
        'class'    => 0,
        'method'   => 0,
        'function' => 0,
        'constant' => 0,
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

        $path = $this->outDir . '/alias/' . implode('/', array_slice($ns, 1)) . '.php';
        $this->createDir(dirname($path)); // create dir

        // Write to file
        file_put_contents($path, sprintf("<?php\nnamespace %s \n{\n" . self::SPACE5 . "class %s extends \%s {}\n}\n",
            implode('\\', array_slice($ns, 0, count($ns) - 1)), end($ns),
            str_replace('Co\\', 'Swoole\\Coroutine\\', ucwords($className, "\\"))));
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

    public function getConfig(string $class, string $name, int $type)
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
            $this->stats['function']++;

            if ($params = $v->getParameters()) {
                $comment = "/**\n";
                foreach ($params as $k1 => $v1) {
                    $pName = $v1->name;
                    $pType = $this->getParameterType($pName);

                    $comment .= sprintf(' * @param %s$%s', $pType, $pName) . "\n";
                    $canType = $pType && $pType !== 'mixed ';

                    if ($v1->isOptional()) {
                        $fnArgs[] = sprintf('%s$%s = null', $canType ? $pType : '', $pName);
                    } else {
                        $fnArgs[] = ($canType ? $pType : '') . '$' . $pName;
                    }
                }

                $comment .= " * @return mixed\n";
                $comment .= " */\n";
            }
            $comment .= sprintf("function %s(%s){}\n\n", $name, implode(', ', $fnArgs));

            $all .= $comment;
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
        if (!$props) {
            return '';
        }

        $propStr = self::SPACE4 . "// property of the class $classname\n";

        /** @var $v ReflectionProperty */
        foreach ($props as $k => $v) {
            $modifiers = implode(' ', Reflection::getModifierNames($v->getModifiers()));
            $propStr   .= self::SPACE4 . "{$modifiers} $" . $v->name . ";\n";
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
        if (!$consts) {
            return '';
        }

        $all = self::SPACE4 . "// constants of the class $classname\n";
        $sp4 = self::SPACE4;

        foreach ($consts as $k => $v) {
            $all .= "{$sp4}public const {$k} = ";
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
        $all = [];
        $sp4 = self::SPACE4;
        $tpl = "$sp4%s function %s(%s){}";

        /** @var $v ReflectionMethod */
        foreach ($methods as $k => $v) {
            if ($v->isFinal()) {
                continue;
            }

            $this->stats['method']++;
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

                    $comment .= sprintf('%s * @param %s$%s', $sp4, $pType, $pName) . "\n";
                    $canType = $pType && $pType !== 'mixed ';

                    if ($v1->isOptional()) {
                        $arguments[] = sprintf('%s$%s = null', ($canType ? $pType : ''), $pName);
                    } else {
                        $arguments[] = ($canType ? $pType : '') . '$' . $pName;
                    }
                }
            }

            if (isset(self::$returnTypes[$methodKey])) {
                $returnType = self::$returnTypes[$methodKey];
                $comment    .= self::SPACE5 . "* @return {$returnType}\n";
            } elseif (!isset($config['return'])) {
                $comment .= self::SPACE5 . "* @return mixed\n";
            } elseif (!empty($config['return'])) {
                $comment .= self::SPACE5 . "* @return {$config['return']}\n";
            }

            $comment   .= "$sp4 */\n";
            $modifiers = implode(' ', Reflection::getModifierNames($v->getModifiers()));
            $comment   .= sprintf($tpl, $modifiers, $methodName, implode(', ', $arguments));

            $all[] = $comment;
        }

        return implode("\n\n", $all);
    }

    /**
     * @param string          $classname
     * @param ReflectionClass $ref
     */
    public function exportNamespaceClass(string $classname, $ref): void
    {
        $arr = explode('\\', $classname);
        if (strtolower($arr[0]) !== self::EXTENSION_NAME) {
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
        $this->createDir($dir); // create dir

        $content = "<?php\nnamespace {$ns};\n\n" . $this->getClassDef($name, $ref);
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
        // 获取属性定义
        $props = $this->getPropertyDef($classname, $ref->getProperties());
        // 获取常量定义
        $consts = $this->getConstantsDef($classname, $ref->getConstants());
        // 获取方法定义
        $mdefs = $this->getMethodsDef($classname, $ref->getMethods());

        if ($ref->getParentClass()) {
            $classname .= ' extends \\' . $ref->getParentClass()->name;
        }

        $classTpl = "/**\n * @since %s\n */\n%s %s\n{\n%s\n%s\n%s\n}\n";
        $modifier = $ref->isInterface() ? 'interface' : 'class';
        $classDef = sprintf($classTpl, $this->version, $modifier, $classname, $consts, $props, $mdefs);
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

        if (in_array($name, self::$intArgs, true)) {
            return 'int ';
        }

        if (in_array($name, self::$strArgs, true)) {
            return 'string ';
        }

        if (in_array($name, self::$floatArgs, true)) {
            return 'float ';
        }

        if (in_array($name, self::$boolArgs, true)) {
            return 'bool ';
        }

        if (in_array($name, self::$arrArgs, true)) {
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
     * Class constructor.
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
        echo " - Clear old by 'rm -rf src'\n";
        $srcDir = __DIR__ . '/src';
        exec("rm -rf $srcDir");

        echo " - Parse and dump constants\n";

        // 获取所有define常量
        $consts  = $this->rftExt->getConstants();
        $defines = '';
        foreach ($consts as $className => $ref) {
            if (!is_numeric($ref)) {
                $ref = "'$ref'";
            }

            $this->stats['constant']++;
            $defines .= "define('$className', $ref);\n";
        }

        $outDir = $this->outDir;
        $this->createDir($outDir); // create dir

        file_put_contents($outDir . '/constants.php', "<?php\n" . $defines);

        echo " - Parse and dump functions\n";

        // 获取所有函数
        $funcs = $this->rftExt->getFunctions();
        $codes = $this->getFunctionsDef($funcs);

        file_put_contents($outDir . '/functions.php', "<?php\n" . $codes);

        // 获取所有类
        echo " - Parse and dump classes\n";
        $classes    = $this->rftExt->getClasses();
        $classAlias = "<?php\n";
        $aliasTpl   = "\nclass %s extends %s{}\n";

        /**
         * @var string          $className
         * @var ReflectionClass $ref
         */
        foreach ($classes as $className => $ref) {
            // 短命名别名
            if (stripos($className, 'co\\') === 0) {
                $this->exportShortAlias($className);
                // 标准命名空间的类名，如 Swoole\Server
            } elseif (false !== strpos($className, '\\')) {
                $this->exportNamespaceClass($className, $ref);
                // 下划线分割类别名
            } else {
                $classAlias .= sprintf($aliasTpl, $className, self::getNamespaceAlias($className));
            }
        }

        file_put_contents($outDir . '/classes.php', $classAlias);
    }

    /**
     * @return array
     */
    public function getStats(): array
    {
        return $this->stats;
    }
}

echo "Generate IDE Helper Classes For Swoole Ext\n";
echo 'Swoole Version: v' . swoole_version() . "\n\n";
try {
    $dumper = new ExtDocsGenerator();
    $dumper->export();

    echo "\nDump Successful.\n";
} catch (Throwable $e) {
    echo "\nDump Failure.\n error:", $e->getMessage();
}
