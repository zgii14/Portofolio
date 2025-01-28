<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asisten extends Model
{
    use HasFactory;

    protected $primaryKey = 'npm';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'nama',
        'npm',
        'nomor_telepon',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}