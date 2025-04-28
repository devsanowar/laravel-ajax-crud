<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StudentController::class, 'index']);
Route::post('/add-student', [StudentController::class, 'addStudent'])->name('add.student');
