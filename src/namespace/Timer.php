<?php
namespace Swoole;

/**
 * @since 4.4.0
 */
class Timer
{


    /**
     * @param $ms [required]
     * @param mixed $callback [required]
     * @param $params [optional]
     * @return mixed
     */
    public static function tick(int $ms, $callback, array $params=null){}

    /**
     * @param $ms [required]
     * @param mixed $callback [required]
     * @param $params [optional]
     * @return mixed
     */
    public static function after(int $ms, $callback, array $params=null){}

    /**
     * @param $timer_id [required]
     * @return mixed
     */
    public static function exists(int $timer_id){}

    /**
     * @param $timer_id [required]
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
     * @param $timer_id [required]
     * @return mixed
     */
    public static function clear(int $timer_id){}

    /**
     * @return mixed
     */
    public static function clearAll(){}


}
