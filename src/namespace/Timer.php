<?php
namespace Swoole;

/**
 * @since 4.4.2
 */
class Timer
{
    // constants of the class Timer

    // property of the class Timer

    /**
     * @param int $ms [required]
     * @param mixed $callback [required]
     * @param array $params [optional]
     * @return mixed
     */
    public static function tick(int $ms, $callback, array $params = null){}

    /**
     * @param int $ms [required]
     * @param mixed $callback [required]
     * @param array $params [optional]
     * @return mixed
     */
    public static function after(int $ms, $callback, array $params = null){}

    /**
     * @param int $timer_id [required]
     * @return mixed
     */
    public static function exists(int $timer_id){}

    /**
     * @param int $timer_id [required]
     * @return mixed
     */
    public static function info(int $timer_id){}

    /**
     * @return mixed
     */
    public static function stats(){}

    /**
     * @return mixed
     */
    public static function list(){}

    /**
     * @param int $timer_id [required]
     * @return mixed
     */
    public static function clear(int $timer_id){}

    /**
     * @return mixed
     */
    public static function clearAll(){}


}
