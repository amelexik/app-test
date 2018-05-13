<?php
return [
    'params'     => [
        'appName'        => 'Simple Test App',
        'appDescription' => 'This App only for test, text PHP knowledge',
    ],
    'components' => [
        'Db'       => [
            'host' => 'localhost',
        ],
        'Router'   => [
            'defaultController' => 'site',
        ],
        'Identity' => [],
        'Request'  => [],
    ]
];