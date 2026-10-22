<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotorController;

Route::get('/', function () {
    return redirect()->route('motors.index');
});

Route::resource('motors', MotorController::class);