<?php

namespace Swoole\Coroutine;

/**
 * @since 4.4.16
 */
class Context extends \ArrayObject implements \Countable, \Serializable, \ArrayAccess, \IteratorAggregate
{
    // constants of the class Context
    public const STD_PROP_LIST = 1;
    public const ARRAY_AS_PROPS = 2;



}