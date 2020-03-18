<?php

namespace Swoole;

/**
 * @since 4.4.16
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