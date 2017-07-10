<?php
/**
 * Website app
 */
require(dirname(__DIR__) . '/bootstrap.php');
$env = new \janisto\environment\Environment(dirname(__DIR__) . '/config');
$env->setup();
(new yii\web\Application($env->web))->run();
//$env->showDebug(); // show produced environment configuration
