<?php
namespace Swoole\Coroutine\Http\Client;

/**
 * @since 4.4.5
 */
class Exception extends \Swoole\Exception
{

    // property of the class Exception
    protected $message;
    protected $code;
    protected $file;
    protected $line;

    /**
     * @param string $message
     * @param $code
     * @param $previous
     * @return mixed
     */
    public function __construct(string $message = null, $code = null, $previous = null){}

    /**
     * @return mixed
     */
    public function __wakeup(){}

    /**
     * @return mixed
     */
    public function __toString(){}
}
