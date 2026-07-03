<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestPhq9 extends Model
{
    protected $table = 'tests_phq9';

    protected $fillable = [
        'user_id', 'score_total',
        'niveau', 'recommandation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reponses()
    {
        return $this->hasMany(ReponsePhq9::class, 'test_id');
    }

    // Calcul automatique du niveau selon le score
    public static function calculerNiveau(int $score): string
    {
        return match(true) {
            $score <= 4  => 'minimal',
            $score <= 9  => 'leger',
            $score <= 14 => 'modere',
            $score <= 19 => 'moderement_severe',
            default      => 'severe',
        };
    }

    public static function calculerRecommandation(string $niveau): string
    {
        return match($niveau) {
            'minimal'            => 'Votre état est stable. Continuez à prendre soin de vous.',
            'leger'              => 'Des signes légers de dépression sont détectés. Parlez à quelqu\'un de confiance.',
            'modere'             => 'Une consultation avec un professionnel est recommandée.',
            'moderement_severe'  => 'Veuillez consulter un psychologue dès que possible.',
            'severe'             => 'Une aide professionnelle urgente est nécessaire. Contactez un spécialiste.',
            default              => 'Résultat non déterminé.',
        };
    }
}