<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\NotificationPlateforme;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = NotificationPlateforme::where(
                'user_id',
                Auth::id()
            )
            ->latest()
            ->paginate(20);

        return view(
            'notifications.index',
            compact('notifications')
        );
    }
}