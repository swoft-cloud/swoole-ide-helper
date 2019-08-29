<?php
namespace Swoole\Server;

/**
 * @since 4.4.2
 */
class Task
{

    // property of the class Task
    public $data;
    public $id;
    public $worker_id;
    public $flags;

    /**
     * @param $data
     * @return mixed
     */
    public function finish($data){}
}
