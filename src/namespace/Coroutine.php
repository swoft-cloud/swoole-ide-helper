<?php
namespace Swoole;

/**
 * @since 4.2.12
 */
class Coroutine
{


    /**
     * @param $func [required]
     * @param $params [optional]
     * @return mixed
     */
    public static function create($func, array $params=null){}

    /**
     * @param $command [required]
     * @return mixed
     */
    public static function exec(string $command){}

    /**
     * @param $domain_name [required]
     * @param $family [optional]
     * @param $timeout [optional]
     * @return mixed
     */
    public static function gethostbyname(string $domain_name, $family=null, float $timeout=null){}

    /**
     * @param mixed $callback [required]
     * @return mixed
     */
    public static function defer($callback){}

    /**
     * @param $options [required]
     * @return mixed
     */
    public static function set($options){}

    /**
     * @return mixed
     */
    public static function yield(){}

    /**
     * @return mixed
     */
    public static function suspend(){}

    /**
     * @param $uid [required]
     * @return mixed
     */
    public static function resume(int $uid){}

    /**
     * @return mixed
     */
    public static function stats(){}

    /**
     * @return mixed
     */
    public static function getCid(){}

    /**
     * @return mixed
     */
    public static function getuid(){}

    /**
     * @param $seconds [required]
     * @return mixed
     */
    public static function sleep($seconds){}

    /**
     * @param $handle [required]
     * @param $length [optional]
     * @return mixed
     */
    public static function fread($handle, int $length=null){}

    /**
     * @param $handle [required]
     * @return mixed
     */
    public static function fgets($handle){}

    /**
     * @param $handle [required]
     * @param $string [required]
     * @param $length [optional]
     * @return mixed
     */
    public static function fwrite($handle, string $string, int $length=null){}

    /**
     * @param $filename [required]
     * @return mixed
     */
    public static function readFile(string $filename){}

    /**
     * @param $filename [required]
     * @param $data [required]
     * @param $flags [optional]
     * @return mixed
     */
    public static function writeFile(string $filename, $data, $flags=null){}

    /**
     * @param $hostname [required]
     * @param $family [optional]
     * @param $socktype [optional]
     * @param $protocol [optional]
     * @param $service [optional]
     * @return mixed
     */
    public static function getaddrinfo(string $hostname, $family=null, $socktype=null, $protocol=null, $service=null){}

    /**
     * @param $path [required]
     * @return mixed
     */
    public static function statvfs(string $path){}

    /**
     * @param $cid [required]
     * @param $options [optional]
     * @param $limit [optional]
     * @return mixed
     */
    public static function getBackTrace(int $cid, $options=null, int $limit=null){}

    /**
     * @return mixed
     */
    public static function listCoroutines(){}


}
