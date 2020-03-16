<?php

namespace Swoole\Connection;

/**
 * @since 4.4.16
 */
class Iterator implements \Iterator, \ArrayAccess, \Countable
{


    /**
     * @return mixed
     */
    public function __construct(){}

    /**
     * @return mixed
     */
    public function rewind(){}

    /**
     * @return mixed
     */
    public function next(){}

    /**
     * @return mixed
     */
    public function current(){}

    /**
     * @return mixed
     */
    public function key(){}

    /**
     * @return mixed
     */
    public function valid(){}

    /**
     * @return mixed
     */
    public function count(){}

    /**
     * @param int|string $fd
     * @return mixed
     */
    public function offsetExists($fd){}

    /**
     * @param int|string $fd
     * @return mixed
     */
    public function offsetGet($fd){}

    /**
     * @param int|string $fd
     * @param $value
     * @return mixed
     */
    public function offsetSet($fd, $value){}

    /**
     * @param int|string $fd
     * @return mixed
     */
    public function offsetUnset($fd){}
}