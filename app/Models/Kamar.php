<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = [
        "tersedia",
        "jenis_kamar_id"
    ];

    public function jenis()
    {
        return $this->belongsTo(JenisKamar::class, 'jenis_kamar_id', 'id');
    }

}
