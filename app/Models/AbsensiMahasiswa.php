<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'absensi_mahasiswa';
    protected $fillable = [
        'npm',
        'keterangan',
        'pertemuan',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'npm', 'npm');
    }
}