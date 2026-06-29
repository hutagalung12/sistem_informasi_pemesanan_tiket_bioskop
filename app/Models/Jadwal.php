<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
    'film_id',
    'studio_id',
    'tanggal',
    'jam_tayang',
    'harga_tiket'
];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}