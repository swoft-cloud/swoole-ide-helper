<?php /** @noinspection ALL - For disable PhpStorm check */

namespace Swoole\Coroutine;

/**
 * @since 4.4.12
 */
class WaitGroup
{

    // property of the class WaitGroup
    protected $chan;
    protected $count;
    protected $waiting;

    /**
     * @return mixed
     */
    public function __construct(){}

    /**
     * @param int $delta
     * @return void
     */
    public function add(int $delta = 1): void{}

    /**
     * @return void
     */
    public function done(): void{}

    /**
     * @param float $timeout
     * @return bool
     */
    public function wait(float $timeout = -1): bool{}
}