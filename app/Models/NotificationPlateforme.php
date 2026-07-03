<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationPlateforme extends Model
{
    protected $table = 'notifications_plateforme';

    protected $fillable = [
        'user_id', 'titre',
        'message', 'type', 'lu',
    ];

    protected $casts = [
        'lu' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}