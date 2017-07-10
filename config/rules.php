<?php
/**
 * Url Rules
 */
return [
    '' => 'site/index',
    '<action:(about|register|activate|unlock|forget|reset|login|logout|error)>' => 'site/<action>',
    '<controller:(profile)>' => '<controller>/index',
    '<controller:[\w-/]+>/<id:\d+>' => '<controller>/view',
    '<controller:[\w-/]+>/<id:\d+>/<action:[\w-]+>' => '<controller>/<action>',
];
