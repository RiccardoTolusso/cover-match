<?php

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
});

Route::middleware('auth')->group(function () {
    // auth protected routes
    Route::get('/cerca', [SearchController::class, 'index'])->name("search");
    Route::get('/cerca/{brand_name}', [SearchController::class, 'show'])->name("models");
    Route::get('/cerca/{brand_name}/{model_id}', [SearchController::class, 'info'])->name("model");

    Route::get('/compatibilita/{brand_name}/{model_id}', [CompatibilityController::class, 'create'])->name("create_compatibility");
    Route::post('/compatibilita', [CompatibilityController::class, 'store'])->name("store_compatibility");
});

require __DIR__ . '/auth.php';
