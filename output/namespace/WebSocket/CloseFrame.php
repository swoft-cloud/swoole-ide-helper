<?php /** @noinspection ALL - For disable PhpStorm check */

namespace Swoole\WebSocket;

/**
 * @since 4.4.8
 */
class CloseFrame extends \Swoole\WebSocket\Frame
{

    // property of the class CloseFrame
    public $opcode;
    public $code;
    public $reason;


}