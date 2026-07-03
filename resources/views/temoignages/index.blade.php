@extends('layouts.app')

@php
    $hideNavbar = true;
    $hideFooter = true;
@endphp

@section('title', 'Témoignages')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300;600&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">

<style>

:root{
    --forest:#1A3D16;
    --sage:#2D5A27;
    --light:#E8F5E4;
    --cream:#F5F9F4;
    --text:#5f6b60;
}

body{
    background:var(--cream);
    font-family:'DM Sans',sans-serif;
}

/* HERO */

.hero{
    background:var(--forest);
    padding:90px 20px;
    text-align:center;
}

.hero h1{

    font-family:'Fraunces',serif;
    font-size:52px;
    font-weight:300;
    color:white;
    margin-bottom:20px;

}

.hero h1 em{

    color:var(--light);
    font-style:italic;

}

.hero p{

    max-width:700px;
    margin:auto;
    color:#dce8da;
    line-height:1.9;
    font-size:17px;

}

/* SECTION */

.share-section{

    max-width:900px;
    margin:70px auto;
    padding:0 20px;

}

.share-card{

    background:white;
    border-radius:24px;
    padding:55px;
    text-align:center;
    box-shadow:0 15px 40px rgba(0,0,0,.06);

}

.share-card h2{

    font-family:'Fraunces',serif;
    color:var(--forest);
    font-size:34px;
    margin-bottom:20px;

}

.share-card p{

    color:var(--text);
    line-height:1.9;
    margin-bottom:40px;

}

.buttons{

    display:flex;
    justify-content:center;
    gap:20px;
    flex-wrap:wrap;

}

.btn-share{

    background:var(--forest);
    color:white;
    padding:15px 35px;
    border-radius:999px;
    text-decoration:none;
    font-weight:700;
    transition:.3s;

}

.btn-share:hover{

    background:var(--sage);
    color:white;

}

.btn-dashboard{

    background:white;
    color:var(--forest);
    border:2px solid var(--forest);
    padding:15px 35px;
    border-radius:999px;
    text-decoration:none;
    font-weight:700;
    transition:.3s;

}

.btn-dashboard:hover{

    background:var(--forest);
    color:white;

}

.info-box{

    margin-top:40px;
    background:var(--light);
    border-radius:18px;
    padding:25px;
    color:var(--forest);

}

.info-box h4{

    font-family:'Fraunces',serif;
    margin-bottom:12px;

}

.info-box ul{

    margin:0;
    padding-left:20px;
    text-align:left;

}

.info-box li{

    margin-bottom:10px;

}

</style>

{{-- HERO --}}

<section class="hero">

    <h1>

        Témoignages <em>communautaires</em>

    </h1>

    <p>

        Votre expérience peut redonner espoir à une autre personne.
        Jokko Santé encourage le partage d'expériences dans un environnement
        sécurisé, respectueux et bienveillant.

    </p>

</section>

{{-- CONTENU --}}

<section class="share-section">

    <div class="share-card">

        <h2>

            Partagez votre histoire

        </h2>

        <p>

            Chaque témoignage est relu par notre équipe avant sa publication.
            Notre objectif est de préserver un espace d'écoute, de soutien et
            d'entraide pour toute la communauté.

        </p>

        @auth

            <div class="buttons">

                @if(Auth::user()->role->nom === 'utilisateur')

                    <a href="{{ route('temoignages.create') }}"
                       class="btn-share">

                        Partager mon témoignage

                    </a>

                @endif

                <a href="{{ route('dashboard') }}"
                   class="btn-dashboard">

                    Retour à mon espace

                </a>

            </div>

        @endauth

        <div class="info-box">

            <h4>

                Avant de publier

            </h4>

            <ul>

                <li>Respectez les autres membres de la communauté.</li>

                <li>Ne partagez pas d'informations personnelles sensibles.</li>

                <li>Votre témoignage sera publié uniquement après validation.</li>

                <li>Vous pouvez choisir de publier anonymement.</li>

            </ul>

        </div>

    </div>

</section>

@endsection