<?php

/**
 * @return mixed
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}


function load($source)
{
    $version = '1.00';
    return $source . '?v=' . $version;
}



