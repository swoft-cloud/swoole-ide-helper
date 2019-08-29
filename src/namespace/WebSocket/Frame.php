<?php
namespace Swoole\WebSocket;

/**
 * @since 4.4.2
 */
class Frame
{
    // constants of the class Frame

    // property of the class Frame
    public $fd;
    public $data;
    public $opcode;
    public $finish;

    /**
     * @return mixed
     */
    public function __toString(){}

    /**
     * @param $data [required]
     * @param int $opcode [optional]
     * @param $finish [optional]
     * @param $mask [optional]
     * @return mixed
     */
    public static function pack($data, int $opcode = null, $finish = null, $mask = null){}

    /**
     * @param $data [required]
     * @return mixed
     */
    public static function unpack($data){}


}
