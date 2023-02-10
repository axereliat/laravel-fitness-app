<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecordController;
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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/records/{record}/edit', [RecordController::class, 'edit'])->name('records.edit');

    Route::put('/records/{record}', [RecordController::class, 'update'])->name('records.update');

    Route::delete('/records/{record}', [RecordController::class, 'destroy'])->name('records.destroy');

    Route::get('/records', [RecordController::class, 'index'])->name('records.index');

    Route::get('/records/create', [RecordController::class, 'create'])->name('records.create');

    Route::post('/records/create', [RecordController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
