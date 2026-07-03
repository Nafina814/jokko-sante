<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'titre', 'contenu', 'image',
        'categorie', 'statut', 'user_id',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function commentaires()
{
    return $this->hasMany(Commentaire::class);
}

public function categorie()
{
    return $this->belongsTo(\App\Models\Categorie::class, 'categorie_id');
}
}