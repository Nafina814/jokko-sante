<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    protected $table = 'rendezvous';

    protected $fillable = [
        'patient_id', 'psychologue_id',
        'date_heure', 'statut', 'motif', 'notes',
    ];

    protected $casts = [
        'date_heure' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function psychologue()
    {
        return $this->belongsTo(User::class, 'psychologue_id');
    }
}