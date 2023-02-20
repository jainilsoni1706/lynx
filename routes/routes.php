<?php

use App\Controllers\HomeController;
use App\Middleware\Authenticable;
use Lynx\System\Routes\Route;

// Route::middleware(Authenticable::class, null, function(){

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/create/{test}/{req}', [HomeController::class, 'create']);
    Route::post('/change-language',[HomeController::class, 'changeLanguage']);
    Route::get('model',[HomeController::class, 'model']);


    Route::post('/store', [HomeController::class, 'store']);
    Route::get('/update/post/{id}',[HomeController::class, 'store']);

// });

