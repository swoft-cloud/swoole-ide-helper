<?php
namespace Swoole\Coroutine\Http;

/**
 * @since 4.4.2
 */
class Client
{
    // constants of the class Client

    // property of the class Client
    public $errCode;
    public $errMsg;
    public $connected;
    public $host;
    public $port;
    public $ssl;
    public $setting;
    public $requestMethod;
    public $requestHeaders;
    public $requestBody;
    public $uploadFiles;
    public $downloadFile;
    public $downloadOffset;
    public $statusCode;
    public $headers;
    public $set_cookie_headers;
    public $cookies;
    public $body;

    /**
     * @param string $host [required]
     * @param int $port [optional]
     * @param $ssl [optional]
     * @return mixed
     */
    public function __construct(string $host, int $port = null, $ssl = null){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param array $settings [required]
     * @return mixed
     */
    public function set(array $settings){}

    /**
     * @return mixed
     */
    public function getDefer(){}

    /**
     * @param $defer [optional]
     * @return mixed
     */
    public function setDefer($defer = null){}

    /**
     * @param string $method [required]
     * @return mixed
     */
    public function setMethod(string $method){}

    /**
     * @param array $headers [required]
     * @return mixed
     */
    public function setHeaders(array $headers){}

    /**
     * @param $username [required]
     * @param $password [required]
     * @return mixed
     */
    public function setBasicAuth($username, $password){}

    /**
     * @param array $cookies [required]
     * @return mixed
     */
    public function setCookies(array $cookies){}

    /**
     * @param $data [required]
     * @return mixed
     */
    public function setData($data){}

    /**
     * @param string $path [required]
     * @param string $name [required]
     * @param $type [optional]
     * @param string $filename [optional]
     * @param int $offset [optional]
     * @param int $length [optional]
     * @return mixed
     */
    public function addFile(string $path, string $name, $type = null, string $filename = null, int $offset = null, int $length = null){}

    /**
     * @param string $path [required]
     * @param string $name [required]
     * @param $type [optional]
     * @param string $filename [optional]
     * @return mixed
     */
    public function addData(string $path, string $name, $type = null, string $filename = null){}

    /**
     * @param string $path [required]
     * @return mixed
     */
    public function execute(string $path){}

    /**
     * @param string $path [required]
     * @return mixed
     */
    public function get(string $path){}

    /**
     * @param string $path [required]
     * @param $data [required]
     * @return mixed
     */
    public function post(string $path, $data){}

    /**
     * @param string $path [required]
     * @param $file [required]
     * @param int $offset [optional]
     * @return mixed
     */
    public function download(string $path, $file, int $offset = null){}

    /**
     * @return mixed
     */
    public function getBody(){}

    /**
     * @return mixed
     */
    public function getHeaders(){}

    /**
     * @return mixed
     */
    public function getCookies(){}

    /**
     * @return mixed
     */
    public function getStatusCode(){}

    /**
     * @param string $path [required]
     * @return mixed
     */
    public function upgrade(string $path){}

    /**
     * @param $data [required]
     * @param int $opcode [optional]
     * @param $finish [optional]
     * @return mixed
     */
    public function push($data, int $opcode = null, $finish = null){}

    /**
     * @param float $timeout [optional]
     * @return mixed
     */
    public function recv(float $timeout = null){}

    /**
     * @return mixed
     */
    public function close(){}


}
