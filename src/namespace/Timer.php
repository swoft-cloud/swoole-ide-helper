<?php
namespace Swoole;

/**
 * @since 4.4.2
 */
class Timer
{


    /**
     * @param int $ms
     * @param mixed $callback
     * @param array $params [optional]
     * @return mixed
     */
    public static function tick(int $ms, $callback, array $params = null){}

    /**
     * @param int $ms
     * @param mixed $callback
     * @param array $params [optional]
     * @return mixed
     */
    public static function after(int $ms, $callback, array $params = null){}

    /**
     * @param int $timer_id
     * @return mixed
     */
    public static function exists(int $timer_id){}

    /**
     * @param int $timer_id
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
     * @param int $timer_id
     * @return mixed
     */
    public static function clear(int $timer_id){}

    /**
     * @return mixed
     */
    public static function clearAll(){}
}
