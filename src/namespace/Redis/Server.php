<?php
namespace Swoole\Redis;

/**
 * @since 4.4.5
 */
class Server extends \Swoole\Server
{
    // constants of the class Server
    public const NIL = 1;
    public const ERROR = 0;
    public const STATUS = 2;
    public const INT = 3;
    public const STRING = 4;
    public const SET = 5;
    public const MAP = 6;

    // property of the class Server
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

    /**
     * @return mixed
     */
    public function start(){}

    /**
     * @param string $command
     * @param mixed $callback
     * @return mixed
     */
    public function setHandler(string $command, $callback){}

    /**
     * @param string $command
     * @return mixed
     */
    public function getHandler(string $command){}

    /**
     * @param $type
     * @param $value
     * @return mixed
     */
    public static function format($type, $value = null){}

    /**
     * @param string $host
     * @param int $port
     * @param $mode
     * @param $sock_type
     * @return mixed
     */
    public function __construct(string $host, int $port = null, $mode = null, $sock_type = null){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param string $host
     * @param int $port
     * @param $sock_type
     * @return mixed
     */
    public function listen(string $host, int $port, $sock_type){}

    /**
     * @param string $host
     * @param int $port
     * @param $sock_type
     * @return mixed
     */
    public function addlistener(string $host, int $port, $sock_type){}

    /**
     * @param string $event_name
     * @param mixed $callback
     * @return mixed
     */
    public function on(string $event_name, $callback){}

    /**
     * @param string $event_name
     * @return mixed
     */
    public function getCallback(string $event_name){}

    /**
     * @param array $settings
     * @return mixed
     */
    public function set(array $settings){}

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
     * @param int $fd
     * @param string $send_data
     * @param int $server_socket
     * @return bool
     */
    public function send(int $fd, string $send_data, int $server_socket = null){}

    /**
     * @param string $ip
     * @param int $port
     * @param string $send_data
     * @param int $server_socket
     * @return mixed
     */
    public function sendto(string $ip, int $port, string $send_data, int $server_socket = null){}

    /**
     * @param int $conn_fd
     * @param string $send_data
     * @return mixed
     */
    public function sendwait(int $conn_fd, string $send_data){}

    /**
     * @param int $fd
     * @return mixed
     */
    public function exists(int $fd){}

    /**
     * @param int $fd
     * @return mixed
     */
    public function exist(int $fd){}

    /**
     * @param int $fd
     * @param bool $is_protected
     * @return mixed
     */
    public function protect(int $fd, bool $is_protected = null){}

    /**
     * @param int $conn_fd
     * @param string $filename
     * @param int $offset
     * @param int $length
     * @return mixed
     */
    public function sendfile(int $conn_fd, string $filename, int $offset = null, int $length = null){}

    /**
     * @param int $fd
     * @param bool $reset
     * @return mixed
     */
    public function close(int $fd, bool $reset = null){}

    /**
     * @param int $fd
     * @return mixed
     */
    public function confirm(int $fd){}

    /**
     * @param int $fd
     * @return mixed
     */
    public function pause(int $fd){}

    /**
     * @param int $fd
     * @return mixed
     */
    public function resume(int $fd){}

    /**
     * @param mixed $data
     * @param int $worker_id
     * @param mixed $finish_callback
     * @return mixed
     */
    public function task($data, int $worker_id = null, $finish_callback = null){}

    /**
     * @param mixed $data
     * @param float $timeout
     * @param int $worker_id
     * @return mixed
     */
    public function taskwait($data, float $timeout = null, int $worker_id = null){}

    /**
     * @param $tasks
     * @param float $timeout
     * @return mixed
     */
    public function taskWaitMulti($tasks, float $timeout = null){}

    /**
     * @param $tasks
     * @param float $timeout
     * @return mixed
     */
    public function taskCo($tasks, float $timeout = null){}

    /**
     * @param mixed $data
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
     * @param int $worker_id
     * @return mixed
     */
    public function stop(int $worker_id = null){}

    /**
     * @return mixed
     */
    public function getLastError(){}

    /**
     * @param int $reactor_id
     * @return mixed
     */
    public function heartbeat(int $reactor_id){}

    /**
     * @param int $fd
     * @param int $reactor_id
     * @return mixed
     */
    public function getClientInfo(int $fd, int $reactor_id = null){}

    /**
     * @param int $start_fd
     * @param int $find_count
     * @return mixed
     */
    public function getClientList(int $start_fd, int $find_count = null){}

    /**
     * @param int $fd
     * @param int $reactor_id
     * @return mixed
     */
    public function connection_info(int $fd, int $reactor_id = null){}

    /**
     * @param int $start_fd
     * @param int $find_count
     * @return mixed
     */
    public function connection_list(int $start_fd, int $find_count = null){}

    /**
     * @param mixed $message
     * @param int $dst_worker_id
     * @return mixed
     */
    public function sendMessage($message, int $dst_worker_id){}

    /**
     * @param \Swoole\Process $process
     * @return mixed
     */
    public function addProcess(\Swoole\Process $process){}

    /**
     * @return mixed
     */
    public function stats(){}

    /**
     * @param int $port
     * @return mixed
     */
    public function getSocket(int $port = null){}

    /**
     * @param int $fd
     * @param int $uid
     * @return mixed
     */
    public function bind(int $fd, int $uid){}

    /**
     * @param int $ms
     * @param mixed $callback
     * @return mixed
     */
    public function after(int $ms, $callback){}

    /**
     * @param int $ms
     * @param mixed $callback
     * @return mixed
     */
    public function tick(int $ms, $callback){}

    /**
     * @param int $timer_id
     * @return mixed
     */
    public function clearTimer(int $timer_id){}

    /**
     * @param mixed $callback
     * @return mixed
     */
    public function defer($callback){}
}
