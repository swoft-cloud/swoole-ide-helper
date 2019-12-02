<?php /** @noinspection ALL - For disable PhpStorm check */

namespace Swoole\Curl;

/**
 * @since 4.4.12
 */
class Handler
{

    // property of the class Handler
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
     * @return mixed
     */
    public function execute(){}

    /**
     * @return void
     */
    public function close(): void{}

    /**
     * @param int $opt
     * @param $value
     * @return bool
     */
    public function setOption(int $opt, $value): bool{}

    /**
     * @return void
     */
    public function reset(): void{}

    /**
     * @return mixed
     */
    public function getInfo(){}
}