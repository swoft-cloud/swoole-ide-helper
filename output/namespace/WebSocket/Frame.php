<?php

namespace Swoole\WebSocket;

/**
 * @since 4.4.16
 */
class Frame
{

    // property of the class Frame
    public $fd;
    public $data;
    public $opcode;
    public $flags;
    public $finish;

    /**
     * @return mixed
     */
    public function __toString(){}

    /**
     * @param mixed $data
     * @param int $opcode
     * @param $flags
     * @return mixed
     */
    public static function pack($data, int $opcode = null, $flags = null){}

    /**
     * @param mixed $data
     * @return mixed
     */
    public static function unpack($data){}
}