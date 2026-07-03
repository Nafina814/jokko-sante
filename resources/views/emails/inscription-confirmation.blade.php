<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Confirmation — Jokko Santé</title>
</head>
<body style="margin:0;padding:0;background:#F5F9F4;font-family:'Helvetica Neue',Arial,sans-serif;">
<div style="max-width:580px;margin:40px auto;background:white;border-radius:20px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.08);">

  {{-- HEADER --}}
  <div style="background:linear-gradient(135deg,#1A3D16,#2D5A27);padding:36px 40px;text-align:center;">
    <div style="width:64px;height:64px;background:rgba(232,245,228,.15);border:1px solid rgba(232,245,228,.25);border-radius:16px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px;">
      <span style="font-size:2rem;">🌿</span>
    </div>
    <h1 style="font-size:1.6rem;font-weight:700;color:white;margin:0 0 6px;letter-spacing:-.02em;">JokkoSanté</h1>
    <p style="color:rgba(255,255,255,.55);font-size:.8rem;margin:0;letter-spacing:.06em;text-transform:uppercase;">Plateforme de santé mentale · Sénégal</p>
  </div>

  {{-- CORPS --}}
  <div style="padding:40px;">

    @php $role = $user->role->nom ?? 'utilisateur'; @endphp

    {{-- Salutation --}}
    <h2 style="font-size:1.35rem;color:#0f2410;margin:0 0 8px;font-weight:600;">
      Bonjour {{ $user->name }} 👋
    </h2>

    {{-- ── UTILISATEUR ── --}}
    @if($role === 'utilisateur')
    <p style="color:#5a7a55;font-size:.9rem;line-height:1.85;margin:0 0 24px;">
      Votre inscription sur <strong style="color:#1A3D16;">Jokko Santé</strong> a été confirmée avec succès.
      Vous pouvez maintenant accéder à tous nos services <strong>gratuitement</strong> et en toute confidentialité.
    </p>

    {{-- Badge succès --}}
    <div style="background:#f0fdf4;border:1px solid #86efac;border-radius:14px;padding:16px 20px;margin-bottom:28px;display:flex;align-items:center;gap:12px;">
      <span style="font-size:1.4rem;">✅</span>
      <div>
        <p style="color:#166534;font-size:.88rem;font-weight:700;margin:0 0 3px;">Compte activé avec succès</p>
        <p style="color:#166534;font-size:.8rem;margin:0;opacity:.8;">Connectez-vous dès maintenant pour accéder à votre espace.</p>
      </div>
    </div>

    {{-- Services disponibles --}}
    <div style="background:#f8fdf6;border-radius:14px;padding:20px;margin-bottom:28px;">
      <p style="font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#2D5A27;margin:0 0 14px;">Ce que vous pouvez faire</p>
      <div style="display:grid;gap:10px;">
        <div style="display:flex;align-items:center;gap:10px;font-size:.84rem;color:#0f2410;">
          <span style="width:28px;height:28px;background:#e8f5e4;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;">🧪</span>
          Passer le test PHQ-9 pour évaluer votre santé mentale
        </div>
        <div style="display:flex;align-items:center;gap:10px;font-size:.84rem;color:#0f2410;">
          <span style="width:28px;height:28px;background:#e8f5e4;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;">📅</span>
          Prendre rendez-vous avec un psychologue
        </div>
        <div style="display:flex;align-items:center;gap:10px;font-size:.84rem;color:#0f2410;">
          <span style="width:28px;height:28px;background:#e8f5e4;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;">💬</span>
          Accéder au forum communautaire et au chat
        </div>
        <div style="display:flex;align-items:center;gap:10px;font-size:.84rem;color:#0f2410;">
          <span style="width:28px;height:28px;background:#e8f5e4;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;">🤖</span>
          Utiliser l'assistant IA disponible 24h/24
        </div>
      </div>
    </div>

    {{-- Bouton CTA --}}
    <div style="text-align:center;margin-bottom:28px;">
      <a href="{{ url('/login') }}"
         style="display:inline-block;background:linear-gradient(135deg,#1A3D16,#3A6B2F);color:white;text-decoration:none;padding:14px 36px;border-radius:12px;font-size:.95rem;font-weight:700;letter-spacing:.01em;box-shadow:0 6px 20px rgba(26,61,22,.25);">
        🌿 Accéder à mon espace
      </a>
    </div>

    {{-- ── PSYCHOLOGUE ── --}}
    @elseif($role === 'psychologue')
    <p style="color:#5a7a55;font-size:.9rem;line-height:1.85;margin:0 0 24px;">
      Nous avons bien reçu votre demande d'inscription en tant que <strong style="color:#1A3D16;">Psychologue</strong> sur Jokko Santé.
      Votre dossier professionnel est en cours d'examen par notre équipe.
    </p>

    {{-- Badge attente --}}
    <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:12px;">
      <span style="font-size:1.4rem;">⏳</span>
      <div>
        <p style="color:#1e40af;font-size:.88rem;font-weight:700;margin:0 0 3px;">Compte en attente de validation</p>
        <p style="color:#1e40af;font-size:.8rem;margin:0;opacity:.8;">Délai : 24 à 48 heures ouvrables</p>
      </div>
    </div>

    {{-- Infos dossier --}}
    <div style="background:#f8fdf6;border-radius:14px;padding:20px;margin-bottom:24px;">
      <p style="font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#2D5A27;margin:0 0 12px;">Informations soumises</p>
      <table style="width:100%;border-collapse:collapse;">
        <tr>
          <td style="padding:6px 0;font-size:.82rem;color:#5a7a55;width:40%;">Numéro d'ordre</td>
          <td style="padding:6px 0;font-size:.82rem;color:#0f2410;font-weight:600;">{{ $user->numero_ordre ?? '—' }}</td>
        </tr>
        <tr>
          <td style="padding:6px 0;font-size:.82rem;color:#5a7a55;border-top:1px solid #e8f5e4;">Spécialité</td>
          <td style="padding:6px 0;font-size:.82rem;color:#0f2410;font-weight:600;border-top:1px solid #e8f5e4;">{{ $user->specialite ?? '—' }}</td>
        </tr>
        <tr>
          <td style="padding:6px 0;font-size:.82rem;color:#5a7a55;border-top:1px solid #e8f5e4;">Établissement</td>
          <td style="padding:6px 0;font-size:.82rem;color:#0f2410;font-weight:600;border-top:1px solid #e8f5e4;">{{ $user->etablissement ?? '—' }}</td>
        </tr>
      </table>
    </div>

    <p style="color:#5a7a55;font-size:.84rem;line-height:1.75;margin:0 0 28px;background:#fafafa;border-radius:10px;padding:14px;border-left:3px solid #3A6B2F;">
      📧 Vous recevrez un email de confirmation dès que votre compte sera validé par notre équipe.
      Vous pourrez alors vous connecter et accéder à votre espace psychologue.
    </p>

    {{-- ── PAIR-AIDANT ── --}}
    @elseif($role === 'pair_aidant')
    <p style="color:#5a7a55;font-size:.9rem;line-height:1.85;margin:0 0 24px;">
      Nous avons bien reçu votre demande d'inscription en tant que <strong style="color:#1A3D16;">Pair-aidant</strong> sur Jokko Santé.
      Merci pour votre engagement communautaire au service des sénégalais.
    </p>

    {{-- Badge attente --}}
    <div style="background:#f0fdf4;border:1px solid #86efac;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:12px;">
      <span style="font-size:1.4rem;">🤝</span>
      <div>
        <p style="color:#166534;font-size:.88rem;font-weight:700;margin:0 0 3px;">Demande en cours de traitement</p>
        <p style="color:#166534;font-size:.8rem;margin:0;opacity:.8;">Délai : 24 à 48 heures ouvrables</p>
      </div>
    </div>

    {{-- Infos dossier --}}
    <div style="background:#f8fdf6;border-radius:14px;padding:20px;margin-bottom:24px;">
      <p style="font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#2D5A27;margin:0 0 12px;">Informations soumises</p>
      <table style="width:100%;border-collapse:collapse;">
        <tr>
          <td style="padding:6px 0;font-size:.82rem;color:#5a7a55;width:40%;">Type</td>
          <td style="padding:6px 0;font-size:.82rem;color:#0f2410;font-weight:600;">
            {{ ucfirst(str_replace('_', ' ', $user->type_pair_aidant ?? '—')) }}
          </td>
        </tr>
        @if($user->organisation)
        <tr>
          <td style="padding:6px 0;font-size:.82rem;color:#5a7a55;border-top:1px solid #e8f5e4;">Organisation</td>
          <td style="padding:6px 0;font-size:.82rem;color:#0f2410;font-weight:600;border-top:1px solid #e8f5e4;">{{ $user->organisation }}</td>
        </tr>
        @endif
      </table>
    </div>

    <p style="color:#5a7a55;font-size:.84rem;line-height:1.75;margin:0 0 28px;background:#fafafa;border-radius:10px;padding:14px;border-left:3px solid #3A6B2F;">
      📧 Vous serez notifié(e) par email dès que votre demande sera validée.
      Votre engagement est précieux pour notre communauté.
    </p>
    @endif

    {{-- INFOS COMPTE --}}
    <div style="background:#f8fdf6;border:1px solid #e8f5e4;border-radius:14px;padding:20px;margin-bottom:28px;">
      <p style="font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#2D5A27;margin:0 0 12px;">Vos informations de compte</p>
      <table style="width:100%;border-collapse:collapse;">
        <tr>
          <td style="padding:6px 0;font-size:.82rem;color:#5a7a55;width:35%;">Nom</td>
          <td style="padding:6px 0;font-size:.82rem;color:#0f2410;font-weight:600;">{{ $user->name }}</td>
        </tr>
        <tr>
          <td style="padding:6px 0;font-size:.82rem;color:#5a7a55;border-top:1px solid #e8f5e4;">Email</td>
          <td style="padding:6px 0;font-size:.82rem;color:#0f2410;font-weight:600;border-top:1px solid #e8f5e4;">{{ $user->email }}</td>
        </tr>
        @if($user->telephone)
        <tr>
          <td style="padding:6px 0;font-size:.82rem;color:#5a7a55;border-top:1px solid #e8f5e4;">Téléphone</td>
          <td style="padding:6px 0;font-size:.82rem;color:#0f2410;font-weight:600;border-top:1px solid #e8f5e4;">{{ $user->telephone }}</td>
        </tr>
        @endif
        <tr>
          <td style="padding:6px 0;font-size:.82rem;color:#5a7a55;border-top:1px solid #e8f5e4;">Profil</td>
          <td style="padding:6px 0;font-size:.82rem;color:#0f2410;font-weight:600;border-top:1px solid #e8f5e4;">{{ ucfirst(str_replace('_', ' ', $role)) }}</td>
        </tr>
      </table>
    </div>

    {{-- Sécurité --}}
    <div style="background:#fefce8;border:1px solid #fde68a;border-radius:12px;padding:14px 18px;margin-bottom:28px;font-size:.8rem;color:#92400e;line-height:1.6;">
      🔒 <strong>Confidentialité :</strong> Cet email est strictement confidentiel et destiné uniquement à {{ $user->name }}.
      Vos données personnelles sont sécurisées et uniquement accessibles par l'administrateur de la plateforme.
    </div>

    {{-- Urgences --}}
    <div style="border-top:1px solid #e8f5e4;padding-top:16px;text-align:center;">
      <p style="font-size:.76rem;color:#5a7a55;">
        🚨 En cas d'urgence :
        <strong style="color:#dc2626;">116</strong> (SAMU Social) ·
        <strong style="color:#dc2626;">17</strong> (Police) ·
        <strong style="color:#dc2626;">800 00 19 19</strong> (SOS Femmes, gratuit)
      </p>
    </div>

  </div>

  {{-- FOOTER --}}
  <div style="background:#0f2410;padding:24px 40px;text-align:center;">
    <p style="color:rgba(255,255,255,.5);font-size:.76rem;margin:0 0 6px;">
      © {{ date('Y') }} Jokko Santé · Plateforme de santé mentale · Sénégal
    </p>
    <p style="color:rgba(255,255,255,.25);font-size:.7rem;margin:0;">
      Cet email a été envoyé automatiquement suite à votre inscription. Ne pas répondre à cet email.
    </p>
  </div>

</div>
</body>
</html>