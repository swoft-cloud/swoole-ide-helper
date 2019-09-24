<?php /** @noinspection ALL - For disable PhpStorm check */

namespace Swoole\Curl;

/**
 * @since 4.4.6
 */
class Handler
{
    // constants of the class Handler
    public const ERRORS = array (
  3 => 'No URL set!',
);

    // property of the class Handler
    private $client;
    private $info;
    private $withHeaderOut;
    private $withFileTime;
    private $urlInfo;
    private $postData;
    private $outputStream;
    private $proxy;
    private $clientOptions;
    private $followLocation;
    private $autoReferer;
    private $maxRedirs;
    private $withHeader;
    private $nobody;
    private $headerFunction;
    private $readFunction;
    private $writeFunction;
    private $progressFunction;
    public $returnTransfer;
    public $method;
    public $headers;
    public $transfer;
    public $errCode;
    public $errMsg;

    /**
     * @param $url
     * @return mixed
     */
    public function __construct($url = null){}

    /**
     * @param string $url
     * @return mixed
     */
    private function create(string $url){}

    /**
     * @return mixed
     */
    public function execute(){}

    /**
     * @return mixed
     */
    public function close(){}

    /**
     * @param $code
     * @param $msg
     * @return mixed
     */
    private function setError($code, $msg = null){}

    /**
     * @return mixed
     */
    private function getUrl(){}

    /**
     * @param int $opt
     * @param $value
     * @return mixed
     */
    public function setOption(int $opt, $value){}

    /**
     * @return mixed
     */
    public function reset(){}

    /**
     * @return mixed
     */
    public function getInfo(){}

    /**
     * @param array $parsedUrl
     * @return mixed
     */
    private function unparseUrl(array $parsedUrl){}

    /**
     * @param string $location
     * @return mixed
     */
    private function getRedirectUrl(string $location){}
}