<?php
namespace Swoole\WebSocket;

/**
 * @since 4.4.2
 */
class CloseFrame extends \Swoole\WebSocket\Frame
{

    // property of the class CloseFrame
    public $fd;
    public $data;
    public $finish;
    public $opcode;
    public $code;
    public $reason;

    /**
     * @return mixed
     */
    public function __toString(){}

    /**
     * @param $data
     * @param int $opcode [optional]
     * @param $finish [optional]
     * @param $mask [optional]
     * @return mixed
     */
    public static function pack($data, int $opcode = null, $finish = null, $mask = null){}

    /**
     * @param $data
     * @return mixed
     */
    public static function unpack($data){}
}
