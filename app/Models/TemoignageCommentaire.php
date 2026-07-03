<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Temoignage;

class TemoignageCommentaire extends Model
{
    protected $table = 'temoignage_commentaires';

    protected $fillable = [
        'user_id',
        'temoignage_id',
        'contenu',
        'anonyme',
    ];

    protected $casts = [
        'anonyme' => 'boolean',
    ];

    /**
     * Auteur du commentaire
     */
    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Témoignage concerné
     */
    public function temoignage()
    {
        return $this->belongsTo(Temoignage::class);
    }
}