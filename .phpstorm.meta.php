<?php
// The code for this file is to provide some code hints for phpstorm.

namespace PHPSTORM_META {

    // This is a saner and self-documented format for PhpStorm 2016.2 and later
    // Try QuickDoc on these "magic" functions, or even Go to definition!

    // override(\bean(0), map([]));

    registerArgumentsSet('websocketOpcodes',
        \WEBSOCKET_OPCODE_TEXT,
        \WEBSOCKET_OPCODE_BINARY,
        \WEBSOCKET_OPCODE_CLOSE,
        \WEBSOCKET_OPCODE_PING,
        \WEBSOCKET_OPCODE_PONG
    );

    // Code hint for:
    expectedArguments(
        \Swoole\WebSocket\Server::push(),
        2,
        argumentsSet('websocketOpcodes')
    );
    expectedArguments(
        \Swoole\WebSocket\Frame::pack(),
        1,
        argumentsSet('websocketOpcodes')
    );
}
