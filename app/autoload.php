<?php

function __autoload($class_name)
{
    $path_maps = [
        '/models/',
        '/components/',
        '/controllers/'
    ];

    foreach ($path_maps as $path) {

        $path = __DIR__ . $path . $class_name . '.php';

        if (is_file($path)) {
            include_once $path;
        }
    }

}