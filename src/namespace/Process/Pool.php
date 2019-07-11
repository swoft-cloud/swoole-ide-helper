<?php
namespace Swoole\Process;

/**
 * @since 4.4.0
 */
class Pool
{

    public $master_pid;
    public $workers;

    /**
     * @param $worker_num [required]
     * @param $ipc_type [optional]
     * @param $msgqueue_key [optional]
     * @param $enable_coroutine [optional]
     * @return mixed
     */
    public function __construct(int $worker_num, $ipc_type=null, $msgqueue_key=null, $enable_coroutine=null){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param $event_name [required]
     * @param mixed $callback [required]
     * @return mixed
     */
    public function on(string $event_name, $callback){}

    /**
     * @param $worker_id [optional]
     * @return mixed
     */
    public function getProcess(int $worker_id=null){}

    /**
     * @param $host [required]
     * @param $port [optional]
     * @param $backlog [optional]
     * @return mixed
     */
    public function listen(string $host, int $port=null, $backlog=null){}

    /**
     * @param $data [required]
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
