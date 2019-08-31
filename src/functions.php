<?php
function swoole_version(){}

function swoole_cpu_num(){}

function swoole_last_error(){}

/**
 * @param string $domain_name
 * @param float $timeout
 * @return mixed
 */
function swoole_async_dns_lookup_coro(string $domain_name, float $timeout = null){}

/**
 * @param array $settings
 * @return mixed
 */
function swoole_async_set(array $settings){}

/**
 * @param mixed $func
 * @param array $params
 * @return mixed
 */
function swoole_coroutine_create($func, array $params = null){}

/**
 * @param mixed $callback
 * @return mixed
 */
function swoole_coroutine_defer($callback){}

/**
 * @param mixed $func
 * @param array $params
 * @return mixed
 */
function go($func, array $params = null){}

/**
 * @param mixed $callback
 * @return mixed
 */
function defer($callback){}

/**
 * @param array $read_array
 * @param array $write_array
 * @param array $error_array
 * @param float $timeout
 * @return mixed
 */
function swoole_client_select(array $read_array, array $write_array, array $error_array, float $timeout = null){}

/**
 * @param array $read_array
 * @param array $write_array
 * @param array $error_array
 * @param float $timeout
 * @return mixed
 */
function swoole_select(array $read_array, array $write_array, array $error_array, float $timeout = null){}

/**
 * @param string $process_name
 * @return mixed
 */
function swoole_set_process_name(string $process_name){}

function swoole_get_local_ip(){}

function swoole_get_local_mac(){}

/**
 * @param $errno
 * @param $error_type
 * @return mixed
 */
function swoole_strerror($errno, $error_type = null){}

function swoole_errno(){}

/**
 * @param mixed $data
 * @param $type
 * @return mixed
 */
function swoole_hashcode($data, $type = null){}

/**
 * @param string $filename
 * @return mixed
 */
function swoole_get_mime_type(string $filename){}

function swoole_clear_dns_cache(){}

function swoole_internal_call_user_shutdown_begin(){}

/**
 * @param int $fd
 * @param mixed $read_callback
 * @param mixed $write_callback
 * @param $events
 * @return mixed
 */
function swoole_event_add(int $fd, $read_callback, $write_callback = null, $events = null){}

/**
 * @param int $fd
 * @return mixed
 */
function swoole_event_del(int $fd){}

/**
 * @param int $fd
 * @param mixed $read_callback
 * @param mixed $write_callback
 * @param $events
 * @return mixed
 */
function swoole_event_set(int $fd, $read_callback = null, $write_callback = null, $events = null){}

/**
 * @param int $fd
 * @param $events
 * @return mixed
 */
function swoole_event_isset(int $fd, $events = null){}

function swoole_event_dispatch(){}

/**
 * @param mixed $callback
 * @return mixed
 */
function swoole_event_defer($callback){}

/**
 * @param mixed $callback
 * @param $before
 * @return mixed
 */
function swoole_event_cycle($callback, $before = null){}

/**
 * @param int $fd
 * @param mixed $data
 * @return mixed
 */
function swoole_event_write(int $fd, $data){}

function swoole_event_wait(){}

function swoole_event_exit(){}

/**
 * @param array $settings
 * @return mixed
 */
function swoole_timer_set(array $settings){}

/**
 * @param int $ms
 * @param mixed $callback
 * @return mixed
 */
function swoole_timer_after(int $ms, $callback){}

/**
 * @param int $ms
 * @param mixed $callback
 * @return mixed
 */
function swoole_timer_tick(int $ms, $callback){}

/**
 * @param int $timer_id
 * @return mixed
 */
function swoole_timer_exists(int $timer_id){}

/**
 * @param int $timer_id
 * @return mixed
 */
function swoole_timer_info(int $timer_id){}

function swoole_timer_stats(){}

function swoole_timer_list(){}

/**
 * @param int $timer_id
 * @return mixed
 */
function swoole_timer_clear(int $timer_id){}

function swoole_timer_clear_all(){}

