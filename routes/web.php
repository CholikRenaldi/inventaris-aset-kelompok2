<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('asets.index');
});

Route::get('/dashboard', function () {
    return view('asets.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/asets/pdf', [AsetController::class, 'pdf'])->name('asets.pdf');
    Route::resource('asets', AsetController::class);
});

require __DIR__.'/auth.php';