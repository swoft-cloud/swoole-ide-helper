<?php /** @noinspection ALL - For disable PhpStorm check */

namespace Swoole\WebSocket;

/**
 * @since 4.4.8
 */
class Server extends \Swoole\Http\Server
{

    // property of the class Server

    /**
     * @param int $fd
     * @param mixed $data
     * @param int $opcode
     * @param bool $finish
     * @return mixed
     */
    public function push(int $fd, $data, int $opcode = null, bool $finish = null){}

    /**
     * @param int $fd
     * @param $code
     * @param string $reason
     * @return mixed
     */
    public function disconnect(int $fd, $code = null, string $reason = null){}

    /**
     * @param int $fd
     * @return mixed
     */
    public function isEstablished(int $fd){}

    /**
     * @param mixed $data
     * @param int $opcode
     * @param bool $finish
     * @param $mask
     * @return mixed
     */
    public static function pack($data, int $opcode = null, bool $finish = null, $mask = null){}

    /**
     * @param mixed $data
     * @return mixed
     */
    public static function unpack($data){}

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