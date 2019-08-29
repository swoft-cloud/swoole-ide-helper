<?php
namespace Swoole\Process;

/**
 * @since 4.4.2
 */
class Pool
{

    // property of the class Pool
    public $master_pid;
    public $workers;

    /**
     * @param int $worker_num
     * @param $ipc_type [optional]
     * @param $msgqueue_key [optional]
     * @param bool $enable_coroutine [optional]
     * @return mixed
     */
    public function __construct(int $worker_num, $ipc_type = null, $msgqueue_key = null, bool $enable_coroutine = null){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param string $event_name
     * @param mixed $callback
     * @return mixed
     */
    public function on(string $event_name, $callback){}

    /**
     * @param int $worker_id [optional]
     * @return mixed
     */
    public function getProcess(int $worker_id = null){}

    /**
     * @param string $host
     * @param int $port [optional]
     * @param $backlog [optional]
     * @return mixed
     */
    public function listen(string $host, int $port = null, $backlog = null){}

    /**
     * @param $data
     * @return mixed
     */
    public function write($data){}

    /**
     * @return mixed
     */
    public function start(){}

    /**
     * @return mixed
     */
    public function shutdown(){}
}
