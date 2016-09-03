<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

/**
 * Helper creating an excerpt
 */
if(!function_exists('excerpt')){
    function excerpt($text, $limit=20, $end='...')
    {
        return Str::words($text, $limit, $end);
    }
}

if(!function_exists('isActiveRoute')){
    function isActiveRoute($route, $class = "active")
    {
        if(Route::currentRouteName() == $route)
            return $class;
    }
}

if(!function_exists('areActiveRoutes')){
    function areActiveRoutes($routes, $class = "active")
    {
        foreach($routes as $route)
        {
            if(Route::currentRouteName() == $route)
                return $class;
        }
    }
}