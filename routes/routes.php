<?php

use App\Controllers\HomeController;
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

Route::dispatch(function(){

    // Route::get('/', [HomeController::class, 'index'])->name('first');
    // Route::post('/change-language',[HomeController::class, 'changeLanguage'])->name('second');
    // Route::get('model',[HomeController::class, 'model']);
    Route::get('/create/{test}/{req}', [HomeController::class, 'create'])->name('fourth');

})->use();
