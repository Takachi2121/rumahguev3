<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'mitra';

    protected $fillable = [
        'user_id',
        'deskripsi',
        'foto_profil',
        'whatsapp',
        'harga',
        'lokasi',
        'keahlian',
        'alamat_mitra',
        'portfolio',
        'portfolio2',
        'portfolio3',
        'portfolio4',
        'portfolio5'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mitraNotification()
    {
        return $this->hasMany(MitraNotification::class);
    }
}
