<?php
namespace Swoole;

/**
 * @since 4.4.5
 */
class Error extends \Error
{

    // property of the class Error
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
