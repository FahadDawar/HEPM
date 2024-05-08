<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClerkController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClinicianController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Clerk routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Dashboard route
    Route::get('/dashboard', [ClerkController::class, 'index'])->name('dashboard');

    // Image resource
    Route::get('images', [ImageController::class, 'index'])->name('images');
    Route::post('images', [ImageController::class, 'store'])->name('images.store');
    Route::get('images/{filename}', [ImageController::class, 'show'])->name('images.show');
    Route::delete('images/{image}', [ImageController::class, 'destroy'])->name('images.destroy');
    Route::post('images/{image}/assign-clinician', [ImageController::class, 'assign_clinician'])->name('images.assign.clinician');
    Route::get('images/{filename}/download', [ImageController::class, 'download_image'])->name('images.download');

    // bulk download images route
    Route::post('images/download', [ImageController::class, 'download_bulk_images'])->name('images.download-all');

    // bulk delete images route
    Route::post('images/delete', [ImageController::class, 'delete_bulk_images'])->name('images.delete-all');


    // Clinician routes
    Route::resource('clinicians', ClinicianController::class);

});

require __DIR__ . '/auth.php';
// End clerk routes


