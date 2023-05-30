<?php

use App\Http\Controllers\TeacherController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['auth:sanctum', 'teacher'])->group(function () {
    Route::get('/teacher-form', [TeacherController::class, 'showForm'])->name('teacher-form');
    Route::post('/teacher-form', [TeacherController::class, 'createStudent'])->name('teacher-form.create');
    Route::get('/students/{student}/edit', [TeacherController::class, 'editStudent'])->name('students.edit');
    Route::put('/students/{student}', [TeacherController::class, 'updateStudent'])->name('students.update');
    Route::delete('/students/{student}', [TeacherController::class, 'deleteStudent'])->name('students.delete');
});
