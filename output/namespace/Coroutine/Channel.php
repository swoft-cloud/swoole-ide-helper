<?php /** @noinspection ALL - For disable PhpStorm check */

namespace Swoole\Coroutine;

/**
 * @since 4.4.12
 */
class Channel
{

    // property of the class Channel
    public $capacity;
    public $errCode;

    /**
     * @param int $size
     * @return mixed
     */
    public function __construct(int $size = null){}

    /**
     * @param mixed $data
     * @param float $timeout
     * @return mixed
     */
    public function push($data, float $timeout = null){}

    /**
     * @param float $timeout
     * @return mixed
     */
    public function pop(float $timeout = null){}

    /**
     * @return bool
     */
    public function isEmpty(): bool{}

    /**
     * @return bool
     */
    public function isFull(): bool{}

    /**
     * @return mixed
     */
    public function close(){}

    /**
     * @return mixed
     */
    public function stats(){}

    /**
     * @return mixed
     */
    public function length(){}
}