<?php
/**
 * @noinspection ALL - For disable PhpStorm check
 */

namespace Swoole;

/**
 * @since 4.4.6
 */
class Table
{
    // constants of the class Table
    public const TYPE_INT = 1;
    public const TYPE_STRING = 7;
    public const TYPE_FLOAT = 6;


    /**
     * @param $table_size
     * @param $conflict_proportion
     * @return mixed
     */
    public function __construct($table_size, $conflict_proportion = null){}

    /**
     * @param string $name
     * @param $type
     * @param int $size
     * @return mixed
     */
    public function column(string $name, $type, int $size = null){}

    /**
     * @return mixed
     */
    public function create(){}

    /**
     * @return mixed
     */
    public function destroy(){}

    /**
     * @param $key
     * @param array $value
     * @return mixed
     */
    public function set($key, array $value){}

    /**
     * @param $key
     * @param $field
     * @return mixed
     */
    public function get($key, $field = null){}

    /**
     * @return mixed
     */
    public function count(){}

    /**
     * @param $key
     * @return mixed
     */
    public function del($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function exists($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function exist($key){}

    /**
     * @param $key
     * @param $column
     * @param $incrby
     * @return mixed
     */
    public function incr($key, $column, $incrby = null){}

    /**
     * @param $key
     * @param $column
     * @param $decrby
     * @return mixed
     */
    public function decr($key, $column, $decrby = null){}

    /**
     * @return mixed
     */
    public function getMemorySize(){}

    /**
     * @param int $offset
     * @return mixed
     */
    public function offsetExists(int $offset){}

    /**
     * @param int $offset
     * @return mixed
     */
    public function offsetGet(int $offset){}

    /**
     * @param int $offset
     * @param $value
     * @return mixed
     */
    public function offsetSet(int $offset, $value){}

    /**
     * @param int $offset
     * @return mixed
     */
    public function offsetUnset(int $offset){}

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
}
