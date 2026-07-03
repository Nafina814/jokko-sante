<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signalement extends Model
{
    protected $fillable = [
        'user_id', 'description', 'categorie',
        'urgence', 'statut', 'latitude',
        'longitude', 'adresse', 'photo',
    ];

    protected $casts = [
        'latitude'  => 'float',
        'longitude' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCouleurMarqueurAttribute(): string
    {
        return match($this->statut) {
            'en_attente'     => 'yellow',
            'pris_en_charge' => 'blue',
            'traite'         => 'green',
            default          => 'yellow',
        };
    }

    public function getLibelleStatutAttribute(): string
    {
        return match($this->statut) {
            'en_attente'     => '⏳ En attente',
            'pris_en_charge' => '🔵 Pris en charge',
            'traite'         => '✅ Traité',
            default          => 'Inconnu',
        };
    }

    public function getLibelleUrgenceAttribute(): string
    {
        return match($this->urgence) {
            'faible'  => '🟢 Faible',
            'moyenne' => '🟡 Moyenne',
            'elevee'  => '🔴 Élevée',
            default   => 'Inconnue',
        };
    }
}