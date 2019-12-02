<?php /** @noinspection ALL - For disable PhpStorm check */

namespace Swoole\Coroutine;

/**
 * @since 4.4.12
 */
class Server
{

    // property of the class Server
    public $host;
    public $port;
    public $type;
    public $fd;
    public $errCode;
    public $setting;
    protected $running;
    protected $fn;
    protected $socket;

    /**
     * @param string $host
     * @param int $port
     * @param bool $ssl
     * @param bool $reuse_port
     * @return mixed
     */
    public function __construct(string $host, int $port = 0, bool $ssl = false, bool $reuse_port = false){}

    /**
     * @param array $setting
     * @return void
     */
    public function set(array $setting): void{}

    /**
     * @param callable $fn
     * @return void
     */
    public function handle(callable $fn): void{}

    /**
     * @return bool
     */
    public function shutdown(): bool{}

    /**
     * @return bool
     */
    public function start(): bool{}
}