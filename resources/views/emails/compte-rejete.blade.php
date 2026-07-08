<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Demande non retenue — Jokko Santé</title>
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
          Nous avons examiné votre demande d'inscription en tant que
          <strong style="color:#1A3D16;">{{ $role === 'psychologue' ? 'Psychologue' : 'Pair-aidant' }}</strong>
          sur Jokko Santé. Malheureusement, votre dossier n'a pas pu être retenu à ce stade.
        </p>

        <table width="100%" cellpadding="0" cellspacing="0" style="background:#fef2f2;border:1px solid #fca5a5;border-radius:6px;margin-bottom:24px;">
          <tr><td style="padding:14px 18px;">
            <p style="font-size:13px;font-weight:bold;color:#991b1b;margin:0 0 2px;">Demande non retenue</p>
            <p style="font-size:12px;color:#991b1b;margin:0;">Votre compte ne sera pas activé pour le moment.</p>
          </td></tr>
        </table>

        <table width="100%" cellpadding="0" cellspacing="0" style="background:#fafafa;border-left:3px solid #3A6B2F;border-radius:4px;margin-bottom:24px;">
          <tr><td style="padding:14px 18px;font-size:13px;color:#555555;line-height:1.75;">
            Si vous pensez que cette décision est une erreur ou si vous souhaitez obtenir plus d'informations,
            n'hésitez pas à nous contacter en répondant à cet email ou via notre plateforme.
          </td></tr>
        </table>

        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fdf6;border:1px solid #e8f5e4;border-radius:6px;margin-bottom:24px;">
          <tr><td style="padding:16px 18px;">
            <p style="font-size:11px;font-weight:bold;letter-spacing:1px;text-transform:uppercase;color:#2D5A27;margin:0 0 12px;">Informations soumises</p>
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
                <td style="padding:5px 0;font-size:13px;color:#777777;border-top:1px solid #e8f5e4;">Profil demandé</td>
                <td style="padding:5px 0;font-size:13px;color:#1a1a1a;font-weight:bold;border-top:1px solid #e8f5e4;">{{ ucfirst(str_replace('_', ' ', $role)) }}</td>
              </tr>
            </table>
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
