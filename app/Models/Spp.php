<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spp extends Model
{
    use SoftDeletes;

    protected $table = "spp";

    protected $fillable = [
        'tahun',
        'nominal',
        'total_perbulan',
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;
}
