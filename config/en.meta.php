<?php

return [
    // Class
    'Swoole\\Server'                    => [
        // class prop
        '$setting'     => 'array',
        '$master_pid'  => 'int:当前服务器主进程的PID',
        '$manager_pid' => 'int:当前服务器管理进程的PID',
        '$worker_id'   => 'int',
        '$worker_pid'  => 'int',
        '$taskworker'  => 'bool',
        '$connections' => 'Swoole\\Coroutine\\Iterator:TCP连接迭代器',
        '$ports'       => 'Swoole\\Server\\Port[]:监听端口数组',
        '__construct'  => [
            '$host'      => 'string',
            '$port'      => 'int(0)',
            '$mode'      => 'int(SWOOLE_PROCESS)',
            '$sock_type' => 'int(SWOOLE_SOCK_TCP)',
        ],
        'addlistener'  => [
            '$host'      => 'string',
            '$port'      => 'int(0)',
            '$sock_type' => 'int(SWOOLE_SOCK_TCP)',
        ],
        'sendMessage'  => [
            '$message' => 'mixed',
        ],
        'addProcess'   => [
            '$process' => '\\Swoole\\Process',
        ],
        'send'         => [
            // description for method
            'desc'           => 'send data to the client',
            // method return
            'return'         => 'bool:If success return True, fail return False',
            // method params
            '$fd'            => 'int|string', // 允许定义联合类型
            '$data'          => 'string', // 允许没有默认值
            '$server_socket' => 'int(-1)', // 允许没有注释
        ],
    ],
    'Swoole\\Process'                   => [
        'exportSocket' => [
            'return' => '\\Swoole\\Coroutine\\Socket',
        ],
        'signal'       => [
            '$callback' => 'callable',
        ],
    ],
    'Swoole\\Coroutine'                 => [
        'defer'        => [
            '$callback' => 'callback',
        ],
        'list'         => [
            'return' => 'Swoole\Coroutine\Iterator',
        ],
        'getBackTrace' => [
            'return'   => 'array|false',
            '$cid'     => 'int',
            '$options' => 'int',
            '$limit'   => 'int',
        ],
    ],
    'Swoole\\Coroutine\\Channel'        => [
        'isEmpty' => [
            'return' => 'bool',
        ],
        'isFull'  => [
            'return' => 'bool',
        ],
    ],
    // Func
    'Func:swoole_async_dns_lookup_coro' => [
        'desc'         => '协程DNS查询',
        // func return
        'return'       => 'string|false:失败返回false，可使用swoole_errno和swoole_last_error得到错误信息',
        // func params
        '$domain_name' => 'string:域名',
        '$timeout'     => 'float:设置超时, 单位为秒',
    ],
    'Func:swoole_cpu_num'               => [
        'return' => 'int',
    ],
    'Func:swoole_version'               => [
        'return' => 'string',
    ],
    'Func:swoole_last_error'            => [
        'return' => 'string',
    ],
    'Func:swoole_strerror'              => [
        'return'      => 'string',
        '$errno'      => 'int',
        '$error_type' => 'int(1)',
    ],

];
