<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisProduk extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_jenis',
    ];
}
