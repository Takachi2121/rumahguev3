<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tukang extends Model
{
    public $timestamps = false;
    protected $table = 'tukang';

    protected $fillable = [
        'user_id',
        'keahlian',
        'alamat_tukang',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
