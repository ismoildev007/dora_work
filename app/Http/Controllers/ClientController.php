<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Display a listing of the clients
    public function index()
    {
        $this->authorize('viewAny', Client::class);

        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    // Show the form for creating a new client
    public function create()
    {
        $this->authorize('create', Client::class);

        return view('admin.clients.create');
    }

    // Store a newly created client in storage
    public function store(Request $request)
    {
        $this->authorize('create', Client::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        Client::create($request->all());
        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    // Display the specified client
    public function show(Client $client)
    {
        $this->authorize('view', Client::class);

        return view('admin.clients.show', compact('client'));
    }

    // Show the form for editing the specified client
    public function edit(Client $client)
    {
        $this->authorize('update', $client);

        return view('admin.clients.edit', compact('client'));
    }

    // Update the specified client in storage
    public function update(Request $request, Client $client)
    {
        $this->authorize('update', $client);

        $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $client->update($request->all());
        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    // Remove the specified client from storage
    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);

        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
