<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kursi extends Model
{
    protected $fillable = [
        'studio_id',
        'nomor_kursi',
        'status'
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}