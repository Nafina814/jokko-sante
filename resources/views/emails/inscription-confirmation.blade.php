<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Confirmation d'inscription — Jokko Santé</title>
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

        {{-- UTILISATEUR --}}
        @if($role === 'utilisateur')
        <p style="font-size:14px;color:#555555;line-height:1.7;margin:0 0 24px;">
          Votre inscription sur <strong style="color:#1A3D16;">Jokko Santé</strong> a été confirmée avec succès.
          Vous pouvez maintenant accéder à tous nos services gratuitement et en toute confidentialité.
        </p>

        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f0fdf4;border:1px solid #86efac;border-radius:6px;margin-bottom:24px;">
          <tr><td style="padding:14px 18px;">
            <p style="font-size:13px;font-weight:bold;color:#166534;margin:0 0 2px;">Compte activé</p>
            <p style="font-size:12px;color:#166534;margin:0;">Connectez-vous dès maintenant pour accéder à votre espace.</p>
          </td></tr>
        </table>

        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fdf6;border:1px solid #e8f5e4;border-radius:6px;margin-bottom:24px;">
          <tr><td style="padding:16px 18px;">
            <p style="font-size:11px;font-weight:bold;letter-spacing:1px;text-transform:uppercase;color:#2D5A27;margin:0 0 12px;">Ce que vous pouvez faire</p>
            <p style="font-size:13px;color:#333333;margin:0 0 8px;">— Passer le test PHQ-9 pour évaluer votre santé mentale</p>
            <p style="font-size:13px;color:#333333;margin:0 0 8px;">— Prendre rendez-vous avec un psychologue</p>
            <p style="font-size:13px;color:#333333;margin:0 0 8px;">— Accéder au forum communautaire et au chat</p>
            <p style="font-size:13px;color:#333333;margin:0;">— Utiliser l'assistant IA disponible 24h/24</p>
          </td></tr>
        </table>

        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
          <tr><td align="center">
            <a href="{{ url('/login') }}" style="display:inline-block;background:#1A3D16;color:#ffffff;text-decoration:none;padding:14px 36px;border-radius:6px;font-size:14px;font-weight:bold;">
              Accéder à mon espace
            </a>
          </td></tr>
        </table>

        {{-- PSYCHOLOGUE --}}
        @elseif($role === 'psychologue')
        <p style="font-size:14px;color:#555555;line-height:1.7;margin:0 0 24px;">
          Nous avons bien reçu votre demande d'inscription en tant que <strong style="color:#1A3D16;">Psychologue</strong> sur Jokko Santé.
          Votre dossier professionnel est en cours d'examen par notre équipe.
        </p>

        <table width="100%" cellpadding="0" cellspacing="0" style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:6px;margin-bottom:24px;">
          <tr><td style="padding:14px 18px;">
            <p style="font-size:13px;font-weight:bold;color:#1e40af;margin:0 0 2px;">Compte en attente de validation</p>
            <p style="font-size:12px;color:#1e40af;margin:0;">Délai : 24 à 48 heures ouvrables.</p>
          </td></tr>
        </table>

        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fdf6;border:1px solid #e8f5e4;border-radius:6px;margin-bottom:24px;">
          <tr><td style="padding:16px 18px;">
            <p style="font-size:11px;font-weight:bold;letter-spacing:1px;text-transform:uppercase;color:#2D5A27;margin:0 0 12px;">Informations soumises</p>
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td style="padding:5px 0;font-size:13px;color:#777777;width:40%;">Numéro d'ordre</td>
                <td style="padding:5px 0;font-size:13px;color:#1a1a1a;font-weight:bold;">{{ $user->numero_ordre ?? '—' }}</td>
              </tr>
              <tr>
                <td style="padding:5px 0;font-size:13px;color:#777777;border-top:1px solid #e8f5e4;">Spécialité</td>
                <td style="padding:5px 0;font-size:13px;color:#1a1a1a;font-weight:bold;border-top:1px solid #e8f5e4;">{{ $user->specialite ?? '—' }}</td>
              </tr>
              <tr>
                <td style="padding:5px 0;font-size:13px;color:#777777;border-top:1px solid #e8f5e4;">Établissement</td>
                <td style="padding:5px 0;font-size:13px;color:#1a1a1a;font-weight:bold;border-top:1px solid #e8f5e4;">{{ $user->etablissement ?? '—' }}</td>
              </tr>
            </table>
          </td></tr>
        </table>

        <p style="font-size:13px;color:#555555;line-height:1.7;margin:0 0 24px;padding:14px;background:#fafafa;border-left:3px solid #3A6B2F;border-radius:4px;">
          Vous recevrez un email de confirmation dès que votre compte sera validé. Vous pourrez alors vous connecter et accéder à votre espace psychologue.
        </p>

        {{-- PAIR-AIDANT --}}
        @elseif($role === 'pair_aidant')
        <p style="font-size:14px;color:#555555;line-height:1.7;margin:0 0 24px;">
          Nous avons bien reçu votre demande d'inscription en tant que <strong style="color:#1A3D16;">Pair-aidant</strong> sur Jokko Santé.
          Merci pour votre engagement communautaire au service des Sénégalais.
        </p>

        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f0fdf4;border:1px solid #86efac;border-radius:6px;margin-bottom:24px;">
          <tr><td style="padding:14px 18px;">
            <p style="font-size:13px;font-weight:bold;color:#166534;margin:0 0 2px;">Demande en cours de traitement</p>
            <p style="font-size:12px;color:#166534;margin:0;">Délai : 24 à 48 heures ouvrables.</p>
          </td></tr>
        </table>

        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fdf6;border:1px solid #e8f5e4;border-radius:6px;margin-bottom:24px;">
          <tr><td style="padding:16px 18px;">
            <p style="font-size:11px;font-weight:bold;letter-spacing:1px;text-transform:uppercase;color:#2D5A27;margin:0 0 12px;">Informations soumises</p>
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td style="padding:5px 0;font-size:13px;color:#777777;width:40%;">Type</td>
                <td style="padding:5px 0;font-size:13px;color:#1a1a1a;font-weight:bold;">{{ ucfirst(str_replace('_', ' ', $user->type_pair_aidant ?? '—')) }}</td>
              </tr>
              @if($user->organisation)
              <tr>
                <td style="padding:5px 0;font-size:13px;color:#777777;border-top:1px solid #e8f5e4;">Organisation</td>
                <td style="padding:5px 0;font-size:13px;color:#1a1a1a;font-weight:bold;border-top:1px solid #e8f5e4;">{{ $user->organisation }}</td>
              </tr>
              @endif
            </table>
          </td></tr>
        </table>

        <p style="font-size:13px;color:#555555;line-height:1.7;margin:0 0 24px;padding:14px;background:#fafafa;border-left:3px solid #3A6B2F;border-radius:4px;">
          Vous serez notifié(e) par email dès que votre demande sera validée. Votre engagement est précieux pour notre communauté.
        </p>
        @endif

        {{-- INFOS COMPTE --}}
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
              @if($user->telephone)
              <tr>
                <td style="padding:5px 0;font-size:13px;color:#777777;border-top:1px solid #e8f5e4;">Téléphone</td>
                <td style="padding:5px 0;font-size:13px;color:#1a1a1a;font-weight:bold;border-top:1px solid #e8f5e4;">{{ $user->telephone }}</td>
              </tr>
              @endif
              <tr>
                <td style="padding:5px 0;font-size:13px;color:#777777;border-top:1px solid #e8f5e4;">Profil</td>
                <td style="padding:5px 0;font-size:13px;color:#1a1a1a;font-weight:bold;border-top:1px solid #e8f5e4;">{{ ucfirst(str_replace('_', ' ', $role)) }}</td>
              </tr>
            </table>
          </td></tr>
        </table>

        {{-- CONFIDENTIALITÉ --}}
        <table width="100%" cellpadding="0" cellspacing="0" style="background:#fefce8;border:1px solid #fde68a;border-radius:6px;margin-bottom:24px;">
          <tr><td style="padding:12px 16px;font-size:12px;color:#92400e;line-height:1.6;">
            <strong>Confidentialité :</strong> Cet email est strictement confidentiel et destiné uniquement à {{ $user->name }}.
            Vos données personnelles sont sécurisées et uniquement accessibles par l'équipe de la plateforme.
          </td></tr>
        </table>

        {{-- URGENCES --}}
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
          Cet email a été envoyé automatiquement suite à votre inscription. Ne pas répondre.
        </p>
      </td>
    </tr>

  </table>
  </td></tr>
</table>
</body>
</html>
