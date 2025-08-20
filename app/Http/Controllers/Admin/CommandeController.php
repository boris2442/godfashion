<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommandeRequest;
use Illuminate\Support\Facades\Storage;



class CommandeController extends Controller
{
    // Affiche le formulaire de création
    public function create()
    {
        $clients = Client::all(); // pour le select client
        return view('pages.admin.commandes.create', compact('clients'));
    }


    // public function store(CommandeRequest $request)
    // {
    //     $imagePaths = [];

    //     // Vérifie s'il y a des fichiers uploadés
    //     if ($request->hasFile('image_tissu')) {
    //         foreach ($request->file('image_tissu') as $image) {
    //             // Stocke chaque image dans storage/app/public/images/tissus
    //             $imagePaths[] = $image->store('images/tissus', 'public');
    //         }
    //     }

    //     // Création de la commande
    //     $commande = Commande::create([
    //         'client_id' => $request->client_id,
    //         'type_habit' => $request->type_habit,
    //         'tissu' => $request->tissu,
    //         'mesures' => $request->mesures,

    //         'prix_total' => $request->prix_total,

    //         'avance' => $request->avance ?? 0,
    //         'date_livraison' => $request->date_livraison,
    //         'statut' => $request->statut,
    //         // Stocke les chemins des images en JSON
    //         'image_tissu' => json_encode($imagePaths),
    //     ]);

    //     return redirect()->route('admin.commandes.index')
    //         ->with('success', 'Commande ajoutée avec succès.');
    // }
    public function store(CommandeRequest $request)
    {
        $imagePaths = [];

        if ($request->hasFile('image_tissu')) {
            foreach ($request->file('image_tissu') as $image) {
                // Vérifie que le fichier est valide
                if ($image->isValid()) {
                    $imagePaths[] = $image->store('images/tissus', 'public');
                }
            }
        }

        // Création de la commande
        Commande::create([
            'client_id' => $request->client_id,
            'type_habit' => $request->type_habit,
            'tissu' => $request->tissu,
            'mesures' => $request->mesures,
            'prix_total' => $request->prix_total,
            'avance' => $request->avance ?? 0,
            'date_livraison' => $request->date_livraison,
            'statut' => $request->statut,
            'image_tissu' => json_encode($imagePaths), // ✅ Enregistre les chemins
        ]);

        return redirect()->route('admin.commandes.index')
            ->with('success', 'Commande ajoutée avec succès.');
    }
    public function index()
    {
        // Récupérer toutes les commandes avec les relations éventuelles (ex: client)
        $commandes = Commande::with('client')
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Pagination de 10 commandes par page

        return view('pages.admin.commandes.index', compact('commandes'));
    }
    public function edit($id)
    {
        $commande = Commande::findOrFail($id);
        $clients = Client::all(); // Pour le select client
        return view('pages.admin.commandes.edit', compact('commande', 'clients'));
    }

    public function update(CommandeRequest $request, Commande $commande)
    {

        // Si une nouvelle image est envoyée
        if ($request->hasFile('image')) {
            // Supprimer l’ancienne image si elle existe
            if ($commande->image) {
                Storage::disk('public')->delete($commande->image);
            }

            // Stocker la nouvelle image
            $imagePath = $request->file('image')->store('commandes', 'public');
        } else {
            $imagePath = $commande->image; // garder l’ancienne
        }

        // Mise à jour
        $commande->update([
            'client_id'           => $request->client_id,
            'description'         => $request->description,
            'mesures'             => $request->mesures,
            'date_livraison'      => $request->date_livraison,
            'date_livraison_reelle' => $request->date_livraison_reelle,
            'status'              => $request->status,
            'image'               => $imagePath,
        ]);

        return redirect()->route('admin.commandes.index')
            ->with('success', 'Commande mise à jour avec succès.');
    }
    public function destroy(Commande $commande)
    {
        // Supprimer les images associées
        $imagePaths = json_decode($commande->image_tissu, true) ?? [];
        foreach ($imagePaths as $image) {
            Storage::disk('public')->delete($image);
        }

        // Supprimer la commande
        $commande->delete();

        return redirect()->route('admin.commandes.index')
            ->with('success', 'Commande supprimée avec succès.');
    }
}
