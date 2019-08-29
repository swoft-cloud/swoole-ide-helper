<?php
namespace Swoole\Http;

/**
 * @since 4.4.2
 */
class Response
{
    // constants of the class Response

    // property of the class Response
    public $fd;
    public $socket;
    public $header;
    public $cookie;
    public $trailer;

    /**
     * @return mixed
     */
    public function initHeader(){}

    /**
     * @param string $name [required]
     * @param $value [optional]
     * @param $expires [optional]
     * @param string $path [optional]
     * @param $domain [optional]
     * @param $secure [optional]
     * @param $httponly [optional]
     * @return mixed
     */
    public function cookie(string $name, $value = null, $expires = null, string $path = null, $domain = null, $secure = null, $httponly = null){}

    /**
     * @param string $name [required]
     * @param $value [optional]
     * @param $expires [optional]
     * @param string $path [optional]
     * @param $domain [optional]
     * @param $secure [optional]
     * @param $httponly [optional]
     * @return mixed
     */
    public function setCookie(string $name, $value = null, $expires = null, string $path = null, $domain = null, $secure = null, $httponly = null){}

    /**
     * @param string $name [required]
     * @param $value [optional]
     * @param $expires [optional]
     * @param string $path [optional]
     * @param $domain [optional]
     * @param $secure [optional]
     * @param $httponly [optional]
     * @return mixed
     */
    public function rawcookie(string $name, $value = null, $expires = null, string $path = null, $domain = null, $secure = null, $httponly = null){}

    /**
     * @param $http_code [required]
     * @param string $reason [optional]
     * @return mixed
     */
    public function status($http_code, string $reason = null){}

    /**
     * @param $http_code [required]
     * @param string $reason [optional]
     * @return mixed
     */
    public function setStatusCode($http_code, string $reason = null){}

    /**
     * @param $key [required]
     * @param $value [required]
     * @param $ucwords [optional]
     * @return mixed
     */
    public function header($key, $value, $ucwords = null){}

    /**
     * @param $key [required]
     * @param $value [required]
     * @param $ucwords [optional]
     * @return mixed
     */
    public function setHeader($key, $value, $ucwords = null){}

    /**
     * @param $key [required]
     * @param $value [required]
     * @return mixed
     */
    public function trailer($key, $value){}

    /**
     * @return mixed
     */
    public function ping(){}

    /**
     * @param string $content [required]
     * @return mixed
     */
    public function write(string $content){}

    /**
     * @param string $content [optional]
     * @return mixed
     */
    public function end(string $content = null){}

    /**
     * @param string $filename [required]
     * @param int $offset [optional]
     * @param int $length [optional]
     * @return mixed
     */
    public function sendfile(string $filename, int $offset = null, int $length = null){}

    /**
     * @param $location [required]
     * @param $http_code [optional]
     * @return mixed
     */
    public function redirect($location, $http_code = null){}

    /**
     * @return mixed
     */
    public function detach(){}

    /**
     * @param int $fd [required]
     * @return mixed
     */
    public static function create(int $fd){}

    /**
     * @return mixed
     */
    public function upgrade(){}

    /**
     * @return mixed
     */
    public function push(){}

    /**
     * @return mixed
     */
    public function recv(){}

    /**
     * @return mixed
     */
    public function __destruct(){}


}
