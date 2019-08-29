<?php
namespace Swoole;

/**
 * @since 4.4.2
 */
class Event
{


    /**
     * @param int $fd [required]
     * @param $read_callback [required]
     * @param $write_callback [optional]
     * @param $events [optional]
     * @return mixed
     */
    public static function add(int $fd, $read_callback, $write_callback = null, $events = null){}

    /**
     * @param int $fd [required]
     * @return mixed
     */
    public static function del(int $fd){}

    /**
     * @param int $fd [required]
     * @param $read_callback [optional]
     * @param $write_callback [optional]
     * @param $events [optional]
     * @return mixed
     */
    public static function set(int $fd, $read_callback = null, $write_callback = null, $events = null){}

    /**
     * @param int $fd [required]
     * @param $events [optional]
     * @return mixed
     */
    public static function isset(int $fd, $events = null){}

    /**
     * @return mixed
     */
    public static function dispatch(){}

    /**
     * @param mixed $callback [required]
     * @return mixed
     */
    public static function defer($callback){}

    /**
     * @param mixed $callback [required]
     * @param $before [optional]
     * @return mixed
     */
    public static function cycle($callback, $before = null){}

    /**
     * @param int $fd [required]
     * @param $data [required]
     * @return mixed
     */
    public static function write(int $fd, $data){}

    /**
     * @return mixed
     */
    public static function wait(){}

    /**
     * @return mixed
     */
    public static function rshutdown(){}

    /**
     * @return mixed
     */
    public static function exit(){}


}
