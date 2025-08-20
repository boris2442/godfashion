<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Logique pour afficher la liste des utilisateurs
        $users=User::paginate(10); // Exemple de pagination
        return view('pages.admin.users.index', compact('users'));
   
    }

    // public function create()
    // {
    //     // Logique pour afficher le formulaire de création d'utilisateur
    //     return view('pages.admin.users.create');
    // }

    // public function store(Request $request)
    // {

    //     return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès.');
    // }

    // public function edit($id)
    // {

    //     return view('pages.admin.users.edit', compact('id'));
    // }

    // public function update(Request $request, $id)
    // {

    //     return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    // }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
