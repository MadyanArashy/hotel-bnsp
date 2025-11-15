<?php

use App\Http\Controllers\PesananController;
use App\Models\JenisKamar;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $jenisKamars = JenisKamar::with('kamars')->get();
    return view('home', compact('jenisKamars'));
})->name('home');
Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');