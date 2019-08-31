<?php
namespace Swoole;

/**
 * @since 4.4.5
 */
class Event
{


    /**
     * @param int $fd
     * @param mixed $read_callback
     * @param mixed $write_callback
     * @param $events
     * @return mixed
     */
    public static function add(int $fd, $read_callback, $write_callback = null, $events = null){}

    /**
     * @param int $fd
     * @return mixed
     */
    public static function del(int $fd){}

    /**
     * @param int $fd
     * @param mixed $read_callback
     * @param mixed $write_callback
     * @param $events
     * @return mixed
     */
    public static function set(int $fd, $read_callback = null, $write_callback = null, $events = null){}

    /**
     * @param int $fd
     * @param $events
     * @return mixed
     */
    public static function isset(int $fd, $events = null){}

    /**
     * @return mixed
     */
    public static function dispatch(){}

    /**
     * @param mixed $callback
     * @return mixed
     */
    public static function defer($callback){}

    /**
     * @param mixed $callback
     * @param $before
     * @return mixed
     */
    public static function cycle($callback, $before = null){}

    /**
     * @param int $fd
     * @param mixed $data
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
