<?php
namespace Swoole\Coroutine;

/**
 * @since 4.4.2
 */
class Iterator extends \ArrayIterator
{
    // constants of the class Iterator
    public const STD_PROP_LIST = 1;
    public const ARRAY_AS_PROPS = 2;


    /**
     * @param $array [optional]
     * @param $ar_flags [optional]
     * @return mixed
     */
    public function __construct($array = null, $ar_flags = null){}

    /**
     * @param $index
     * @return mixed
     */
    public function offsetExists($index){}

    /**
     * @param $index
     * @return mixed
     */
    public function offsetGet($index){}

    /**
     * @param $index
     * @param $newval
     * @return mixed
     */
    public function offsetSet($index, $newval){}

    /**
     * @param $index
     * @return mixed
     */
    public function offsetUnset($index){}

    /**
     * @param $value
     * @return mixed
     */
    public function append($value){}

    /**
     * @return mixed
     */
    public function getArrayCopy(){}

    /**
     * @return mixed
     */
    public function count(){}

    /**
     * @return mixed
     */
    public function getFlags(){}

    /**
     * @param $flags
     * @return mixed
     */
    public function setFlags($flags){}

    /**
     * @return mixed
     */
    public function asort(){}

    /**
     * @return mixed
     */
    public function ksort(){}

    /**
     * @param $cmp_function
     * @return mixed
     */
    public function uasort($cmp_function){}

    /**
     * @param $cmp_function
     * @return mixed
     */
    public function uksort($cmp_function){}

    /**
     * @return mixed
     */
    public function natsort(){}

    /**
     * @return mixed
     */
    public function natcasesort(){}

    /**
     * @param $serialized
     * @return mixed
     */
    public function unserialize($serialized){}

    /**
     * @return mixed
     */
    public function serialize(){}

    /**
     * @return mixed
     */
    public function rewind(){}

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
    public function next(){}

    /**
     * @return mixed
     */
    public function valid(){}

    /**
     * @param $position
     * @return mixed
     */
    public function seek($position){}
}
