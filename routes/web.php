<?php

namespace App\Models;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CafeController;

Route::get('/', [CafeController::class, 'index']);
Route::get('/about', [CafeController::class, 'about']);
Route::get('/menu', [CafeController::class, 'menu']);

Route::get('/order/dine-in', [CafeController::class, 'dineIn']);
Route::post('/order/dine-in', [CafeController::class, 'storeOrder']);