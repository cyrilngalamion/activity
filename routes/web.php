<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

// Dashboard Route - Loads StudentController@index
Route::get('/dashboard', [StudentController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Resource Controller (Automatically Generates CRUD Routes)
Route::resource('students', StudentController::class)->middleware(['auth']); 

// Remove Duplicate Route Definitions
// Route::post('/students', [StudentController::class, 'store'])->name('students.store');  ❌ Already created by Route::resource()
// Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update'); ❌ Duplicate
// Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy'); ❌ Duplicate

require __DIR__.'/auth.php';

// Welcome Page Route
Route::get('/', function () {
    return view('welcome');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
