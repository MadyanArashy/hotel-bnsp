<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        "nama",
        "jenis_kelamin",
        "nomor_identitas",
        "check_in",
        "durasi_menginap",
        "sarapan",
        "total_bayar",
        "kamar_id"
    ];

    protected $casts = [
        'check_in' => 'date',
    ];
    public function kamar() {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }
}
