<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| File ini berisi semua route untuk API kamu.
| Secara default, Laravel otomatis memberi prefix "/api"
| jadi kalau kamu menulis Route::get('/test'), endpoint-nya
| akan bisa diakses di: http://127.0.0.1:8000/api/test
|
*/

// 🔹 Tes koneksi API
Route::get('/test', function () {
    return response()->json([
        'message' => 'API is working fine!',
        'status' => 'success',
        'laravel_version' => app()->version()
    ]);
});

// 🔹 CRUD untuk kategori
Route::apiResource('categories', CategoryController::class);

// 🔹 CRUD untuk produk
Route::apiResource('products', ProductController::class);
