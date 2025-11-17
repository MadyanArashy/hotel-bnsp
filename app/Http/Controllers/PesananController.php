<?php

namespace App\Http\Controllers;

use App\Models\JenisKamar;
use App\Models\Kamar;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pop = Pesanan::find(1);
        // dd($pop->kamar->jenis);
        $pesanans = Pesanan::with('kamar.jenis')->orderBy('check_in', 'asc')->get();
        $jenisKamars = JenisKamar::all();
        return view('pesanan', compact('pesanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        // Validasi input
    $validated = $request->validate([
        "nama" => "required|string|max:255",
        "jenis_kelamin" => "required|string|in:laki-laki,perempuan",
        "nomor_identitas" => "required|string|size:16|regex:/^[0-9]{16}$/",
        "check_in" => "required|date|after_or_equal:today",
        "durasi_menginap" => "required|integer|min:1",
        "sarapan" => "nullable|boolean",
        "jenis_kamar_id" => "required|exists:jenis_kamars,id",
    ]);

    $jenisKamar = JenisKamar::findOrFail($validated['jenis_kamar_id']);

    // Cari kamar yang tersedia untuk jenis kamar tersebut
    $kamarTersedia = $jenisKamar->kamars()->where('tersedia', 1)->first();

    // Cek apakah ada kamar tersedia
    if (!$kamarTersedia) {
        return redirect()->back()
            ->withErrors(['kamar' => 'Maaf, kamar tidak tersedia untuk jenis kamar yang dipilih.'])
            ->withInput();
    }

    // Hitung tanggal check-out
    $checkIn = \Carbon\Carbon::parse($validated['check_in']);

    // Hitung total harga kamar
    $hargaKamar = $jenisKamar->harga * $validated['durasi_menginap'];

    // Terapkan diskon 10% jika durasi menginap >= 3 hari
    if ($validated['durasi_menginap'] >= 3) {
        $hargaKamar = $hargaKamar * 0.9; // Diskon 10%
    }

    // Hitung harga sarapan
    $hargaSarapan = 0;
    if ($validated['sarapan'] ?? false) {
        $hargaSarapan = 80000 * $validated['durasi_menginap']; // Rp 80.000 per hari
    }

    $totalHarga = $hargaKamar + $hargaSarapan;

    Pesanan::create([
        'nama' => $validated['nama'],
        'jenis_kelamin' => $validated['jenis_kelamin'],
        'nomor_identitas' => $validated['nomor_identitas'],
        'check_in' => $checkIn,
        'durasi_menginap' => $validated['durasi_menginap'],
        'sarapan' => $validated['sarapan'] ?? false,
        'kamar_id' => $kamarTersedia->id,
        'harga_kamar' => $hargaKamar,
        'harga_sarapan' => $hargaSarapan,
        'total_bayar' => $totalHarga,
    ]);

    // Update status kamar menjadi tidak tersedia
    $kamarTersedia->update(['tersedia' => 0]);

    // Redirect dengan pesan sukses
    return redirect()->route('pesanan.index')
        ->with('success', 'Booking berhasil! Pesanan Anda sedang diproses.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesanan $pesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesanan $pesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan)
    {
        //
    }
}
