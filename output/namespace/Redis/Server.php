<?php /** @noinspection ALL - For disable PhpStorm check */

namespace Swoole\Redis;

/**
 * @since 4.4.12
 */
class Server extends \Swoole\Server
{
    // constants of the class Server
    public const NIL = 1;
    public const ERROR = 0;
    public const STATUS = 2;
    public const INT = 3;
    public const STRING = 4;
    public const SET = 5;
    public const MAP = 6;


    /**
     * @return mixed
     */
    public function start(){}

    /**
     * @param string $command
     * @param callable $callback
     * @return mixed
     */
    public function setHandler(string $command, callable $callback){}

    /**
     * @param string $command
     * @return mixed
     */
    public function getHandler(string $command){}

    /**
     * @param $type
     * @param $value
     * @return mixed
     */
    public static function format($type, $value = null){}

    /**
     * @param int $ms
     * @param callable $callback
     * @return mixed
     */
    public function after(int $ms, callable $callback){}

    /**
     * @param int $ms
     * @param callable $callback
     * @return mixed
     */
    public function tick(int $ms, callable $callback){}

    /**
     * @param int $timer_id
     * @return mixed
     */
    public function clearTimer(int $timer_id){}

    /**
     * @param callable $callback
     * @return mixed
     */
    public function defer(callable $callback){}
}