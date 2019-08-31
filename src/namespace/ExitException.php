<?php
namespace Swoole;

/**
 * @since 4.4.5
 */
class ExitException extends \Swoole\Exception
{

    // property of the class ExitException
    protected $message;
    protected $code;
    protected $file;
    protected $line;
    private $flags;
    private $status;

    /**
     * @return mixed
     */
    public function getFlags(){}

    /**
     * @return mixed
     */
    public function getStatus(){}

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
