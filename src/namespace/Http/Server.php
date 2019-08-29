<?php
namespace Swoole\Http;

/**
 * @since 4.4.2
 */
class Server extends \Swoole\Server
{

    public $setting;
    public $connections;
    public $host;
    public $port;
    public $type;
    public $mode;
    public $ports;
    public $master_pid;
    public $manager_pid;
    public $worker_id;
    public $taskworker;
    public $worker_pid;
    private $onRequest;
    private $onHandshake;

    /**
     * @param string $host [required]
     * @param int $port [optional]
     * @param $mode [optional]
     * @param $sock_type [optional]
     * @return mixed
     */
    public function __construct(string $host, int $port = null, $mode = null, $sock_type = null){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param string $host [required]
     * @param int $port [required]
     * @param $sock_type [required]
     * @return mixed
     */
    public function listen(string $host, int $port, $sock_type){}

    /**
     * @param string $host [required]
     * @param int $port [required]
     * @param $sock_type [required]
     * @return mixed
     */
    public function addlistener(string $host, int $port, $sock_type){}

    /**
     * @param string $event_name [required]
     * @param mixed $callback [required]
     * @return mixed
     */
    public function on(string $event_name, $callback){}

    /**
     * @param string $event_name [required]
     * @return mixed
     */
    public function getCallback(string $event_name){}

    /**
     * @param array $settings [required]
     * @return mixed
     */
    public function set(array $settings){}

    /**
     * @return mixed
     */
    public function start(){}

    /**
     
     * 向客户端发送数据
     *
     *  * $data，发送的数据。TCP协议最大不得超过2M，UDP协议不得超过64K
     *  * 发送成功会返回true，如果连接已被关闭或发送失败会返回false
     *
     * TCP服务器
     * -------------------------------------------------------------------------
     *  * send操作具有原子性，多个进程同时调用send向同一个连接发送数据，不会发生数据混杂
     *  * 如果要发送超过2M的数据，可以将数据写入临时文件，然后通过sendfile接口进行发送
     *
     * swoole-1.6以上版本不需要$from_id
     *
     * UDP服务器
     * ------------------------------------------------------------------------
     *  * send操作会直接在worker进程内发送数据包，不会再经过主进程转发
     *  * 使用fd保存客户端IP，from_id保存from_fd和port
     *  * 如果在onReceive后立即向客户端发送数据，可以不传$reactor_id
     *  * 如果向其他UDP客户端发送数据，必须要传入$reactor_id
     *  * 在外网服务中发送超过64K的数据会分成多个传输单元进行发送，如果其中一个单元丢包，会导致整个包被丢弃。所以外网服务，建议发送1.5K以下的数据包
     *
     * @param int $fd [required]
     * @param string $send_data [required]
     * @param $server_socket [optional]
     * @return bool
     */
    public function send(int $fd, string $send_data, $server_socket = null){}

    /**
     * @param $ip [required]
     * @param int $port [required]
     * @param string $send_data [required]
     * @param $server_socket [optional]
     * @return mixed
     */
    public function sendto($ip, int $port, string $send_data, $server_socket = null){}

    /**
     * @param int $conn_fd [required]
     * @param string $send_data [required]
     * @return mixed
     */
    public function sendwait(int $conn_fd, string $send_data){}

    /**
     * @param int $fd [required]
     * @return mixed
     */
    public function exists(int $fd){}

    /**
     * @param int $fd [required]
     * @return mixed
     */
    public function exist(int $fd){}

    /**
     * @param int $fd [required]
     * @param bool $is_protected [optional]
     * @return mixed
     */
    public function protect(int $fd, bool $is_protected = null){}

    /**
     * @param int $conn_fd [required]
     * @param string $filename [required]
     * @param int $offset [optional]
     * @param int $length [optional]
     * @return mixed
     */
    public function sendfile(int $conn_fd, string $filename, int $offset = null, int $length = null){}

    /**
     * @param int $fd [required]
     * @param bool $reset [optional]
     * @return mixed
     */
    public function close(int $fd, bool $reset = null){}

    /**
     * @param int $fd [required]
     * @return mixed
     */
    public function confirm(int $fd){}

    /**
     * @param int $fd [required]
     * @return mixed
     */
    public function pause(int $fd){}

    /**
     * @param int $fd [required]
     * @return mixed
     */
    public function resume(int $fd){}

    /**
     * @param $data [required]
     * @param int $worker_id [optional]
     * @param $finish_callback [optional]
     * @return mixed
     */
    public function task($data, int $worker_id = null, $finish_callback = null){}

    /**
     * @param $data [required]
     * @param float $timeout [optional]
     * @param int $worker_id [optional]
     * @return mixed
     */
    public function taskwait($data, float $timeout = null, int $worker_id = null){}

    /**
     * @param $tasks [required]
     * @param float $timeout [optional]
     * @return mixed
     */
    public function taskWaitMulti($tasks, float $timeout = null){}

    /**
     * @param $tasks [required]
     * @param float $timeout [optional]
     * @return mixed
     */
    public function taskCo($tasks, float $timeout = null){}

    /**
     * @param $data [required]
     * @return mixed
     */
    public function finish($data){}

    /**
     * @return mixed
     */
    public function reload(){}

    /**
     * @return mixed
     */
    public function shutdown(){}

    /**
     * @param int $worker_id [optional]
     * @return mixed
     */
    public function stop(int $worker_id = null){}

    /**
     * @return mixed
     */
    public function getLastError(){}

    /**
     * @param int $reactor_id [required]
     * @return mixed
     */
    public function heartbeat(int $reactor_id){}

    /**
     * @param int $fd [required]
     * @param int $reactor_id [optional]
     * @return mixed
     */
    public function getClientInfo(int $fd, int $reactor_id = null){}

    /**
     * @param int $start_fd [required]
     * @param int $find_count [optional]
     * @return mixed
     */
    public function getClientList(int $start_fd, int $find_count = null){}

    /**
     * @param int $fd [required]
     * @param int $reactor_id [optional]
     * @return mixed
     */
    public function connection_info(int $fd, int $reactor_id = null){}

    /**
     * @param int $start_fd [required]
     * @param int $find_count [optional]
     * @return mixed
     */
    public function connection_list(int $start_fd, int $find_count = null){}

    /**
     * @param mixed $message [required]
     * @param int $dst_worker_id [required]
     * @return mixed
     */
    public function sendMessage($message, int $dst_worker_id){}

    /**
     * @param $process [required]
     * @return mixed
     */
    public function addProcess($process){}

    /**
     * @return mixed
     */
    public function stats(){}

    /**
     * @param int $port [optional]
     * @return mixed
     */
    public function getSocket(int $port = null){}

    /**
     * @param int $fd [required]
     * @param int $uid [required]
     * @return mixed
     */
    public function bind(int $fd, int $uid){}

    /**
     * @param int $ms [required]
     * @param mixed $callback [required]
     * @return mixed
     */
    public function after(int $ms, $callback){}

    /**
     * @param int $ms [required]
     * @param mixed $callback [required]
     * @return mixed
     */
    public function tick(int $ms, $callback){}

    /**
     * @param int $timer_id [required]
     * @return mixed
     */
    public function clearTimer(int $timer_id){}

    /**
     * @param mixed $callback [required]
     * @return mixed
     */
    public function defer($callback){}


}
