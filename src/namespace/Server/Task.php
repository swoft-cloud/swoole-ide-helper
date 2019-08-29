<?php
namespace Swoole\Server;

/**
 * @since 4.4.2
 */
class Task
{

    public $data;
    public $id;
    public $worker_id;
    public $flags;

    /**
     * @param $data [required]
     * @return mixed
     */
    public function finish($data){}


}
