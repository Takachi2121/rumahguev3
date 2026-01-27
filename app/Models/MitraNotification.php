<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraNotification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'title',
        'message',
        'user_id',
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }
}
