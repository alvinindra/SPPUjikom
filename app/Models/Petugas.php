<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Petugas extends Model
{
    protected $table = "petugas";

    protected $fillable = [
        'nama_petugas', 'username', 'created_at', 'updated_at'
    ];

    public $timestamps = false;
}
