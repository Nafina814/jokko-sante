<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = [
        'titre', 'contenu',
        'user_id', 'anonyme', 'statut',
    ];

    protected $casts = [
        'anonyme' => 'boolean',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reponses()
    {
        return $this->hasMany(ForumReponse::class);
    }
}