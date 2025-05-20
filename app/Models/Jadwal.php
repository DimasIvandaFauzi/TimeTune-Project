<?php

namespace App\Models;

use Mongodb\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'jadwal';
    protected $table = 'jadwal';

    protected $fillable = [
        'user_id', 'nama_jadwal', 'tanggal', 'kategori', 'prioritas', 'deskripsi', 'deadline', 'jam', 'urutan'
    ];
}