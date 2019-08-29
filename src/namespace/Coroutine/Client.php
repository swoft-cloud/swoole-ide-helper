<?php
namespace Swoole\Coroutine;

/**
 * @since 4.4.2
 */
class Client
{
    // constants of the class Client
    public const MSG_OOB = 1;
    public const MSG_PEEK = 2;
    public const MSG_DONTWAIT = 128;
    public const MSG_WAITALL = 64;

    // property of the class Client
    public $errCode;
    public $errMsg;
    public $fd;
    private $socket;
    public $type;
    public $setting;
    public $connected;

    /**
     * @param $type
     * @return mixed
     */
    public function __construct($type){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param array $settings
     * @return mixed
     */
    public function set(array $settings){}

    /**
     * @param string $host
     * @param int $port [optional]
     * @param float $timeout [optional]
     * @param $sock_flag [optional]
     * @return mixed
     */
    public function connect(string $host, int $port = null, float $timeout = null, $sock_flag = null){}

    /**
     * @param float $timeout [optional]
     * @return mixed
     */
    public function recv(float $timeout = null){}

    /**
     * @param int $length [optional]
     * @return mixed
     */
    public function peek(int $length = null){}

    /**
     * @param $data
     * @return mixed
     */
    public function send($data){}

    /**
     * @param string $filename
     * @param int $offset [optional]
     * @param int $length [optional]
     * @return mixed
     */
    public function sendfile(string $filename, int $offset = null, int $length = null){}

    /**
     * @param $address
     * @param int $port
     * @param $data
     * @return mixed
     */
    public function sendto($address, int $port, $data){}

    /**
     * @param int $length
     * @param $address
     * @param int $port [optional]
     * @return mixed
     */
    public function recvfrom(int $length, $address, int $port = null){}

    /**
     * @return mixed
     */
    public function enableSSL(){}

    /**
     * @return mixed
     */
    public function getPeerCert(){}

    /**
     * @return mixed
     */
    public function verifyPeerCert(){}

    /**
     * @return mixed
     */
    public function isConnected(){}

    /**
     * @return mixed
     */
    public function getsockname(){}

    /**
     * @return mixed
     */
    public function getpeername(){}

    /**
     * @return mixed
     */
    public function close(){}

    /**
     * @return mixed
     */
    public function exportSocket(){}
}
