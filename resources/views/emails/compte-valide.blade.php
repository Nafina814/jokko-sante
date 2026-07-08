<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Compte validé — Jokko Santé</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,Helvetica,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:32px 0;">
  <tr><td align="center">
  <table width="580" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;overflow:hidden;border:1px solid #e0e0e0;">

    {{-- HEADER --}}
    <tr>
      <td style="background:#1A3D16;padding:32px 40px;text-align:center;">
        <p style="font-size:22px;font-weight:bold;color:#ffffff;margin:0 0 4px;">Jokko Santé</p>
        <p style="font-size:12px;color:rgba(255,255,255,0.65);margin:0;letter-spacing:1px;text-transform:uppercase;">Plateforme de santé mentale — Sénégal</p>
      </td>
    </tr>

    {{-- CORPS --}}
    <tr>
      <td style="padding:36px 40px;">

        @php $role = $user->role->nom ?? 'utilisateur'; @endphp

        <p style="font-size:18px;color:#1a1a1a;font-weight:bold;margin:0 0 8px;">Bonjour {{ $user->name }},</p>

        <p style="font-size:14px;color:#555555;line-height:1.7;margin:0 0 24px;">
          Votre compte <strong style="color:#1A3D16;">{{ $role === 'psychologue' ? 'Psychologue' : 'Pair-aidant' }}</strong>
          sur Jokko Santé a été <strong>validé</strong> par notre équipe.
          Vous pouvez maintenant vous connecter et accéder à votre espace.
        </p>

        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f0fdf4;border:1px solid #86efac;border-radius:6px;margin-bottom:24px;">
          <tr><td style="padding:14px 18px;">
            <p style="font-size:13px;font-weight:bold;color:#166534;margin:0 0 2px;">Compte activé avec succès</p>
            <p style="font-size:12px;color:#166534;margin:0;">Connectez-vous dès maintenant pour accéder à votre espace.</p>
          </td></tr>
        </table>

        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fdf6;border:1px solid #e8f5e4;border-radius:6px;margin-bottom:24px;">
          <tr><td style="padding:16px 18px;">
            <p style="font-size:11px;font-weight:bold;letter-spacing:1px;text-transform:uppercase;color:#2D5A27;margin:0 0 12px;">Vos informations de compte</p>
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td style="padding:5px 0;font-size:13px;color:#777777;width:35%;">Nom</td>
                <td style="padding:5px 0;font-size:13px;color:#1a1a1a;font-weight:bold;">{{ $user->name }}</td>
              </tr>
              <tr>
                <td style="padding:5px 0;font-size:13px;color:#777777;border-top:1px solid #e8f5e4;">Email</td>
                <td style="padding:5px 0;font-size:13px;color:#1a1a1a;font-weight:bold;border-top:1px solid #e8f5e4;">{{ $user->email }}</td>
              </tr>
              <tr>
                <td style="padding:5px 0;font-size:13px;color:#777777;border-top:1px solid #e8f5e4;">Profil</td>
                <td style="padding:5px 0;font-size:13px;color:#1a1a1a;font-weight:bold;border-top:1px solid #e8f5e4;">{{ ucfirst(str_replace('_', ' ', $role)) }}</td>
              </tr>
            </table>
          </td></tr>
        </table>

        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
          <tr><td align="center">
            <a href="{{ url('/login') }}" style="display:inline-block;background:#1A3D16;color:#ffffff;text-decoration:none;padding:14px 36px;border-radius:6px;font-size:14px;font-weight:bold;">
              Accéder à mon espace
            </a>
          </td></tr>
        </table>

        <table width="100%" cellpadding="0" cellspacing="0" style="background:#fefce8;border:1px solid #fde68a;border-radius:6px;margin-bottom:24px;">
          <tr><td style="padding:12px 16px;font-size:12px;color:#92400e;line-height:1.6;">
            <strong>Confidentialité :</strong> Cet email est strictement confidentiel et destiné uniquement à {{ $user->name }}.
          </td></tr>
        </table>

        <p style="font-size:12px;color:#777777;text-align:center;border-top:1px solid #e8f5e4;padding-top:16px;margin:0;">
          En cas d'urgence : <strong style="color:#dc2626;">116</strong> (SAMU Social) &nbsp;·&nbsp;
          <strong style="color:#dc2626;">17</strong> (Police) &nbsp;·&nbsp;
          <strong style="color:#dc2626;">800 00 19 19</strong> (SOS Femmes, gratuit)
        </p>

      </td>
    </tr>

    {{-- FOOTER --}}
    <tr>
      <td style="background:#1a1a1a;padding:20px 40px;text-align:center;">
        <p style="font-size:12px;color:rgba(255,255,255,0.5);margin:0 0 4px;">
          &copy; {{ date('Y') }} Jokko Santé &nbsp;·&nbsp; Plateforme de santé mentale &nbsp;·&nbsp; Sénégal
        </p>
        <p style="font-size:11px;color:rgba(255,255,255,0.3);margin:0;">
          Cet email a été envoyé automatiquement. Ne pas répondre.
        </p>
      </td>
    </tr>

  </table>
  </td></tr>
</table>
</body>
</html>
