<?php /** @noinspection ALL - For disable PhpStorm check */

namespace Swoole;

/**
 * @since 4.4.12
 */
class ExitException extends \Swoole\Exception implements \Throwable
{


    /**
     * @return mixed
     */
    public function getFlags(){}

    /**
     * @return mixed
     */
    public function getStatus(){}
}