<?php

return [
    // ClassName:method
    'Server:send' => [
        // desc for method
        '_desc' => 'send data to the client',
        '_return' => 'bool If success return True, fail return False',
        // method params
        'server_socket' => 'int:This parameter is required when sending data to the Unix Socket DGRAM peer.
        The TCP client does not need to fill in',
    ],
];
