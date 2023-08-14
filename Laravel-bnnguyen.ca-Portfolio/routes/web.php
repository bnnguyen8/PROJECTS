<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\MainController;

if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', [MainController::class, 'index']);
Route::get('/', function () {
    return view('frontend.home');
});
Route::get('/resume', function () {
    return view('frontend.resume');
});