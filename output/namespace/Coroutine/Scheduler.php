<?php
/**
 * @noinspection ALL - For disable PhpStorm check
 */

namespace Swoole\Coroutine;

/**
 * @since 4.4.6
 */
class Scheduler
{

    // property of the class Scheduler
    private $_list;

    /**
     * @param callable $func
     * @param array $params
     * @return mixed
     */
    public function add(callable $func, array $params = null){}

    /**
     * @param $n
     * @param callable $func
     * @param array $params
     * @return mixed
     */
    public function parallel($n, callable $func = null, array $params = null){}

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
