<?php
namespace Swoole\Table;

/**
 * @since 4.4.2
 */
class Row
{

    public $key;
    public $value;

    /**
     * @param int $offset [required]
     * @return mixed
     */
    public function offsetExists(int $offset){}

    /**
     * @param int $offset [required]
     * @return mixed
     */
    public function offsetGet(int $offset){}

    /**
     * @param int $offset [required]
     * @param $value [required]
     * @return mixed
     */
    public function offsetSet(int $offset, $value){}

    /**
     * @param int $offset [required]
     * @return mixed
     */
    public function offsetUnset(int $offset){}

    /**
     * @return mixed
     */
    public function __destruct(){}


}
