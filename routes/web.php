<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SensibilisationController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\PreventionController;
use App\Http\Controllers\RendezvousController;
use App\Http\Controllers\Psychologue\RendezvousController as PsychoRdvController;
use App\Http\Controllers\Admin\RendezvousController as AdminRdvController;
use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SignalementController;
use App\Http\Controllers\Admin\SignalementController as AdminSignalementController;
use App\Http\Controllers\AssistantController;
use App\Http\Controllers\PairAidant\SignalementController as PairSignalementController;
use App\Http\Controllers\TemoignageController;
use App\Http\Controllers\CommentaireController;
use App\Models\Temoignage;
use App\Models\Commentaire;
use App\Http\Controllers\TemoignageCommentaireController;
use App\Http\Controllers\NotificationController;

// ── PAGE D'ACCUEIL ──
Route::get('/', function () {
    return view('welcome');
})->name('home');

// DEBUG TEMPORAIRE — à supprimer après vérification
Route::get('/debug-https', function () {
    return response()->json([
        'url'             => request()->url(),
        'isSecure'        => request()->isSecure(),
        'x-forwarded-proto' => request()->header('X-Forwarded-Proto'),
        'x-forwarded-for'   => request()->header('X-Forwarded-For'),
    ]);
});

// ── AUTHENTIFICATION ──
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/register/attente', [RegisterController::class, 'attente'])->name('register.attente');
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ── SENSIBILISATION (public) ──
Route::get('/sensibilisation', [SensibilisationController::class, 'index'])->name('sensibilisation.index');
Route::get('/sensibilisation/{article}', [SensibilisationController::class, 'show'])->name('sensibilisation.show');

// ── ROUTES PROTÉGÉES ──
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');

    // Prévention
    Route::get('/prevention', [PreventionController::class, 'index'])->name('prevention.index');
    Route::post('/prevention', [PreventionController::class, 'store'])->name('prevention.store');
    Route::get('/prevention/resultat/{test}', [PreventionController::class, 'resultat'])->name('prevention.resultat');

    // Assistance
    Route::get('/assistance', [AssistanceController::class, 'index'])->name('assistance.index');
    Route::post('/assistance/forum', [AssistanceController::class, 'storeForum'])->name('assistance.forum.store');
    Route::get('/assistance/forum/{forum}', [AssistanceController::class, 'showForum'])->name('assistance.forum.show');
    Route::post('/assistance/forum/{forum}/reponse', [AssistanceController::class, 'storeReponse'])->name('assistance.forum.reponse');
    Route::post('/assistance/message', [AssistanceController::class, 'sendMessage'])->name('assistance.message.send');
    Route::get('/assistance/messages', [AssistanceController::class, 'mesMessages'])->name('assistance.messages');

    // Rendez-vous utilisateur
    Route::get('/rendezvous', [RendezvousController::class, 'index'])->name('rendezvous.index');
    Route::post('/rendezvous', [RendezvousController::class, 'store'])->name('rendezvous.store');
    Route::post('/rendezvous/{rendezvous}/annuler', [RendezvousController::class, 'destroy'])->name('rendezvous.annuler');

    // Signalement citoyen
    Route::get('/signalement', [SignalementController::class, 'index'])->name('signalement.index');
    Route::get('/signalement/create', [SignalementController::class, 'create'])->name('signalement.create');
    Route::post('/signalement', [SignalementController::class, 'store'])->name('signalement.store');

    // Carte pair-aidant
    Route::get('/pair-aidant/signalements', [PairSignalementController::class, 'index'])->name('pair.signalements');

    // Assistant IA
    Route::get('/assistant', [AssistantController::class, 'index'])->name('assistant.index');
    Route::post('/assistant/chat', [AssistantController::class, 'chat'])->name('assistant.chat');

    // ── TÉMOIGNAGES ──
    // Visible par tous les connectés
Route::get('/temoignages', [TemoignageController::class, 'index'])
->name('temoignages.index');

