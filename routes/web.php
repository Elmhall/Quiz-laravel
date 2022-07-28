<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [\App\Http\Controllers\QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/{name}', [\App\Http\Controllers\QuizController::class, 'show'])->name('quiz.show');
Route::get('/quiz/{name}/submit', [\App\Http\Controllers\QuizController::class, 'submit'])->name('quiz.submit');
Route::post('/quiz/{name}/submit', [\App\Http\Controllers\QuizController::class, 'create'])->name('quiz.create');
Route::post('/quiz/{name}', [\App\Http\Controllers\QuizController::class, 'store'])->name('quiz.store');
