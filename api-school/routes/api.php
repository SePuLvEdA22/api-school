<?php

use App\Http\Controllers\studentController;
use App\Http\Controllers\teacherControler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

// Student
Route::get('/students', [studentController::class, 'indexStudent']);
Route::post('/students', [studentController::class, 'storeStudent']);



// Teacher
Route::get('/teachers', [teacherControler::class, 'indexTeacher']);