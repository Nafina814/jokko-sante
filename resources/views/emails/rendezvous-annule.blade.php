<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Rendez-vous annulé — Jokko Santé</title>
</head>
<body style="margin:0;padding:0;background:#F5F9F4;font-family:'Helvetica Neue',Arial,sans-serif;">
<div style="max-width:580px;margin:40px auto;background:white;border-radius:20px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.08);">

  <div style="background:linear-gradient(135deg,#1A3D16,#2D5A27);padding:36px 40px;text-align:center;">
    <div style="width:64px;height:64px;background:rgba(232,245,228,.15);border:1px solid rgba(232,245,228,.25);border-radius:16px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px;">
      <span style="font-size:2rem;">❌</span>
    </div>
    <h1 style="font-size:1.6rem;font-weight:700;color:white;margin:0 0 6px;">JokkoSanté</h1>
    <p style="color:rgba(255,255,255,.55);font-size:.8rem;margin:0;letter-spacing:.06em;text-transform:uppercase;">Plateforme de santé mentale · Sénégal</p>
  </div>

  <div style="padding:40px;">

    <h2 style="font-size:1.35rem;color:#0f2410;margin:0 0 8px;font-weight:600;">
      Bonjour {{ $rendezvous->patient->name }},
    </h2>

    <p style="color:#5a7a55;font-size:.9rem;line-height:1.85;margin:0 0 24px;">
      Nous vous informons que votre rendez-vous avec
      <strong style="color:#1A3D16;">Dr. {{ $rendezvous->psychologue->name }}</strong>
      a été <strong>annulé</strong>.
    </p>

    {{-- Badge annulation --}}
    <div style="background:#fef2f2;border:1px solid #fca5a5;border-radius:14px;padding:16px 20px;margin-bottom:28px;display:flex;align-items:center;gap:12px;">
      <span style="font-size:1.4rem;">❌</span>
      <div>
        <p style="color:#991b1b;font-size:.88rem;font-weight:700;margin:0 0 3px;">Rendez-vous annulé</p>
        <p style="color:#991b1b;font-size:.8rem;margin:0;opacity:.8;">Vous pouvez en prendre un nouveau dès maintenant.</p>
      </div>
    </div>

    {{-- Détails RDV --}}
    <div style="background:#f8fdf6;border:1px solid #e8f5e4;border-radius:14px;padding:20px;margin-bottom:28px;">
      <p style="font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#2D5A27;margin:0 0 12px;">Rendez-vous annulé</p>
      <table style="width:100%;border-collapse:collapse;">
        <tr>
          <td style="padding:6px 0;font-size:.82rem;color:#5a7a55;width:35%;">Psychologue</td>
          <td style="padding:6px 0;font-size:.82rem;color:#0f2410;font-weight:600;">Dr. {{ $rendezvous->psychologue->name }}</td>
        </tr>
        <tr>
          <td style="padding:6px 0;font-size:.82rem;color:#5a7a55;border-top:1px solid #e8f5e4;">Date & heure</td>
          <td style="padding:6px 0;font-size:.82rem;color:#0f2410;font-weight:600;border-top:1px solid #e8f5e4;">
            {{ $rendezvous->date_heure->format('d/m/Y à H:i') }}
          </td>
        </tr>
      </table>
    </div>

    {{-- CTA --}}
    <div style="text-align:center;margin-bottom:28px;">
      <a href="{{ url('/rendezvous') }}"
         style="display:inline-block;background:linear-gradient(135deg,#1A3D16,#3A6B2F);color:white;text-decoration:none;padding:14px 36px;border-radius:12px;font-size:.95rem;font-weight:700;box-shadow:0 6px 20px rgba(26,61,22,.25);">
        📅 Prendre un nouveau rendez-vous
      </a>
    </div>

    <div style="border-top:1px solid #e8f5e4;padding-top:16px;text-align:center;">
      <p style="font-size:.76rem;color:#5a7a55;">
        🚨 En cas d'urgence :
        <strong style="color:#dc2626;">116</strong> (SAMU Social) ·
        <strong style="color:#dc2626;">17</strong> (Police) ·
        <strong style="color:#dc2626;">800 00 19 19</strong> (SOS Femmes, gratuit)
      </p>
    </div>

  </div>

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
