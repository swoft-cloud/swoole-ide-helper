<?php

namespace Swoole\Coroutine;

/**
 * @since 4.4.16
 */
class MySQL
{

    // property of the class MySQL
    /**
     * @var array
     */
    public $serverInfo;
    public $sock;
    /**
     * @var bool
     */
    public $connected;
    /**
     * @var int
     */
    public $connect_errno;
    /**
     * @var string
     */
    public $connect_error;
    /**
     * @var int
     */
    public $affected_rows;
    public $insert_id;
    /**
     * @var string
     */
    public $error;
    /**
     * @var int
     */
    public $errno;

    /**
     * @return mixed
     */
    public function __construct(){}

    /**
     * @return mixed
     */
    public function getDefer(){}

    /**
     * @param $defer
     * @return mixed
     */
    public function setDefer($defer = null){}

    /**
     * @param array $server_config
     * @return bool
     */
    public function connect(array $server_config = []): bool{}

    /**
     * @param string $sql
     * @param float $timeout
     * @return array|bool
     */
    public function query(string $sql, float $timeout = null){}

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
     * @param $query
     * @param float $timeout
     * @return \Swoole\Coroutine\MySQL\Statement|false
     */
    public function prepare($query, float $timeout = null){}

    /**
     * @return mixed
     */
    public function recv(){}

    /**
     * @param float $timeout
     * @return bool
     */
    public function begin(float $timeout = null): bool{}

    /**
     * @param float $timeout
     * @return bool
     */
    public function commit(float $timeout = null): bool{}

    /**
     * @param float $timeout
     * @return bool
     */
    public function rollback(float $timeout = null): bool{}

    /**
     * @param string $string
     * @param $flags
     * @return string
     */
    public function escape(string $string, $flags = null): string{}

    /**
     * @return mixed
     */
    public function close(){}
}