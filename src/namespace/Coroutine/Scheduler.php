<?php
namespace Swoole\Coroutine;

/**
 * @since 4.4.0
 */
class Scheduler
{

    private $_list;

    /**
     * @param $func [required]
     * @param $params [optional]
     * @return mixed
     */
    public function add($func, array $params=null){}

    /**
     * @param $n [required]
     * @param $func [optional]
     * @param $params [optional]
     * @return mixed
     */
    public function parallel($n, $func=null, array $params=null){}

    /**
     * @param $settings [required]
     * @return mixed
     */
    public function set(array $settings){}

    /**
     * @return mixed
     */
    public function start(){}


}
