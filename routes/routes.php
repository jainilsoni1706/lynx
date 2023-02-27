<?php

use App\Controllers\HomeController;
use App\Controllers\TestController;
use App\Controllers\Routable;
use App\Middleware\Authenticable;
use Lynx\System\Routes\Route;

// Route::middleware(Authenticable::class, null, function(){

    // Route::get('/', [HomeController::class, 'index']);
    // Route::get('/create/{test}/{req}', [HomeController::class, 'create']);
    // Route::post('/change-language',[HomeController::class, 'changeLanguage']);
    // Route::get('model',[HomeController::class, 'model']);


    // Route::post('/store', [HomeController::class, 'store']);
    // Route::get('/update/post/{id}',[HomeController::class, 'store']);

// });

// Route::dispatch(function(){

    // Route::post('/change-language',[HomeController::class, 'changeLanguage'])->name('second');
    // Route::get('model',[HomeController::class, 'model']);
    // Route::get('/index', [HomeController::class, 'index'])->name('first');
    // Route::get('/create/{test}/{req}', [HomeController::class, 'create'])->name('fourth');

// })->use();

// Route::get('/create/{test}/{req}', [HomeController::class, 'create'])->name('fourth')->use();

// Route::collection(function($callable) {
//     $callable->get('home')->method('homeMethod')->name('home')->params(['entertainment','page']);
//     $callable->post('home')->method('homeMethod')->name('home')->params(['entertainment','page']);
//     $callable->put('home')->method('homeMethod')->name('home')->params(['entertainment','page']);
//     $callable->delete('home')->method('homeMethod')->name('home')->params(['entertainment','page']);
//     $callable->any('home')->method('homeMethod')->name('home')->params(['entertainment','page']);
// })->prefix('admin')->middleware(['mid1', 'mid2'])->of(HomeController::class);

Route::collection(function($callable){
    $callable->get('five')->method('index')->alias('five')->end();
})->prefix('routable')->of(Routable::class);

Route::collection(function($callable){
    $callable->get('index')->method('index')->alias('index')->end();
    $callable->get('model')->method('model')->alias('model')->terminate();
    $callable->get('create')->method('create')->alias('create')->params('blog', 'technology', 'GO')->end();
})->prefix('main_home')->of(HomeController::class);

Route::collection(function($callable){
    $callable->get('test')->method('test')->alias('test')->end();
})->of(TestController::class);