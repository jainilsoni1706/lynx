<?php

use App\Controllers\BlogController;
use App\Controllers\HomeController;
use App\Controllers\TestController;
use App\Controllers\Routable;
use App\Middleware\PreventionGate;
use Lynx\System\Routes\Route;

Route::collection(function($route){
    $route->get('dashboard')->method('index')->terminate();
})->prefix('admin')->middleware([PreventionGate::class, []])->of(BlogController::class);

Route::collection(function($callable){
    $callable->get('ello')->method('hello')->alias('five')->end();
    $callable->get('five','four')->method('index')->alias('five')->params('page','blog')->end();
})->prefix('routable')->middleware([Authenticable::class, 'jainil'], [Testable::class, 'jainil'])->of(Routable::class);

Route::collection(function($callable){
    $callable->get('index')->method('index')->alias('index')->end();
    $callable->get('model')->method('model')->alias('model')->terminate();
    $callable->get('create')->method('create')->alias('create')->params('blog', 'technology', 'GO')->end();
})->prefix('main_home')->of(HomeController::class);

Route::collection(function($callable){
    $callable->get('test')->method('test')->alias('test')->end();
})->of(TestController::class);