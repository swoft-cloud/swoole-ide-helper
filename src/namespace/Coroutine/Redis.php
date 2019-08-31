<?php
namespace Swoole\Coroutine;

/**
 * @since 4.4.5
 */
class Redis
{

    // property of the class Redis
    public $host;
    public $port;
    public $setting;
    public $sock;
    public $connected;
    public $errType;
    public $errCode;
    public $errMsg;

    /**
     * @param $config
     * @return mixed
     */
    public function __construct($config = null){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param string $host
     * @param int $port
     * @param $serialize
     * @return mixed
     */
    public function connect(string $host, int $port = null, $serialize = null){}

    /**
     * @return mixed
     */
    public function getAuth(){}

    /**
     * @return mixed
     */
    public function getDBNum(){}

    /**
     * @return mixed
     */
    public function getOptions(){}

    /**
     * @param array $options
     * @return mixed
     */
    public function setOptions(array $options){}

    /**
     * @return mixed
     */
    public function getDefer(){}

    /**
     * @param $defer
     * @return mixed
     */
    public function setDefer($defer){}

    /**
     * @return mixed
     */
    public function recv(){}

    /**
     * @param array $params
     * @return mixed
     */
    public function request(array $params){}

    /**
     * @return mixed
     */
    public function close(){}

    /**
     * @param $key
     * @param $value
     * @param float $timeout
     * @param $opt
     * @return mixed
     */
    public function set($key, $value, float $timeout = null, $opt = null){}

    /**
     * @param $key
     * @param int $offset
     * @param $value
     * @return mixed
     */
    public function setBit($key, int $offset, $value){}

    /**
     * @param $key
     * @param $expire
     * @param $value
     * @return mixed
     */
    public function setEx($key, $expire, $value){}

    /**
     * @param $key
     * @param $expire
     * @param $value
     * @return mixed
     */
    public function psetEx($key, $expire, $value){}

    /**
     * @param $key
     * @param $index
     * @param $value
     * @return mixed
     */
    public function lSet($key, $index, $value){}

    /**
     * @param $key
     * @return mixed
     */
    public function get($key){}

    /**
     * @param $keys
     * @return mixed
     */
    public function mGet($keys){}

    /**
     * @param $key
     * @param $other_keys
     * @return mixed
     */
    public function del($key, $other_keys = null){}

    /**
     * @param $key
     * @param $member
     * @param $other_members
     * @return mixed
     */
    public function hDel($key, $member, $other_members = null){}

    /**
     * @param $key
     * @param $member
     * @param $value
     * @return mixed
     */
    public function hSet($key, $member, $value){}

    /**
     * @param $key
     * @param $pairs
     * @return mixed
     */
    public function hMSet($key, $pairs){}

    /**
     * @param $key
     * @param $member
     * @param $value
     * @return mixed
     */
    public function hSetNx($key, $member, $value){}

    /**
     * @param $key
     * @param $other_keys
     * @return mixed
     */
    public function delete($key, $other_keys = null){}

    /**
     * @param $pairs
     * @return mixed
     */
    public function mSet($pairs){}

    /**
     * @param $pairs
     * @return mixed
     */
    public function mSetNx($pairs){}

    /**
     * @param string $pattern
     * @return mixed
     */
    public function getKeys(string $pattern){}

    /**
     * @param string $pattern
     * @return mixed
     */
    public function keys(string $pattern){}

    /**
     * @param $key
     * @param $other_keys
     * @return mixed
     */
    public function exists($key, $other_keys = null){}

    /**
     * @param $key
     * @return mixed
     */
    public function type($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function strLen($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function lPop($key){}

    /**
     * @param $key
     * @param $timeout_or_key
     * @param $extra_args
     * @return mixed
     */
    public function blPop($key, $timeout_or_key, $extra_args = null){}

    /**
     * @param $key
     * @return mixed
     */
    public function rPop($key){}

    /**
     * @param $key
     * @param $timeout_or_key
     * @param $extra_args
     * @return mixed
     */
    public function brPop($key, $timeout_or_key, $extra_args = null){}

    /**
     * @param $src
     * @param $dst
     * @param float $timeout
     * @return mixed
     */
    public function bRPopLPush($src, $dst, float $timeout){}

    /**
     * @param $key
     * @return mixed
     */
    public function lSize($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function lLen($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function sSize($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function scard($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function sPop($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function sMembers($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function sGetMembers($key){}

    /**
     * @param $key
     * @param $count
     * @return mixed
     */
    public function sRandMember($key, $count = null){}

    /**
     * @param $key
     * @return mixed
     */
    public function persist($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function ttl($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function pttl($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function zCard($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function zSize($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function hLen($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function hKeys($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function hVals($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function hGetAll($key){}

    /**
     * @param $key
     * @return mixed
     */
    public function debug($key){}

    /**
     * @param $ttl
     * @param $key
     * @param $value
     * @return mixed
     */
    public function restore($ttl, $key, $value){}

    /**
     * @param $key
     * @return mixed
     */
    public function dump($key){}

    /**
     * @param $key
     * @param $newkey
     * @return mixed
     */
    public function renameKey($key, $newkey){}

    /**
     * @param $key
     * @param $newkey
     * @return mixed
     */
    public function rename($key, $newkey){}

    /**
     * @param $key
     * @param $newkey
     * @return mixed
     */
    public function renameNx($key, $newkey){}

    /**
     * @param $src
     * @param $dst
     * @return mixed
     */
    public function rpoplpush($src, $dst){}

    /**
     * @return mixed
     */
    public function randomKey(){}

    /**
     * @param $key
     * @param $elements
     * @return mixed
     */
    public function pfadd($key, $elements){}

    /**
     * @param $key
     * @return mixed
     */
    public function pfcount($key){}

    /**
     * @param $dstkey
     * @param $keys
     * @return mixed
     */
    public function pfmerge($dstkey, $keys){}

    /**
     * @return mixed
     */
    public function ping(){}

    /**
     * @param string $password
     * @return mixed
     */
    public function auth(string $password){}

    /**
     * @return mixed
     */
    public function unwatch(){}

    /**
     * @param $key
     * @param $other_keys
     * @return mixed
     */
    public function watch($key, $other_keys = null){}

    /**
     * @return mixed
     */
    public function save(){}

    /**
     * @return mixed
     */
    public function bgSave(){}

    /**
     * @return mixed
     */
    public function lastSave(){}

    /**
     * @return mixed
     */
    public function flushDB(){}

    /**
     * @return mixed
     */
    public function flushAll(){}

    /**
     * @return mixed
     */
    public function dbSize(){}

    /**
     * @return mixed
     */
    public function bgrewriteaof(){}

    /**
     * @return mixed
     */
    public function time(){}

    /**
     * @return mixed
     */
    public function role(){}

    /**
     * @param $key
     * @param int $offset
     * @param $value
     * @return mixed
     */
    public function setRange($key, int $offset, $value){}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function setNx($key, $value){}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function getSet($key, $value){}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function append($key, $value){}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function lPushx($key, $value){}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function lPush($key, $value){}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function rPush($key, $value){}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function rPushx($key, $value){}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function sContains($key, $value){}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function sismember($key, $value){}

    /**
     * @param $key
     * @param $member
     * @return mixed
     */
    public function zScore($key, $member){}

    /**
     * @param $key
     * @param $member
     * @return mixed
     */
    public function zRank($key, $member){}

    /**
     * @param $key
     * @param $member
     * @return mixed
     */
    public function zRevRank($key, $member){}

    /**
     * @param $key
     * @param $member
     * @return mixed
     */
    public function hGet($key, $member){}

    /**
     * @param $key
     * @param $keys
     * @return mixed
     */
    public function hMGet($key, $keys){}

    /**
     * @param $key
     * @param $member
     * @return mixed
     */
    public function hExists($key, $member){}

    /**
     * @param $channel
     * @param string $message
     * @return mixed
     */
    public function publish($channel, string $message){}

    /**
     * @param $key
     * @param $value
     * @param $member
     * @return mixed
     */
    public function zIncrBy($key, $value, $member){}

    /**
     * @param $key
     * @param $score
     * @param $value
     * @return mixed
     */
    public function zAdd($key, $score, $value){}

    /**
     * @param $key
     * @param $count
     * @return mixed
     */
    public function zPopMin($key, $count){}

    /**
     * @param $key
     * @param $count
     * @return mixed
     */
    public function zPopMax($key, $count){}

    /**
     * @param $key
     * @param $timeout_or_key
     * @param $extra_args
     * @return mixed
     */
    public function bzPopMin($key, $timeout_or_key, $extra_args = null){}

    /**
     * @param $key
     * @param $timeout_or_key
     * @param $extra_args
     * @return mixed
     */
    public function bzPopMax($key, $timeout_or_key, $extra_args = null){}

    /**
     * @param $key
     * @param $min
     * @param $max
     * @return mixed
     */
    public function zDeleteRangeByScore($key, $min, $max){}

    /**
     * @param $key
     * @param $min
     * @param $max
     * @return mixed
     */
    public function zRemRangeByScore($key, $min, $max){}

    /**
     * @param $key
     * @param $min
     * @param $max
     * @return mixed
     */
    public function zCount($key, $min, $max){}

    /**
     * @param $key
     * @param $start
     * @param $end
     * @param $scores
     * @return mixed
     */
    public function zRange($key, $start, $end, $scores = null){}

    /**
     * @param $key
     * @param $start
     * @param $end
     * @param $scores
     * @return mixed
     */
    public function zRevRange($key, $start, $end, $scores = null){}

    /**
     * @param $key
     * @param $start
     * @param $end
     * @param array $options
     * @return mixed
     */
    public function zRangeByScore($key, $start, $end, array $options = null){}

    /**
     * @param $key
     * @param $start
     * @param $end
     * @param array $options
     * @return mixed
     */
    public function zRevRangeByScore($key, $start, $end, array $options = null){}

    /**
     * @param $key
     * @param $min
     * @param $max
     * @param int $offset
     * @param int $limit
     * @return mixed
     */
    public function zRangeByLex($key, $min, $max, int $offset = null, int $limit = null){}

    /**
     * @param $key
     * @param $min
     * @param $max
     * @param int $offset
     * @param int $limit
     * @return mixed
     */
    public function zRevRangeByLex($key, $min, $max, int $offset = null, int $limit = null){}

    /**
     * @param $key
     * @param $keys
     * @param $weights
     * @param $aggregate
     * @return mixed
     */
    public function zInter($key, $keys, $weights = null, $aggregate = null){}

    /**
     * @param $key
     * @param $keys
     * @param $weights
     * @param $aggregate
     * @return mixed
     */
    public function zinterstore($key, $keys, $weights = null, $aggregate = null){}

    /**
     * @param $key
     * @param $keys
     * @param $weights
     * @param $aggregate
     * @return mixed
     */
    public function zUnion($key, $keys, $weights = null, $aggregate = null){}

    /**
     * @param $key
     * @param $keys
     * @param $weights
     * @param $aggregate
     * @return mixed
     */
    public function zunionstore($key, $keys, $weights = null, $aggregate = null){}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function incrBy($key, $value){}

    /**
     * @param $key
     * @param $member
     * @param $value
     * @return mixed
     */
    public function hIncrBy($key, $member, $value){}

    /**
     * @param $key
     * @return mixed
     */
    public function incr($key){}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function decrBy($key, $value){}

    /**
     * @param $key
     * @return mixed
     */
    public function decr($key){}

    /**
     * @param $key
     * @param int $offset
     * @return mixed
     */
    public function getBit($key, int $offset){}

    /**
     * @param $key
     * @param $position
     * @param $pivot
     * @param $value
     * @return mixed
     */
    public function lInsert($key, $position, $pivot, $value){}

    /**
     * @param $key
     * @param $index
     * @return mixed
     */
    public function lGet($key, $index){}

    /**
     * @param $key
     * @param $integer
     * @return mixed
     */
    public function lIndex($key, $integer){}

    /**
     * @param $key
     * @param float $timeout
     * @return mixed
     */
    public function setTimeout($key, float $timeout){}

    /**
     * @param $key
     * @param $integer
     * @return mixed
     */
    public function expire($key, $integer){}

    /**
     * @param $key
     * @param $timestamp
     * @return mixed
     */
    public function pexpire($key, $timestamp){}

    /**
     * @param $key
     * @param $timestamp
     * @return mixed
     */
    public function expireAt($key, $timestamp){}

    /**
     * @param $key
     * @param $timestamp
     * @return mixed
     */
    public function pexpireAt($key, $timestamp){}

    /**
     * @param $key
     * @param $dbindex
     * @return mixed
     */
    public function move($key, $dbindex){}

    /**
     * @param $dbindex
     * @return mixed
     */
    public function select($dbindex){}

    /**
     * @param $key
     * @param $start
     * @param $end
     * @return mixed
     */
    public function getRange($key, $start, $end){}

    /**
     * @param $key
     * @param $start
     * @param $stop
     * @return mixed
     */
    public function listTrim($key, $start, $stop){}

    /**
     * @param $key
     * @param $start
     * @param $stop
     * @return mixed
     */
    public function ltrim($key, $start, $stop){}

    /**
     * @param $key
     * @param $start
     * @param $end
     * @return mixed
     */
    public function lGetRange($key, $start, $end){}

    /**
     * @param $key
     * @param $start
     * @param $end
     * @return mixed
     */
    public function lRange($key, $start, $end){}

    /**
     * @param $key
     * @param $value
     * @param $count
     * @return mixed
     */
    public function lRem($key, $value, $count){}

    /**
     * @param $key
     * @param $value
     * @param $count
     * @return mixed
     */
    public function lRemove($key, $value, $count){}

    /**
     * @param $key
     * @param $start
     * @param $end
     * @return mixed
     */
    public function zDeleteRangeByRank($key, $start, $end){}

    /**
     * @param $key
     * @param $min
     * @param $max
     * @return mixed
     */
    public function zRemRangeByRank($key, $min, $max){}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function incrByFloat($key, $value){}

    /**
     * @param $key
     * @param $member
     * @param $value
     * @return mixed
     */
    public function hIncrByFloat($key, $member, $value){}

    /**
     * @param $key
     * @return mixed
     */
    public function bitCount($key){}

    /**
     * @param $operation
     * @param $ret_key
     * @param $key
     * @param $other_keys
     * @return mixed
     */
    public function bitOp($operation, $ret_key, $key, $other_keys = null){}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function sAdd($key, $value){}

    /**
     * @param $src
     * @param $dst
     * @param $value
     * @return mixed
     */
    public function sMove($src, $dst, $value){}

    /**
     * @param $key
     * @param $other_keys
     * @return mixed
     */
    public function sDiff($key, $other_keys = null){}

    /**
     * @param $dst
     * @param $key
     * @param $other_keys
     * @return mixed
     */
    public function sDiffStore($dst, $key, $other_keys = null){}

    /**
     * @param $key
     * @param $other_keys
     * @return mixed
     */
    public function sUnion($key, $other_keys = null){}

    /**
     * @param $dst
     * @param $key
     * @param $other_keys
     * @return mixed
     */
    public function sUnionStore($dst, $key, $other_keys = null){}

    /**
     * @param $key
     * @param $other_keys
     * @return mixed
     */
    public function sInter($key, $other_keys = null){}

    /**
     * @param $dst
     * @param $key
     * @param $other_keys
     * @return mixed
     */
    public function sInterStore($dst, $key, $other_keys = null){}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function sRemove($key, $value){}

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function srem($key, $value){}

    /**
     * @param $key
     * @param $member
     * @param $other_members
     * @return mixed
     */
    public function zDelete($key, $member, $other_members = null){}

    /**
     * @param $key
     * @param $member
     * @param $other_members
     * @return mixed
     */
    public function zRemove($key, $member, $other_members = null){}

    /**
     * @param $key
     * @param $member
     * @param $other_members
     * @return mixed
     */
    public function zRem($key, $member, $other_members = null){}

    /**
     * @param $patterns
     * @return mixed
     */
    public function pSubscribe($patterns){}

    /**
     * @param $channels
     * @return mixed
     */
    public function subscribe($channels){}

    /**
     * @param $channels
     * @return mixed
     */
    public function unsubscribe($channels){}

    /**
     * @param $patterns
     * @return mixed
     */
    public function pUnSubscribe($patterns){}

    /**
     * @return mixed
     */
    public function multi(){}

    /**
     * @return mixed
     */
    public function exec(){}

    /**
     * @param $script
     * @param $args
     * @param $num_keys
     * @return mixed
     */
    public function eval($script, $args = null, $num_keys = null){}

    /**
     * @param $script_sha
     * @param $args
     * @param $num_keys
     * @return mixed
     */
    public function evalSha($script_sha, $args = null, $num_keys = null){}

    /**
     * @param $cmd
     * @param $args
     * @return mixed
     */
    public function script($cmd, $args = null){}
}
