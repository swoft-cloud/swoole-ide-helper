<?php

namespace Swoole\Server;

/**
 * @since 4.4.16
 */
class Task
{

    // property of the class Task
    public $data;
    public $id;
    public $worker_id;
    public $flags;

    /**
     * @param mixed $data
     * @return mixed
     */
    public function finish($data){}

    /**
     * @param mixed $data
     * @return mixed
     */
    public static function pack($data){}
}