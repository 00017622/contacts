<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;

Route::post('/sign-up', [AuthController::class, 'register']);

Route::post('/sign-in', [AuthController::class, 'login']);

Route::resource('contacts',  ContactController::class )->middleware('auth:sanctum');


