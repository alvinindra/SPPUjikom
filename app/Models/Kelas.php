<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use SoftDeletes;

    protected $table = "kelas";

    protected $fillable = [
        'nama_kelas',
        'kompetensi_keahlian',
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;
}
