<?php /** @noinspection ALL - For disable PhpStorm check */

namespace Swoole;

/**
 * @since 4.4.8
 */
class ExitException extends \Swoole\Exception implements \Throwable
{

    // property of the class ExitException

    /**
     * @return mixed
     */
    public function getFlags(){}

    /**
     * @return mixed
     */
    public function getStatus(){}
}