<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->limit(10)->get();
        return view('admin.notification.index', compact('notifications'));
    }

    public function show($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return view('admin.notification.show', compact('notification'));
    }

    public function clear()
    {
        auth()->user()->notifications()->delete();
        return redirect()->back();
    }

    public function all()
    {
        $notifications = auth()->user()->notifications()->get();
        return view('admin.notification.all', compact('notifications'));
    }
}
