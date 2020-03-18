<?php

namespace Swoole\Coroutine;

/**
 * @since 4.4.16
 */
class Iterator extends \ArrayIterator implements \Countable, \Serializable, \SeekableIterator, \ArrayAccess
{
    // constants of the class Iterator
    public const STD_PROP_LIST = 1;
    public const ARRAY_AS_PROPS = 2;



}