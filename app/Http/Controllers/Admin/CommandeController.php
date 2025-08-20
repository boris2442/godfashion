<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommandeController extends Controller
{
   // Affiche le formulaire de création
    public function create()
    {
        $clients = Client::all(); // pour le select client
        return view('pages.admin.commandes.create', compact('clients'));
    }
}
