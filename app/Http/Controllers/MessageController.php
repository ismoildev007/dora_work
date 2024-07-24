<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('conversation', 'sender')->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function create()
    {
        return view('admin.messages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'sender_id' => 'required|exists:users,id',
            'content' => 'required',
        ]);

        Message::create($request->all());

        return redirect()->route('messages.index')->with('success', 'Message created successfully.');
    }

    public function show($id)
    {
        $message = Message::with('conversation', 'sender')->findOrFail($id);
        return view('admin.messages.show', compact('message'));
    }

    public function edit($id)
    {
        $message = Message::findOrFail($id);
        return view('admin.messages.edit', compact('message'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'sender_id' => 'required|exists:users,id',
            'content' => 'required',
        ]);

        $message = Message::findOrFail($id);
        $message->update($request->all());

        return redirect()->route('messages.index')->with('success', 'Message updated successfully.');
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('messages.index')->with('success', 'Message deleted successfully.');
    }
}
