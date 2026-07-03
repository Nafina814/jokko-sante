<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TemoignageCommentaire;

class Temoignage extends Model
{
    protected $fillable = [
        'user_id',
        'titre',
        'contenu',
        'statut',
        'anonyme',
    ];

    protected $casts = [
        'anonyme' => 'boolean',
    ];

    /**
     * Auteur
     */
    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Commentaires du témoignage
     */
   function commentaires()
{
    return $this->hasMany(TemoignageCommentaire::class)
                ->latest();
}
}