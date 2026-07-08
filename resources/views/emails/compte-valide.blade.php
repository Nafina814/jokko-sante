<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Compte validé — Jokko Santé</title>
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

    <h2 style="font-size:1.35rem;color:#0f2410;margin:0 0 8px;font-weight:600;">
      Bonjour {{ $user->name }} 👋
    </h2>

    <p style="color:#5a7a55;font-size:.9rem;line-height:1.85;margin:0 0 24px;">
      Excellente nouvelle ! Votre compte
      <strong style="color:#1A3D16;">{{ $role === 'psychologue' ? 'Psychologue' : 'Pair-aidant' }}</strong>
      sur Jokko Santé a été <strong>validé</strong> par notre équipe.
      Vous pouvez maintenant vous connecter et accéder à votre espace.
    </p>

    {{-- Badge succès --}}
    <div style="background:#f0fdf4;border:1px solid #86efac;border-radius:14px;padding:16px 20px;margin-bottom:28px;display:flex;align-items:center;gap:12px;">
      <span style="font-size:1.4rem;">✅</span>
      <div>
        <p style="color:#166534;font-size:.88rem;font-weight:700;margin:0 0 3px;">Compte activé avec succès</p>
        <p style="color:#166534;font-size:.8rem;margin:0;opacity:.8;">Connectez-vous dès maintenant pour accéder à votre espace.</p>
      </div>
    </div>

    {{-- Infos compte --}}
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
        <tr>
          <td style="padding:6px 0;font-size:.82rem;color:#5a7a55;border-top:1px solid #e8f5e4;">Profil</td>
          <td style="padding:6px 0;font-size:.82rem;color:#0f2410;font-weight:600;border-top:1px solid #e8f5e4;">{{ ucfirst(str_replace('_', ' ', $role)) }}</td>
        </tr>
      </table>
    </div>

    {{-- Bouton CTA --}}
    <div style="text-align:center;margin-bottom:28px;">
      <a href="{{ url('/login') }}"
         style="display:inline-block;background:linear-gradient(135deg,#1A3D16,#3A6B2F);color:white;text-decoration:none;padding:14px 36px;border-radius:12px;font-size:.95rem;font-weight:700;letter-spacing:.01em;box-shadow:0 6px 20px rgba(26,61,22,.25);">
        🌿 Accéder à mon espace
      </a>
    </div>

    {{-- Sécurité --}}
    <div style="background:#fefce8;border:1px solid #fde68a;border-radius:12px;padding:14px 18px;margin-bottom:28px;font-size:.8rem;color:#92400e;line-height:1.6;">
      🔒 <strong>Confidentialité :</strong> Cet email est strictement confidentiel et destiné uniquement à {{ $user->name }}.
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
      Cet email a été envoyé automatiquement. Ne pas répondre à cet email.
    </p>
  </div>

</div>
</body>
</html>
