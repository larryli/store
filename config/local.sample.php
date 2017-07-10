<?php
/**
 * Local configure
 */
$db = [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=store_dev',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
];
return [
    'web' => [
        'components' => [
            'request' => [
                'cookieValidationKey' => '',
            ],
            'db' => $db,
        ],
        'params' => [
        ],
    ],
    'console' => [
        'components' => [
            'db' => $db,
        ],
    ],
];
