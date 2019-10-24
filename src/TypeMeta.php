<?php declare(strict_types=1);

namespace IDEHelper;

use Swoole\Coroutine;
use Swoole\Coroutine\Channel;
use Swoole\Process;
use Swoole\Websocket\CloseFrame;

/**
 * Class TypeMeta
 */
final class TypeMeta
{
    /**
     * @var array All int arguments name list
     */
    public const INT = [
        'port',
        'fd',
        'pid',
        'uid',
        'conn_fd',
        'offset',
        'worker_id',
        'dst_worker_id',
        'reactor_id',
        'timer_id',
        'length',
        'opcode',
        'len',
        'chunk_size',
        'size',
        'worker_num',
        'signal_no',
        'start_fd',
        'find_count',
        'ms',
        'cid',
        'limit',
        'exit_code',
        'pipe_type',
        'server_socket',
        'ipc_type',
        'msgqueue_key',
        'backlog',
        'http_code',
    ];

    /**
     * @var array All float arguments name list
     */
    public const FLOAT = [
        'timeout',
    ];

    /**
     * @var array All bool arguments name list
     */
    public const BOOL  = [
        'finish',
        'reset',
        'blocking',
        'is_protected',
        'enable_coroutine',
        'redirect_stdin_and_stdout',
    ];

    /**
     * @var array All array arguments name list
     */
    public const ARRAY = [
        'settings',
        'read_array',
        'write_array',
        'error_array',
        'headers',
        'cookies',
        'params',
        'options',
        'server_config',
    ];

    /**
     * @var array All string arguments name list
     */
    public const STRING = [
        'ip',
        'sql',
        'key',
        'host',
        'path',
        'name',
        'field',
        'domain',
        'string',
        'method',
        'reason',
        'address',
        'command',
        'message',
        'content',
        'filename',
        'hostname',
        'send_data',
        'event_name',
        'domain_name',
        'process_name',
        'iterator_class',
        'username',
        'password',
        'pattern',
        'location',
    ];

    public const MIXED = [
        'data',
    ];

    public static $classMapping = [
        'swoole_process'              => Process::class,
        'co'                          => Coroutine::class,
        'chan'                        => Channel::class,
        'swoole_websocket_closeframe' => CloseFrame::class,
    ];
}
