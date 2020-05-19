<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    // use SoftDeletes;

    protected $table = "siswa";

    protected $fillable = [
        'id_kelas',
        'nisn',
        'nis',
        'nama',
        'jenis_kelamin',
        'alamat',
        'no_telp',
        'id_spp',
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;

    public function kelas()
    {
        return $this->hasOne('App\Models\Kelas', 'id_kelas', 'id_kelas');
    }

    public function akun()
    {
        return $this->hasOne('App\User', 'nis', 'username');
    }

    public function pembayaran()
    {
        return $this->hasMany('App\Models\Pembayaran', 'nisn', 'nisn');
    }
}
