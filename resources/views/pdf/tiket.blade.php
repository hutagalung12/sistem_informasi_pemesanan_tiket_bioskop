<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 20px; background: #f0f0f0; }
        
        .ticket { 
            width: 750px; 
            min-height: 320px; /* Diubah menjadi min-height agar tidak terpotong jika konten memanjang */
            background: #0f172a; 
            color: white; 
            border-radius: 15px; 
            margin: auto; 
            position: relative;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15); /* Tambahan sedikit bayangan agar lebih elegan */
        }

        .main-table { 
            width: 100%; 
            min-height: 320px; 
            border-collapse: collapse; 
            border-radius: 15px;
            overflow: hidden; /* Menjaga border-radius table */
        }
        
        /* Kolom Kiri (Gelap) */
        .left-col { 
            width: 65%; 
            padding: 25px; 
            vertical-align: top; 
        }
        
        /* Tabel dalam untuk memisahkan poster dan detail info tanpa menggunakan float */
        .content-table { width: 100%; border-collapse: collapse; }
        .poster-cell { width: 150px; vertical-align: top; padding-right: 20px; }
        .info-cell { vertical-align: top; }

        .poster { width: 140px; border-radius: 8px; }
        
        .title { 
            font-size: 24px; 
            font-weight: bold; 
            color: #c5a059; 
            margin-bottom: 15px; 
            line-height: 1.2; 
        }
        
        .label { 
            font-size: 10px; 
            color: #94a3b8; 
            text-transform: uppercase; 
            display: block; 
            margin-bottom: 3px; 
            letter-spacing: 1px;
        }
        
        .value { 
            font-size: 14px; 
            font-weight: bold; 
            margin-bottom: 12px; 
        }
        
        .box { 
            border: 1px solid #c5a059; 
            background: rgba(197, 160, 89, 0.1); /* Tambahan warna latar transparan */
            padding: 12px; 
            border-radius: 8px; 
            font-size: 11px; 
            margin-top: 15px;
            line-height: 1.5;
        }

        /* Kolom Kanan (Putih) */
        .right-col { 
            width: 35%; 
            background: #ffffff; 
            color: #0f172a; 
            text-align: center; 
            vertical-align: middle; 
            border-left: 2px dashed #94a3b8; /* Warna garis putus-putus disesuaikan */
            padding: 20px;
        }
        
        .kode-label { font-size: 11px; color: #64748b; letter-spacing: 1px; font-weight: bold; }
        .kode-value { font-weight: bold; font-size: 22px; margin: 10px 0; color: #0f172a; }
        .greetings { margin-top: 40px; font-size: 14px; font-weight: bold; color: #334155; line-height: 1.4; }
    </style>
</head>
<body>

<div class="ticket">
    <table class="main-table">
        <tr>
            <td class="left-col">
                <table class="content-table">
                    <tr>
                        <td class="poster-cell">
                            <img src="{{ public_path('storage/' . $pemesanan->jadwal->film->poster) }}" class="poster">
                        </td>
                        <td class="info-cell">
                            <div class="title">{{ $pemesanan->jadwal->film->judul }}</div>
                            
                            <span class="label">Tanggal</span>
                            <div class="value">{{ \Carbon\Carbon::parse($pemesanan->jadwal->tanggal)->format('d M Y') }}</div>
                            
                            <span class="label">Waktu</span>
                            <div class="value">{{ $pemesanan->jadwal->jam_tayang }} WIB</div>
                            
                            <span class="label">Studio & Kursi</span>
                            <div class="value">
                                {{ $pemesanan->jadwal->studio->nama_studio }} | 
                                @foreach($pemesanan->detailPemesanans as $d)
                                    {{ $d->kursi->nomor_kursi }}@if(!$loop->last), @endif
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="box">
                    <b style="color: #c5a059;">PERHATIAN</b><br>
                    - Tunjukkan e-ticket ini saat masuk studio<br>
                    - Datang 15 menit sebelum film dimulai
                </div>
            </td>

            <td class="right-col">
                <div class="kode-label">KODE PEMESANAN</div>
                <div class="kode-value">{{ $pemesanan->kode_pembayaran }}</div>
                
                <div class="greetings">
                    TERIMA KASIH<br>SELAMAT MENONTON!
                </div>
            </td>
        </tr>
    </table>
</div>

</body>
</html>