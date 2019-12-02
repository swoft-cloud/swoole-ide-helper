<?php /** @noinspection ALL - For disable PhpStorm check */

namespace Swoole;

/**
 * @since 4.4.12
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
    public function length(): int{}

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
    public function lower(): self{}

    /**
     * @return self
     */
    public function upper(): self{}

    /**
     * @return self
     */
    public function trim(): self{}

    /**
     * @return self
     */
    public function lrim(): self{}

    /**
     * @return self
     */
    public function rtrim(): self{}

    /**
     * @param int $offset
     * @param ...$length
     * @return self
     */
    public function substr(int $offset, ...$length): self{}

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
    public function replace(string $search, string $replace, $count = null): self{}

    /**
     * @param string $needle
     * @return bool
     */
    public function startsWith(string $needle): bool{}

    /**
     * @param string $subString
     * @return bool
     */
    public function contains(string $subString): bool{}

    /**
     * @param string $needle
     * @return bool
     */
    public function endsWith(string $needle): bool{}

    /**
     * @param string $delimiter
     * @param int $limit
     * @return \Swoole\ArrayObject
     */
    public function split(string $delimiter, int $limit = PHP_INT_MAX): \Swoole\ArrayObject{}

    /**
     * @param int $index
     * @return string
     */
    public function char(int $index): string{}

    /**
     * @param int $chunkLength
     * @param string $chunkEnd
     * @return self
     */
    public function chunkSplit(int $chunkLength = 1, string $chunkEnd = ''): self{}

    /**
     * @param $splitLength
     * @return \Swoole\ArrayObject
     */
    public function chunk($splitLength = 1): \Swoole\ArrayObject{}

    /**
     * @return mixed
     */
    public function toString(){}

    /**
     * @return string
     */
    public function __toString(): string{}

    /**
     * @param array $value
     * @return \Swoole\ArrayObject
     */
    protected static function detectArrayType(array $value): \Swoole\ArrayObject{}
}