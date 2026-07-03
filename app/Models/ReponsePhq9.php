<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReponsePhq9 extends Model
{
    protected $table = 'reponses_phq9';

    protected $fillable = [
        'test_id', 'question_numero', 'score',
    ];

    public function test()
    {
        return $this->belongsTo(TestPhq9::class, 'test_id');
    }
}