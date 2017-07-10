<?php
/**
 * Main configure
 */
return [
    'yiiPath' => dirname(__DIR__) . '/Yii.php',
    'yiiDebug' => false,
    'aliases' => [
        '@images' => dirname(__DIR__) . '/web/images',
    ],
    'web' => [
        'id' => 'store',
        'name' => 'Store',
        'timeZone' => 'Asia/Shanghai',
        'language' => 'zh-CN',
        'basePath' => dirname(__DIR__) . '/app',
        'runtimePath' => dirname(__DIR__) . '/runtime',
        'vendorPath' => dirname(__DIR__) . '/vendor',
        'aliases' => [
            '@bower' => '@vendor/bower-asset',
            '@npm' => '@vendor/npm-asset',
            '@extras' => '@vendor/larryli/yii2-extras/src',
        ],
        'bootstrap' => ['log'],
        'components' => [
            'authManager' => [
                'class' => \yii\rbac\PhpManager::class,
                'defaultRoles' => ['admin'],
            ],
            'cache' => [
                'class' => \yii\caching\FileCache::class,
            ],
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],
            'i18n' => [
                'translations' => [
                    'yii' => [
                        'class' => \yii\i18n\PhpMessageSource::class,
                        'basePath' => '@extras/messages',
                    ],
                ],
            ],
            'mailer' => [
                'class' => \yii\swiftmailer\Mailer::class,
                'useFileTransport' => true,
            ],
            'monipdb' => [
                'class' => \extras\monipdb\Monipdb::class,
                'filename' => '@runtime/17monipdb.dat',
            ],
            'session' => [
                'class' => \yii\web\DbSession::class,
            ],
            'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => require(__DIR__ . '/rules.php'),
            ],
            'user' => [
                'enableAutoLogin' => true,
            ],
        ],
    ],
    'console' => [
        'id' => 'console',
        'name' => 'Console',
        'timeZone' => 'Asia/Shanghai',
        'language' => 'zh_CN',
        'basePath' => dirname(__DIR__) . '/app',
        'runtimePath' => dirname(__DIR__) . '/runtime',
        'vendorPath' => dirname(__DIR__) . '/vendor',
        'aliases' => [
            '@bower' => '@vendor/bower-asset',
            '@npm' => '@vendor/npm-asset',
            '@extras' => '@vendor/larryli/yii2-extras/src',
        ],
        'bootstrap' => ['log'],
        'controllerNamespace' => 'app\commands',
        'components' => [
            'cache' => [
                'class' => \yii\caching\FileCache::class,
            ],
            'i18n' => [
                'translations' => [
                    'yii' => [
                        'class' => \yii\i18n\PhpMessageSource::class,
                        'basePath' => '@extras/messages',
                    ],
                ],
            ],
        ],
        'params' => [
        ],
    ],
];
