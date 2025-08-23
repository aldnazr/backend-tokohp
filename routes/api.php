<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TransactionController;

// Transaksi Routes
Route::get('/transaction', [TransactionController::class, 'index']);
Route::post('/transaction', [TransactionController::class, 'insert']);

Route::get('/histories', [HistoryController::class, 'index']);

Route::get('/phones', [PhoneController::class, 'index']);
Route::post('/phones', [PhoneController::class, 'insert']);
Route::put('/phones/{id}', [PhoneController::class, 'update']);
Route::delete('/phones/{id}', [PhoneController::class, 'delete']);

Route::get('/staffs', [StaffController::class, 'index']);

// Brand Routes
Route::get('/brands', [BrandController::class, 'index']);
Route::post('/brands', [BrandController::class, 'insert']);
Route::put('/brands/{id}', [BrandController::class, 'update']);
Route::delete('/brands/{id}', [BrandController::class, 'destroy']);
