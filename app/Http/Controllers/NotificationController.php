<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $notification->update(['read' => true]);

        return back()->with('success', 'Notificación marcada como leída.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'message' => 'required|string',
            'type' => 'required|in:reminder,result,alert',
        ]);

        Notification::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
        ]);

        return back()->with('success', 'Notificación creada.');
    }
}
