<?php
namespace Swoole;

/**
 * @since 4.4.2
 */
class Process
{
    // constants of the class Process
    public const IPC_NOWAIT = 256;
    public const PIPE_MASTER = 1;
    public const PIPE_WORKER = 2;
    public const PIPE_READ = 3;
    public const PIPE_WRITE = 4;

    // property of the class Process
    public $pipe;
    public $callback;
    public $msgQueueId;
    public $msgQueueKey;
    public $pid;
    public $id;

    /**
     * @param mixed $callback
     * @param bool $redirect_stdin_and_stdout [optional]
     * @param int $pipe_type [optional]
     * @param bool $enable_coroutine [optional]
     * @return mixed
     */
    public function __construct($callback, bool $redirect_stdin_and_stdout = null, int $pipe_type = null, bool $enable_coroutine = null){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param bool $blocking [optional]
     * @return mixed
     */
    public static function wait(bool $blocking = null){}

    /**
     * @param int $signal_no
     * @param mixed $callback
     * @return mixed
     */
    public static function signal(int $signal_no, $callback){}

    /**
     * @param $usec
     * @param $type [optional]
     * @return mixed
     */
    public static function alarm($usec, $type = null){}

    /**
     * @param int $pid
     * @param int $signal_no [optional]
     * @return mixed
     */
    public static function kill(int $pid, int $signal_no = null){}

    /**
     * @param $nochdir [optional]
     * @param $noclose [optional]
     * @return mixed
     */
    public static function daemon($nochdir = null, $noclose = null){}

    /**
     * @param $seconds
     * @return mixed
     */
    public function setTimeout($seconds){}

    /**
     * @param bool $blocking
     * @return mixed
     */
    public function setBlocking(bool $blocking){}

    /**
     * @param $key [optional]
     * @param $mode [optional]
     * @param $capacity [optional]
     * @return mixed
     */
    public function useQueue($key = null, $mode = null, $capacity = null){}

    /**
     * @return mixed
     */
    public function statQueue(){}

    /**
     * @return mixed
     */
    public function freeQueue(){}

    /**
     * @return mixed
     */
    public function start(){}

    /**
     * @param $data
     * @return mixed
     */
    public function write($data){}

    /**
     * @return mixed
     */
    public function close(){}

    /**
     * @param int $size [optional]
     * @return mixed
     */
    public function read(int $size = null){}

    /**
     * @param $data
     * @return mixed
     */
    public function push($data){}

    /**
     * @param int $size [optional]
     * @return mixed
     */
    public function pop(int $size = null){}

    /**
     * @param int $exit_code [optional]
     * @return mixed
     */
    public function exit(int $exit_code = null){}

    /**
     * @param $exec_file
     * @param $args
     * @return mixed
     */
    public function exec($exec_file, $args){}

    /**
     * @return \Swoole\Coroutine\Socket
     */
    public function exportSocket(){}

    /**
     * @param string $process_name
     * @return mixed
     */
    public function name(string $process_name){}
}
