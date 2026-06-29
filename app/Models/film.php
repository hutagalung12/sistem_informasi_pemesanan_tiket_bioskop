<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'genre',
        'durasi',
        'tanggal_tayang',
        'poster',
        'sinopsis'
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}