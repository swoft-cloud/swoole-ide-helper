<?php

namespace Swoole\Table;

/**
 * @since 4.4.16
 */
class Row implements \ArrayAccess
{

    // property of the class Row
    public $key;
    public $value;

    /**
     * @param int|string $offset
     * @return mixed
     */
    public function offsetExists($offset){}

    /**
     * @param int|string $offset
     * @return mixed
     */
    public function offsetGet($offset){}

    /**
     * @param int|string $offset
     * @param $value
     * @return mixed
     */
    public function offsetSet($offset, $value){}

    /**
     * @param int|string $offset
     * @return mixed
     */
    public function offsetUnset($offset){}
}