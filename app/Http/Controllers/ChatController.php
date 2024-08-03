<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function index()
    {
        return view('admin.chat.index');
    }

    public function broadcast(Request $request)
    {
        $message = $request->get('message');
        broadcast(new MessageSent($message))->toOthers();
        return view('admin.chat.broadcast', ['message' => $message]);
    }

    public function receive(Request $request)
    {
        return view('admin.chat.receive', ['message' => $request->get('message')]);
    }
}
