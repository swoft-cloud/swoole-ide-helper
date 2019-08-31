<?php
namespace Swoole;

/**
 * @since 4.4.5
 */
class Client
{
    // constants of the class Client
    public const MSG_OOB = 1;
    public const MSG_PEEK = 2;
    public const MSG_DONTWAIT = 128;
    public const MSG_WAITALL = 64;
    public const SHUT_RDWR = 2;
    public const SHUT_RD = 0;
    public const SHUT_WR = 1;

    // property of the class Client
    public $errCode;
    public $sock;
    public $reuse;
    public $reuseCount;
    public $type;
    public $id;
    public $setting;
    private $onConnect;
    private $onError;
    private $onReceive;
    private $onClose;
    private $onBufferFull;
    private $onBufferEmpty;
    private $onSSLReady;

    /**
     * @param $type
     * @param $async
     * @return mixed
     */
    public function __construct($type, $async = null){}

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
     * @param int $port
     * @param float $timeout
     * @param $sock_flag
     * @return mixed
     */
    public function connect(string $host, int $port = null, float $timeout = null, $sock_flag = null){}

    /**
     * @param int $size
     * @param $flag
     * @return mixed
     */
    public function recv(int $size = null, $flag = null){}

    /**
     * @param mixed $data
     * @param $flag
     * @return mixed
     */
    public function send($data, $flag = null){}

    /**
     * @param $dst_socket
     * @return mixed
     */
    public function pipe($dst_socket){}

    /**
     * @param string $filename
     * @param int $offset
     * @param int $length
     * @return mixed
     */
    public function sendfile(string $filename, int $offset = null, int $length = null){}

    /**
     * @param string $ip
     * @param int $port
     * @param mixed $data
     * @return mixed
     */
    public function sendto(string $ip, int $port, $data){}

    /**
     * @return mixed
     */
    public function sleep(){}

    /**
     * @return mixed
     */
    public function wakeup(){}

    /**
     * @return mixed
     */
    public function pause(){}

    /**
     * @return mixed
     */
    public function resume(){}

    /**
     * @param $how
     * @return mixed
     */
    public function shutdown($how){}

    /**
     * @param mixed $callback
     * @return mixed
     */
    public function enableSSL($callback = null){}

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
     * @param $force
     * @return mixed
     */
    public function close($force = null){}

    /**
     * @param string $event_name
     * @param mixed $callback
     * @return mixed
     */
    public function on(string $event_name, $callback){}

    /**
     * @return mixed
     */
    public function getSocket(){}
}
