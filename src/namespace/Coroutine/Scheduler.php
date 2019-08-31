<?php
namespace Swoole\Coroutine;

/**
 * @since 4.4.5
 */
class Scheduler
{

    // property of the class Scheduler
    private $_list;

    /**
     * @param mixed $func
     * @param array $params
     * @return mixed
     */
    public function add($func, array $params = null){}

    /**
     * @param $n
     * @param mixed $func
     * @param array $params
     * @return mixed
     */
    public function parallel($n, $func = null, array $params = null){}

    /**
     * @param array $settings
     * @return mixed
     */
    public function set(array $settings){}

    /**
     * @return mixed
     */
    public function start(){}
}
