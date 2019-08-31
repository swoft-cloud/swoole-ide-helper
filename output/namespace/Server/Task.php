<?php

namespace Swoole\Server;

/**
 * @since 4.4.5
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
}
