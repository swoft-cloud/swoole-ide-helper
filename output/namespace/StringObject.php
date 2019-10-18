<?php /** @noinspection ALL - For disable PhpStorm check */

namespace Swoole;

/**
 * @since 4.4.8
 */
class StringObject
{

    // property of the class StringObject
    protected $string;

    /**
     * @param string $string
     * @return mixed
     */
    public function __construct(string $string = ''){}

    /**
     * @return int
     */
    public function length(){}

    /**
     * @param string $needle
     * @param int $offset
     * @return mixed
     */
    public function indexOf(string $needle, int $offset = 0){}

    /**
     * @param string $needle
     * @param int $offset
     * @return mixed
     */
    public function lastIndexOf(string $needle, int $offset = 0){}

    /**
     * @param string $needle
     * @param int $offset
     * @return mixed
     */
    public function pos(string $needle, int $offset = 0){}

    /**
     * @param string $needle
     * @param int $offset
     * @return mixed
     */
    public function rpos(string $needle, int $offset = 0){}

    /**
     * @param string $needle
     * @return mixed
     */
    public function ipos(string $needle){}

    /**
     * @return self
     */
    public function lower(){}

    /**
     * @return self
     */
    public function upper(){}

    /**
     * @return self
     */
    public function trim(){}

    /**
     * @return self
     */
    public function lrim(){}

    /**
     * @return self
     */
    public function rtrim(){}

    /**
     * @param int $offset
     * @param ...$length
     * @return self
     */
    public function substr(int $offset, ...$length){}

    /**
     * @param $n
     * @return mixed
     */
    public function repeat($n){}

    /**
     * @param string $search
     * @param string $replace
     * @param $count
     * @return self
     */
    public function replace(string $search, string $replace, $count = null){}

    /**
     * @param string $needle
     * @return bool
     */
    public function startsWith(string $needle){}

    /**
     * @param string $subString
     * @return bool
     */
    public function contains(string $subString){}

    /**
     * @param string $needle
     * @return bool
     */
    public function endsWith(string $needle){}

    /**
     * @param string $delimiter
     * @param int $limit
     * @return \Swoole\ArrayObject
     */
    public function split(string $delimiter, int $limit = PHP_INT_MAX){}

    /**
     * @param int $index
     * @return string
     */
    public function char(int $index){}

    /**
     * @param int $chunkLength
     * @param string $chunkEnd
     * @return self
     */
    public function chunkSplit(int $chunkLength = 1, string $chunkEnd = ''){}

    /**
     * @param $splitLength
     * @return \Swoole\ArrayObject
     */
    public function chunk($splitLength = 1){}

    /**
     * @return mixed
     */
    public function toString(){}

    /**
     * @return string
     */
    public function __toString(){}

    /**
     * @param array $value
     * @return \Swoole\ArrayObject
     */
    protected static function detectArrayType(array $value){}
}