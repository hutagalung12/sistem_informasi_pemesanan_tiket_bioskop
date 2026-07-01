<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = [
        'user_id',
        'jadwal_id',
        'film_id',
        'kursi_id',
        'jumlah_tiket',
        'total_harga',
        'status',
        'metode_pembayaran',
        'kode_pembayaran',
        'expired_at'
    ];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function kursi()
    {
        return $this->belongsTo(Kursi::class);
    }
    public function film()
    {
        return $this->belongsTo(Film::class);
    }
    public function detailPemesanans()
{
    return $this->hasMany(DetailPemesanan::class);
}
}