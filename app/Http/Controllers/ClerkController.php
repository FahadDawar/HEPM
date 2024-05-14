<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Clinician;
use Illuminate\Http\Request;

class ClerkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $images = Image::whereHas('clinician')
        ->with('clinician')
        ->where('user_id', auth()->id())
        ->where('status', 'pending')
        ->latest()->paginate();

        $notifications = auth()->user()->unreadNotifications;


        return view('dashboard', compact('images', 'notifications'));
    }

    /**
     * Get unread notifications
     */
    public function notifications()
    {
        $notifications = auth()->user()->unreadNotifications;

        $notification_count = count($notifications);

        return response()->json([
            'notifications' => $notifications,
            'notification_count' => $notification_count
        ]);
    }

}
