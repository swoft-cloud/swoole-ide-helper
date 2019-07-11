<?php
namespace Swoole\Coroutine\Http;

/**
 * @since 4.4.0
 */
class Client
{

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
     * @param $host [required]
     * @param $port [optional]
     * @param $ssl [optional]
     * @return mixed
     */
    public function __construct(string $host, int $port=null, $ssl=null){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param $settings [required]
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
    public function setDefer($defer=null){}

    /**
     * @param $method [required]
     * @return mixed
     */
    public function setMethod(string $method){}

    /**
     * @param $headers [required]
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
     * @param $cookies [required]
     * @return mixed
     */
    public function setCookies(array $cookies){}

    /**
     * @param $data [required]
     * @return mixed
     */
    public function setData($data){}

    /**
     * @param $path [required]
     * @param $name [required]
     * @param $type [optional]
     * @param $filename [optional]
     * @param $offset [optional]
     * @param $length [optional]
     * @return mixed
     */
    public function addFile(string $path, string $name, $type=null, string $filename=null, int $offset=null, int $length=null){}

    /**
     * @param $path [required]
     * @param $name [required]
     * @param $type [optional]
     * @param $filename [optional]
     * @return mixed
     */
    public function addData(string $path, string $name, $type=null, string $filename=null){}

    /**
     * @param $path [required]
     * @return mixed
     */
    public function execute(string $path){}

    /**
     * @param $path [required]
     * @return mixed
     */
    public function get(string $path){}

    /**
     * @param $path [required]
     * @param $data [required]
     * @return mixed
     */
    public function post(string $path, $data){}

    /**
     * @param $path [required]
     * @param $file [required]
     * @param $offset [optional]
     * @return mixed
     */
    public function download(string $path, $file, int $offset=null){}

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
     * @param $path [required]
     * @return mixed
     */
    public function upgrade(string $path){}

    /**
     * @param $data [required]
     * @param $opcode [optional]
     * @param $finish [optional]
     * @return mixed
     */
    public function push($data, int $opcode=null, $finish=null){}

    /**
     * @param $timeout [optional]
     * @return mixed
     */
    public function recv(float $timeout=null){}

    /**
     * @return mixed
     */
    public function close(){}


}
