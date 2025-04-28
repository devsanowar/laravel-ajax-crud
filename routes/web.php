<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StudentController::class, 'index']);
Route::post('/add-student', [StudentController::class, 'addStudent'])->name('add.student');
Route::post('/update-student', [StudentController::class, 'updateStudent'])->name('update.student');
Route::post('/delete-student', [StudentController::class, 'deleteStudent'])->name('delete.student');
