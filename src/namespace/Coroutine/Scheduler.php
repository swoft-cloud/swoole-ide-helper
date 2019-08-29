<?php
namespace Swoole\Coroutine;

/**
 * @since 4.4.2
 */
class Scheduler
{

    private $_list;

    /**
     * @param mixed $func [required]
     * @param array $params [optional]
     * @return mixed
     */
    public function add($func, array $params = null){}

    /**
     * @param $n [required]
     * @param mixed $func [optional]
     * @param array $params [optional]
     * @return mixed
     */
    public function parallel($n, $func = null, array $params = null){}

    /**
     * @param array $settings [required]
     * @return mixed
     */
    public function set(array $settings){}

    /**
     * @return mixed
     */
    public function start(){}


}
