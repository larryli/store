<?php
/**
 * Development configure
 */
return [
    'yiiDebug' => true,
    'web' => [
        'bootstrap' => ['gii', 'debug'],
        'modules' => [
            'gii' => [
                'class' => \yii\gii\Module::class,
                'allowedIPs' => ['10.0.2.2', '127.0.0.1', '::1'],
            ],
            'debug' => [
                'class' => \yii\debug\Module::class,
                'allowedIPs' => ['10.0.2.2', '127.0.0.1', '::1'],
            ],
        ],
        'components' => [
            'db' => [
                'class' => \yii\db\Connection::class,
                'dsn' => 'mysql:host=localhost;dbname=website_dev',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ],
            'log' => [
                'traceLevel' => 3,
                'targets' => [
                    [
                        'class' => \yii\log\FileTarget::class,
                        'levels' => ['error', 'warning'],
                        'except' => [
                            'yii\web\HttpException:4*',
                        ],
                    ],
                ],
            ],
            'request' => [
                'cookieValidationKey' => 'dev',
            ],
        ],
        'params' => [
            'adminEmail' => 'admin@localhost.com',
        ],
    ],
    'console' => [
        'bootstrap' => ['log', 'gii'],
        'modules' => [
            'gii' => \yii\gii\Module::class,
        ],
        'controllerMap' => [
            'migrate' => [
                'class' => \yii\console\controllers\MigrateController::class,
                'templateFile' => '@extras/migrate/migration.php',
                'generatorTemplateFiles' => [
                    'create_table' => '@extras/migrate/createTableMigration.php',
                    'drop_table' => '@extras/migrate/dropTableMigration.php',
                    'add_column' => '@extras/migrate/addColumnMigration.php',
                    'drop_column' => '@extras/migrate/dropColumnMigration.php',
                    'create_junction' => '@extras/migrate/createTableMigration.php'
                ],
            ],
        ],
        'components' => [
            'db' => [
                'class' => \yii\db\Connection::class,
                'dsn' => 'mysql:host=localhost;dbname=website_dev',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ],
            'log' => [
                'traceLevel' => 3,
                'targets' => [
                    [
                        'class' => \yii\log\FileTarget::class,
                        'levels' => ['error', 'warning'],
                    ],
                ],
            ],
        ],
        'params' => [
        ],
    ],
];
