<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TransactionController;

// Transaksi Routes
Route::post('/transactions', [TransactionController::class, 'store']);

Route::get('/histories', [HistoryController::class, 'index']);

Route::get('/phones', [PhoneController::class, 'index']);

Route::get('/staffs', [StaffController::class, 'index']);

// Brand Routes
Route::get('/brands', [BrandController::class, 'index']);
Route::get('/brands/insert', [BrandController::class, 'insert']);
Route::get('/brands/update', [BrandController::class, 'update']);
Route::delete('/brands/{id}', [BrandController::class, 'destroy']);
