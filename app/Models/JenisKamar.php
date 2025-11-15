<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKamar extends Model
{
    protected $fillable = [
        "nama",
        "deskripsi",
        "harga",
    ];

    public function kamars()
    {
        return $this->hasMany(Kamar::class, 'jenis_kamar_id');
    }
}
