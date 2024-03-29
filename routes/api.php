<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

Route::post('/user/register', '\App\Http\Controllers\UserController@register');

Route::prefix('auth')->group(function () 
{
    Route::post('/user/login', [AuthController::class, 'login']);
});

Route::middleware(['auth:sanctum'])->group(function () 
{
    Route::post('/blog/create', '\App\Http\Controllers\BlogController@create');
    Route::post('/blog/index', '\App\Http\Controllers\BlogController@index');
    Route::post('/blog/update', '\App\Http\Controllers\BlogController@update');
    Route::post('/blog/delete', '\App\Http\Controllers\BlogController@delete');
});