// Créer et soumettre — utilisateur uniquement via vérification dans le contrôleur
Route::get('/temoignages/create', [TemoignageController::class, 'create'])
->name('temoignages.create');
Route::get(
    '/temoignages/{temoignage}',
    [TemoignageController::class, 'show']
)->name('temoignages.show');
Route::post('/temoignages', [TemoignageController::class, 'store'])
->name('temoignages.store');

// ── COMMENTAIRES ──
Route::post('/articles/{article}/commentaires', [CommentaireController::class, 'store'])
->name('commentaires.store');
Route::delete('/commentaires/{commentaire}', [CommentaireController::class, 'destroy'])
->name('commentaires.destroy');
    // ── ADMIN ──
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

        // Utilisateurs
        Route::get('/utilisateurs', [UserController::class, 'index'])->name('users.index');
        Route::post('/utilisateurs/{user}/role', [UserController::class, 'updateRole'])->name('users.role');
        Route::post('/utilisateurs/{user}/toggle', [UserController::class, 'toggleActif'])->name('users.toggle');
        Route::delete('/utilisateurs/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/utilisateurs/{user}/valider', [UserController::class, 'valider'])->name('users.valider');
        Route::post('/utilisateurs/{user}/rejeter', [UserController::class, 'rejeter'])->name('users.rejeter');

        // Articles
        Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
        Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
        Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

        // Rendez-vous admin
        Route::get('/rendezvous', [AdminRdvController::class, 'index'])->name('rendezvous.index');
        Route::delete('/rendezvous/{rendezvous}', [AdminRdvController::class, 'destroy'])->name('rendezvous.destroy');

        // Signalements admin
        Route::get('/signalements', [AdminSignalementController::class, 'index'])->name('signalements.index');
        Route::post('/signalements/{signalement}/statut', [AdminSignalementController::class, 'updateStatut'])->name('signalements.statut');
        Route::delete('/signalements/{signalement}', [AdminSignalementController::class, 'destroy'])->name('signalements.destroy');

        // Modération témoignages et commentaires
        Route::get('/temoignages', [UserController::class, 'temoignages'])->name('temoignages.index');
        Route::post('/temoignages/{temoignage}/publier', [UserController::class, 'publierTemoignage'])->name('temoignages.publier');
        Route::post('/temoignages/{temoignage}/rejeter', [UserController::class, 'rejeterTemoignage'])->name('temoignages.rejeter');
        Route::delete('/commentaires/{commentaire}', [UserController::class, 'supprimerCommentaire'])->name('commentaires.destroy');
    });

    // ── PSYCHOLOGUE ──
    Route::middleware('psychologue')->prefix('psychologue')->name('psychologue.')->group(function () {
        Route::get('/rendezvous', [PsychoRdvController::class, 'index'])->name('rendezvous.index');
        Route::post('/rendezvous/{rendezvous}/confirmer', [PsychoRdvController::class, 'confirmer'])->name('rendezvous.confirmer');
        Route::post('/rendezvous/{rendezvous}/terminer', [PsychoRdvController::class, 'terminer'])->name('rendezvous.terminer');
        Route::post('/rendezvous/{rendezvous}/annuler', [PsychoRdvController::class, 'annuler'])->name('rendezvous.annuler');
    });

    /*
|--------------------------------------------------------------------------
| Commentaires des témoignages
|--------------------------------------------------------------------------
*/

Route::post(
    '/temoignages/{temoignage}/commentaires',
    [TemoignageCommentaireController::class, 'store']
)->name('temoignages.commentaires.store');

Route::delete(
    '/temoignage-commentaires/{commentaire}',
    [TemoignageCommentaireController::class, 'destroy']
)->name('temoignages.commentaires.destroy');


Route::middleware('auth')->group(function () {

    Route::get('/notifications', [NotificationController::class,'index'])
        ->name('notifications.index');

});
});