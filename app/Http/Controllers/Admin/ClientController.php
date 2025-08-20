<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display clients
        $clients = Client::paginate(10); // Adjust the pagination as needed
        return view('pages.admin.clients.index', compact('clients'));
    }

    public function show($id)
    {
        // Logic to show a specific client
        $client = Client::with('commandes')->findOrFail($id);
        return view('pages.admin.clients.show', compact('client'));
    }

    public function create()
    {
        // Logic to show the form for creating a new client
        return view('pages.admin.clients.create');
    }

    public function store(ClientRequest $request)
    {
        // Logic to store a new client
        $validatedData = $request->validated();

        // $client = Client::create($validatedData);
        $client = new Client();
        $client->name = $validatedData['name'];
        $client->phone = $validatedData['phone'];
        $client->adresse = $validatedData['adresse'] ?? null; // Handle nullable field
   
        $client->user_id = Auth::id(); // Assuming the client is associated with the authenticated user
        $client->save();
        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully.');
    }

    public function edit($id)
    {
        // Logic to show the form for editing a client
        $client = Client::findOrFail($id);
        return view('pages.admin.clients.edit', compact('client'));
    }

    public function update(ClientRequest $request, $id)
    {
        // Logic to update a client
        $validatedData = $request->validated();

        $client = Client::findOrFail($id);
        $client->update($validatedData);
        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        // Logic to delete a client
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully.');
    }
}
