<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Jokko Santé') }} - @yield('title', 'Accueil')</title>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,600;0,900;1,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --vert-fonce:  #1A3D16;
            --vert-moyen:  #2D5A27;
            --vert-clair:  #3A6B2F;
            --vert-pale:   #E8F5E4;
            --vert-fond:   #F5F9F4;
            --or-accent:   #D4A853;
            --texte-clair: #C5DFC0;
        }
        body { background-color: var(--vert-fond); }
    </style>
</head>
<body class="min-h-screen" style="background-color: var(--vert-fond);">

    {{-- Navbar (masquable) --}}
    @if(!isset($hideNavbar) || !$hideNavbar)
    <nav style="background-color: var(--vert-fonce);" class="px-6 py-4 shadow-lg">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <a href="/" class="text-white text-xl font-bold flex items-center gap-2">
                🧠 <span>SantéMentale</span>
            </a>
            <div class="flex items-center gap-6 text-sm">
                <a href="/" style="color: var(--texte-clair);" class="hover:text-white transition">Accueil</a>
                <a href="/sensibilisation" style="color: var(--texte-clair);" class="hover:text-white transition">Sensibilisation</a>
                <a href="/prevention" style="color: var(--texte-clair);" class="hover:text-white transition">Prévention</a>
                <a href="/assistance" style="color: var(--texte-clair);" class="hover:text-white transition">Assistance</a>
                @auth
                    <a href="/dashboard" class="text-white font-semibold hover:opacity-80 transition">Mon espace</a>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" style="color: var(--or-accent);" class="hover:opacity-80 transition font-medium">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <a href="/login" style="color: var(--texte-clair);" class="hover:text-white transition">Connexion</a>
                    <a href="/register" style="background-color: var(--or-accent); color: var(--vert-fonce);" class="px-4 py-2 rounded-lg font-semibold hover:opacity-90 transition">
                        S'inscrire
                    </a>
                @endauth
            </div>
        </div>
    </nav>
    @endif

    {{-- Contenu principal --}}
    <main class="max-w-6xl mx-auto px-4 py-8">
        @if(session('success'))
            <div style="background-color: var(--vert-pale); border-color: var(--vert-clair); color: var(--vert-fonce);"
                 class="mb-6 border px-4 py-3 rounded-xl font-medium">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded-xl font-medium">
                ❌ {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer (masquable) --}}
    @if(!isset($hideFooter) || !$hideFooter)
    <footer style="background-color: var(--vert-fonce);" class="mt-16 py-8">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <p style="color: var(--texte-clair);" class="text-sm">
                © {{ date('Y') }} SantéMentale Sénégal — Tous droits réservés
            </p>
            <p style="color: var(--or-accent);" class="text-xs mt-1">
                Plateforme hybride d'entraide communautaire et de santé mentale
            </p>
        </div>
    </footer>
    @endif

</body>
</html>