<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumReponse extends Model
{
    protected $table = 'forum_reponses';

    protected $fillable = [
        'forum_id', 'user_id',
        'contenu', 'anonyme',
    ];

    protected $casts = [
        'anonyme' => 'boolean',
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}