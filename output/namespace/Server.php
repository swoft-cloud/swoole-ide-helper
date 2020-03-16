<?php

namespace Swoole;

/**
 * @since 4.4.16
 */
class Server
{

    // property of the class Server
    /**
     * @var array
     */
    public $setting;
    /**
     * TCP连接迭代器
     * @var Swoole\Coroutine\Iterator
     */
    public $connections;
    public $host;
    public $port;
    public $type;
    public $mode;
    /**
     * 监听端口数组
     * @var Swoole\Server\Port[]
     */
    public $ports;
    /**
     * 当前服务器主进程的PID
     * @var int
     */
    public $master_pid;
    /**
     * 当前服务器管理进程的PID
     * @var int
     */
    public $manager_pid;
    /**
     * @var int
     */
    public $worker_id;
    /**
     * @var bool
     */
    public $taskworker;
    /**
     * @var int
     */
    public $worker_pid;

    /**
     * @param string $host
     * @param int $port
     * @param int $mode
     * @param int $sock_type
     * @return mixed
     */
    public function __construct(string $host, int $port = null, int $mode = SWOOLE_PROCESS, int $sock_type = SWOOLE_SOCK_TCP){}

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
     * @param int $sock_type
     * @return mixed
     */
    public function addlistener(string $host, int $port, int $sock_type = SWOOLE_SOCK_TCP){}

    /**
     * @param string $event_name
     * @param callable $callback
     * @return mixed
     */
    public function on(string $event_name, callable $callback){}

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
     * @return mixed
     */
    public function start(){}

    /**
     * send data to the client
     * @param int|string $fd
     * @param string $send_data
     * @param int $server_socket
     * @return bool If success return True, fail return False
     */
    public function send($fd, string $send_data, int $server_socket = -1): bool{}

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
     * @param callable $finish_callback
     * @return mixed
     */
    public function task($data, int $worker_id = null, callable $finish_callback = null){}

    /**
     * @param mixed $data
     * @param float $timeout
     * @param int $worker_id
     * @return mixed
     */
    public function taskwait($data, float $timeout = null, int $worker_id = null){}

    /**
     * @param array $tasks
     * @param float $timeout
     * @return mixed
     */
    public function taskWaitMulti(array $tasks, float $timeout = null){}

    /**
     * @param array $tasks
     * @param float $timeout
     * @return mixed
     */
    public function taskCo(array $tasks, float $timeout = null){}

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
     * @param int $fd
     * @param int $uid
     * @return mixed
     */
    public function bind(int $fd, int $uid){}

    /**
     * @param int $ms
     * @param callable $callback
     * @return mixed
     */
    public function after(int $ms, callable $callback){}

    /**
     * @param int $ms
     * @param callable $callback
     * @return mixed
     */
    public function tick(int $ms, callable $callback){}

    /**
     * @param int $timer_id
     * @return mixed
     */
    public function clearTimer(int $timer_id){}

    /**
     * @param callable $callback
     * @return mixed
     */
    public function defer(callable $callback){}
}