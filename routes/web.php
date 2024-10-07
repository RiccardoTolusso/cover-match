<?php

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Controllers\Auth\CompatibilityController;
use App\Http\Controllers\Auth\SearchController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    if (Auth::user()) {
        return redirect(route("search"));
    } else {
        return view('welcome');
    }
})->name('home');

Route::middleware('auth')->group(function () {
    // auth protected routes
    Route::get('/cerca', [SearchController::class, 'index'])->name("search");
    Route::get('/cerca/{brand_name}', [SearchController::class, 'show'])->name("models");
    Route::get('/cerca/{brand_name}/{model_id}', [SearchController::class, 'info'])->name("model");

    Route::get('/compatibilita/{brand_name}/{model_id}', [CompatibilityController::class, 'create'])->name("create_compatibility");
    Route::post('/compatibilita/{brand_name}/{model_id}', [CompatibilityController::class, 'store'])->name("store_compatibility");
});

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/admin', [BaseAdminController::class, 'index'])->name('admin');
    Route::post('/admin/aggiungi_modello', [BaseAdminController::class, 'store_model'])->name('store_model');
    Route::patch('/admin/modifica_compatibilita', [BaseAdminController::class, 'edit_compatibility'])->name('edit_compatibility');
});

require __DIR__ . '/auth.php';
