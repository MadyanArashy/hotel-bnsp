<?php

use App\Http\Controllers\PesananController;
use App\Models\JenisKamar;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // $images = Http::withHeaders([
    // 'Authorization' => 'Client-ID ' . env('UNSPLASH_ACCESS_KEY'),
    // ])->get('https://api.unsplash.com/search/photos', [
    //     'query' => 'hotel bedroom',
    //     'per_page' => 10
    // ])->json();


    // return response()->json($images);
    $jenisKamars = JenisKamar::with('kamars')->get();
    return view('home', compact('jenisKamars'));
})->name('home');
Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
