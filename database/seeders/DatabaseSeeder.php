<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\JenisKamar;
use App\Models\Kamar;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        JenisKamar::insert([
            [
            "nama" => "Standar",
            "deskripsi" => "Kenyamanan premium dengan akses lounge eksekutif dan meja kerja",
            "harga" => 500000,
            ],
            [
            "nama" => "Deluxe",
            "deskripsi" => "Suite luas dengan pemandangan kota, tempat tidur king, dan fasilitas modern",
            "harga" => 800000,
            ],
            [
            "nama" => "Family",
            "deskripsi" => "Pilihan terbaik untuk keluarga dengan fasilitas cocok untuk beragam keperluan anggota keluarga",
            "harga" => 1500000,
            ],
        ]);

        // Ruang kamar untuk setiap jenis kamar
        $jenisKamars = JenisKamar::all();

        // Konfigurasi jumlah lantai & kamar per lantai
        $jumlahLantai = 5;       // misalnya 5 lantai
        $kamarPerLantai = 10;    // misalnya 10 kamar per lantai

        foreach ($jenisKamars as $index => $jenis) {
            for ($lantai = 1; $lantai <= $jumlahLantai; $lantai++) {
                for ($nomor = 1; $nomor <= $kamarPerLantai; $nomor++) {
                    Kamar::create([
                        "nomor_ruangan" => ($lantai * 100) + $nomor, // ex: 101, 102, ..., 520
                        "tersedia" => 1,
                        "jenis_kamar_id" => $jenis->id
                    ]);
                }
            }
        }
    }
}
