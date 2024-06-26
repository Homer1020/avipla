<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('notificaciones.index');
    }

    public function markAllAsRead(Request $request) {
        $currentUser = $request->user();
        $currentUser->unreadNotifications->markAsRead();
        return redirect()->route('notifications.index');
    }
}
