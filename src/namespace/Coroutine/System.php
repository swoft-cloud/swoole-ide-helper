<?php
namespace Swoole\Coroutine;

/**
 * @since 4.4.5
 */
class System
{


    /**
     * @param string $domain_name
     * @param $family
     * @param float $timeout
     * @return mixed
     */
    public static function gethostbyname(string $domain_name, $family = null, float $timeout = null){}

    /**
     * @param string $domain_name
     * @param float $timeout
     * @return mixed
     */
    public static function dnsLookup(string $domain_name, float $timeout = null){}

    /**
     * @param string $command
     * @param $get_error_stream
     * @return mixed
     */
    public function exec(string $command, $get_error_stream = null){}

    /**
     * @param $seconds
     * @return mixed
     */
    public function sleep($seconds){}

    /**
     * @param $handle
     * @param int $length
     * @return mixed
     */
    public function fread($handle, int $length = null){}

    /**
     * @param $handle
     * @param string $string
     * @param int $length
     * @return mixed
     */
    public function fwrite($handle, string $string, int $length = null){}

    /**
     * @param $handle
     * @return mixed
     */
    public function fgets($handle){}

    /**
     * @param string $hostname
     * @param $family
     * @param $socktype
     * @param $protocol
     * @param $service
     * @param float $timeout
     * @return mixed
     */
    public function getaddrinfo(string $hostname, $family = null, $socktype = null, $protocol = null, $service = null, float $timeout = null){}

    /**
     * @param string $filename
     * @return mixed
     */
    public function readFile(string $filename){}

    /**
     * @param string $filename
     * @param mixed $data
     * @param $flags
     * @return mixed
     */
    public function writeFile(string $filename, $data, $flags = null){}

    /**
     * @param string $path
     * @return mixed
     */
    public function statvfs(string $path){}
}
