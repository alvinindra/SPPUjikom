<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = "pembayaran";

    protected $fillable = [
        'id_petugas',
        'nisn',
        'tgl_bayar',
        'bulan_dibayar',
        'id_spp',
        'jumlah_bayar',
        'tahun_dibayar',
        'keterangan',
    ];

    public $timestamps = false;

    public function spp()
    {
        return $this->hasOne('App\Models\Spp', 'id_spp', 'id_spp');
    }

    public function siswa()
    {
        return $this->hasOne('App\Models\Siswa', 'id_spp', 'id_spp');
    }
}
