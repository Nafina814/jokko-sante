<?php

namespace App\Http\Controllers;

use App\Models\Signalement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SignalementController extends Controller
{
    public function index()
    {
        $signalements = Signalement::where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('signalement.index', compact('signalements'));
    }

    public function create()
    {
        return view('signalement.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|min:10',
            'categorie'   => 'required|in:violence,detresse,danger,insecurite,autre',
            'urgence'     => 'required|in:faible,moyenne,elevee',
            'latitude'    => 'nullable|numeric',
            'longitude'   => 'nullable|numeric',
            'adresse'     => 'nullable|string|max:255',
            'photo'       => 'nullable|image|max:2048',
        ], [
            'description.required' => 'La description est obligatoire.',
            'description.min'      => 'La description doit contenir au moins 10 caractères.',
            'categorie.required'   => 'La catégorie est obligatoire.',
            'urgence.required'     => 'Le niveau d\'urgence est obligatoire.',
            'photo.image'          => 'Le fichier doit être une image.',
            'photo.max'            => 'La photo ne doit pas dépasser 2 Mo.',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('signalements', 'public');
        }

        Signalement::create([
            'user_id'     => Auth::id(),
            'description' => $request->description,
            'categorie'   => $request->categorie,
            'urgence'     => $request->urgence,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'adresse'     => $request->adresse,
            'photo'       => $photoPath,
            'statut'      => 'en_attente',
        ]);

        return redirect()->route('signalement.index')
            ->with('success', 'Votre signalement a été envoyé avec succès. Nous le traitons en priorité.');
    }
}