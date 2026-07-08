<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Temoignage;
use App\Models\TemoignageCommentaire;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
        'role_id', 'telephone', 'genre',
        'universite', 'anonyme', 'actif',
        'numero_ordre', 'specialite', 'etablissement',
        'type_pair_aidant', 'motivation', 'organisation',
        'statut_validation',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'anonyme'           => 'boolean',
        'actif'             => 'boolean',
    ];

    // Relations
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function testsPhq9()
    {
        return $this->hasMany(TestPhq9::class);
    }

    public function rendezvousPatient()
    {
        return $this->hasMany(Rendezvous::class, 'patient_id');
    }

    public function rendezvousPsychologue()
    {
        return $this->hasMany(Rendezvous::class, 'psychologue_id');
    }

    public function messagesEnvoyes()
    {
        return $this->hasMany(Message::class, 'expediteur_id');
    }

    public function messagesRecus()
    {
        return $this->hasMany(Message::class, 'destinataire_id');
    }

    public function forums()
    {
        return $this->hasMany(Forum::class);
    }

    public function notifications()
    {
        return $this->hasMany(NotificationPlateforme::class);
    }

    // Helpers rôles
    public function isAdmin(): bool
    {
        return $this->role->nom === 'admin';
    }

    public function isPsychologue(): bool
    {
        return $this->role->nom === 'psychologue';
    }

    public function isPairAidant(): bool
    {
        return $this->role->nom === 'pair_aidant';
    }

    public function isUtilisateur(): bool
    {
        return $this->role->nom === 'utilisateur';
    }

    /**
 * Témoignages publiés
 */
public function temoignages()
{
    return $this->hasMany(Temoignage::class);
}

/**
 * Commentaires sur les témoignages
 */
public function temoignageCommentaires()
{
    return $this->hasMany(TemoignageCommentaire::class);
}
}