<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $primaryKey = 'npm'; // Karena kolom 'npm' adalah primary key
    public $incrementing = false; // Non-increment karena primary key bukan integer
    protected $keyType = 'string'; // Tipe primary key adalah string

    protected $fillable = [
        'npm',
        'user_id',
        'nama',
        'nomor_telepon',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
