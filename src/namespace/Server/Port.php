<?php
namespace Swoole\Server;

/**
 * @since 4.4.5
 */
class Port
{

    // property of the class Port
    private $onConnect;
    private $onReceive;
    private $onClose;
    private $onPacket;
    private $onBufferFull;
    private $onBufferEmpty;
    private $onRequest;
    private $onHandShake;
    private $onOpen;
    private $onMessage;
    public $host;
    public $port;
    public $type;
    public $sock;
    public $setting;
    public $connections;

    /**
     * @return mixed
     */
    private function __construct(){}

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
     * @param string $event_name
     * @param callable $callback
     * @return mixed
     */
    public function on(string $event_name, callable $callback){}

    /**
     * @param string $event_name
     * @return mixed
     */
    public function getCallback(string $event_name){}

    /**
     * @return mixed
     */
    public function getSocket(){}
}
