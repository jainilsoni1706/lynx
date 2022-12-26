<?php

use App\Controllers\HomeController;
use App\Middleware\Authenticable;
use Lynx\System\Routes\Route;

Route::middleware(Authenticable::class, [], function(){


    Route::get('', [HomeController::class, 'index']);
    Route::get('create', [HomeController::class, 'create']);
    Route::post('store', [HomeController::class, 'store']);
    Route::post('change-language',[HomeController::class, 'changeLanguage']);

});

