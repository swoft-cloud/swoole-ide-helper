<?php
namespace Swoole\Coroutine;

/**
 * @since 4.4.0
 */
class MySQL
{

    public $serverInfo;
    public $sock;
    public $connected;
    public $connect_errno;
    public $connect_error;
    public $affected_rows;
    public $insert_id;
    public $error;
    public $errno;

    /**
     * @return mixed
     */
    public function __construct(){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @return mixed
     */
    public function getDefer(){}

    /**
     * @param $defer [optional]
     * @return mixed
     */
    public function setDefer($defer=null){}

    /**
     * @param $server_config [optional]
     * @return mixed
     */
    public function connect($server_config=null){}

    /**
     * @param $sql [required]
     * @param $timeout [optional]
     * @return mixed
     */
    public function query(string $sql, float $timeout=null){}

    /**
     * @return mixed
     */
    public function fetch(){}

    /**
     * @return mixed
     */
    public function fetchAll(){}

    /**
     * @return mixed
     */
    public function nextResult(){}

    /**
     * @param $query [required]
     * @param $timeout [optional]
     * @return mixed
     */
    public function prepare($query, float $timeout=null){}

    /**
     * @return mixed
     */
    public function recv(){}

    /**
     * @param $timeout [optional]
     * @return mixed
     */
    public function begin(float $timeout=null){}

    /**
     * @param $timeout [optional]
     * @return mixed
     */
    public function commit(float $timeout=null){}

    /**
     * @param $timeout [optional]
     * @return mixed
     */
    public function rollback(float $timeout=null){}

    /**
     * @param $string [required]
     * @param $flags [optional]
     * @return mixed
     */
    public function escape(string $string, $flags=null){}

    /**
     * @return mixed
     */
    public function close(){}


}
