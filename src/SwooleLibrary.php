<?php declare(strict_types=1);

namespace IDEHelper;

use ReflectionClass;
use ReflectionException;
use ReflectionFunction;

/**
 * Class SwooleLibrary
 */
class SwooleLibrary
{
    public const LIB_CLASS = [
        // library/core/Coroutine
        'Swoole\\Coroutine\\WaitGroup',
        'Swoole\\Coroutine\\Server',
        'Swoole\\Coroutine\\Server\\Connection',
        'Swoole\\Coroutine\\ObjectPool',
        // library/core
        'Swoole\\ArrayObject',
        'Swoole\\StringObject',
        'Swoole\\Constant',
        // library/core/Curl
        'Swoole\\Curl\\Exception',
        'Swoole\\Curl\\Handler',
        // library/core/Http
        'Swoole\\Http\\StatusCode',
    ];

    public const LIB_FUNCTION = [
        // library/alias_ns
        'Swoole\\Coroutine\\run',
        'Co\\run',
        // library/functions
        '_string',
        '_array',
        'swoole_string',
        'swoole_array',
        'swoole_array_default_value',
        // library/std/exec
        'swoole_exec',
        'swoole_shell_exec',
        // library/ext/curl
        'swoole_curl_init',
        'swoole_curl_setopt',
        'swoole_curl_setopt_array',
        'swoole_curl_exec',
        'swoole_curl_multi_getcontent',
        'swoole_curl_close',
        'swoole_curl_error',
        'swoole_curl_errno',
        'swoole_curl_reset',
        'swoole_curl_getinfo',
    ];

    /**
     * @return ReflectionClass[]
     */
    public static function loadLibClass(): array
    {
        $libClass = [];
        foreach (self::LIB_CLASS as $className) {
            if (!class_exists($className)) {
                continue;
            }
            try {
                $refClass = new ReflectionClass($className);
            } catch (ReflectionException $e) {
                continue;
            }
            $libClass[$className] = $refClass;
        }
        return $libClass;
    }

    public static function loadLibFun(): array
    {
        $libFun = [];
        foreach (self::LIB_FUNCTION as $funName) {
            if (!function_exists($funName)) {
                continue;
            }
            try {
                $refFun = new ReflectionFunction($funName);
            } catch (ReflectionException $e) {
                continue;
            }

            $libFun[$funName] = $refFun;
        }
        return $libFun;
    }
}
