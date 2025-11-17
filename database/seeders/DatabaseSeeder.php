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
            "harga" => 1500000,
            'thumbnailPath' => 'https://images.unsplash.com/photo-1668435528344-b70cedd6df88?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w4MzA5ODF8MHwxfHNlYXJjaHw2fHxob3RlbCUyMGJlZHJvb218ZW58MHx8fHwxNzYzMjA2NDE4fDA&ixlib=rb-4.1.0&q=80&w=1080',
            'videoUrl' => 'https://www.youtube.com/watch?v=VNntuFmme-4'
            ],
            [
            "nama" => "Deluxe",
            "deskripsi" => "Suite luas dengan pemandangan kota, tempat tidur king, dan fasilitas modern",
            "harga" => 2000000,
            'thumbnailPath' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w4MzA5ODF8MHwxfHNlYXJjaHwxfHxob3RlbHxlbnwwfHx8fDE3NjMyMDQ5MTh8MA&ixlib=rb-4.1.0&q=80&w=1080',
            'videoUrl' => 'https://www.youtube.com/watch?v=nC7Zug4xwjI&t=132s'
        ],
        [
            "nama" => "Family",
            "deskripsi" => "Pilihan terbaik untuk keluarga dengan fasilitas cocok untuk beragam keperluan anggota keluarga",
            "harga" => 2500000,
            'thumbnailPath' => 'https://images.unsplash.com/photo-1629140727571-9b5c6f6267b4?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w4MzA5ODF8MHwxfHNlYXJjaHwyfHxob3RlbCUyMGJlZHJvb218ZW58MHx8fHwxNzYzMjA2NDE4fDA&ixlib=rb-4.1.0&q=80&w=1080',
            'videoUrl' => 'https://www.youtube.com/watch?v=9b0tND1R5ak&t=1136s'
            ],
        ]);

        // Ruang kamar untuk setiap jenis kamar
        $jenisKamars = JenisKamar::all();

        // Konfigurasi jumlah lantai & kamar per lantai
        $jumlahLantai = 1;       // misalnya 5 lantai
        $kamarPerLantai = 4;     // misalnya 10 kamar per lantai

        $nomorKamarCounter = 1;  // Counter untuk nomor kamar unik

        foreach ($jenisKamars as $jenis) {
            for ($lantai = 1; $lantai <= $jumlahLantai; $lantai++) {
                for ($nomor = 1; $nomor <= $kamarPerLantai; $nomor++) {
                    Kamar::create([
                        "nomor_ruangan" => ($lantai * 100) + $nomorKamarCounter,
                        "tersedia" => 1,
                        "jenis_kamar_id" => $jenis->id
                    ]);
                    $nomorKamarCounter++;
                }
            }
        }
    }
}
