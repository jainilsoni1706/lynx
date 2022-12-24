<?php

use App\Controllers\HomeController;
use Lynx\System\Routes\Route;


Route::get('', [HomeController::class, 'index']);
Route::get('create', [HomeController::class, 'create']);
Route::post('store', [HomeController::class, 'store']);

Route::post('change-language',[HomeController::class, 'changeLanguage']);