<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Commande;
use App\Models\CommandeImage;
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


    public function store(CommandeRequest $request)
    {
        // 1️⃣ Création de la commande (sans images)
        $commande = Commande::create([
            'client_id' => $request->client_id,
            'type_habit' => $request->type_habit,
            'tissu' => $request->tissu,
            'mesures' => $request->mesures,
            'prix_total' => $request->prix_total,
            'avance' => $request->avance ?? 0,
            'date_livraison' => $request->date_livraison,
            'statut' => $request->statut,
        ]);

        // 2️⃣ Gestion des images
        if ($request->hasFile('image_tissu')) {
            foreach ($request->file('image_tissu') as $image) {
                if ($image->isValid()) {
                    // Stocke l'image dans le dossier public
                    $chemin = $image->store('images/tissus', 'public');

                    // Crée une entrée dans la table commande_images
                    $commande->images()->create([
                        'chemin_image' => $chemin,
                    ]);
                }
            }
        }

        // 3️⃣ Retour
        return redirect()->route('admin.commandes.index')
            ->with('success', 'Commande ajoutée avec succès.');
    }

    public function index()
    {
        // Récupérer toutes les commandes avec les relations éventuelles (ex: client)
        $commandes = Commande::with('images', 'client')
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Pagination de 10 commandes par page

        return view('pages.admin.commandes.index', compact('commandes'));
    }
    public function edit($id)
    {
        $commande = Commande::with('images')->findOrFail($id);
        $clients = Client::all(); // Pour le select client
        return view('pages.admin.commandes.edit', compact('commande', 'clients'));
    }

    public function update(Request $request, $id)
    {
        // Valide les données
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'type_habit' => 'required|string|max:255',
            'tissu' => 'nullable|string',
            'mesures' => 'nullable|string',
            'prix_total' => 'required|numeric|min:0',
            'avance' => 'nullable|numeric|min:0',
            'date_livraison' => 'required|date|after_or_equal:today',
        ]);
        $commande = Commande::findOrFail($id);
        // Mise à jour complète
        $commande->update($data);
        return redirect()->route('admin.commandes.index')
            ->with('success', 'Commande mise à jour avec succès.');
    }
    public function destroy(Commande $commande)
    {

        $imagePaths = json_decode($commande->image_tissu, true) ?? [];
        foreach ($imagePaths as $image) {
            Storage::disk('public')->delete($image);
        }


        $commande->delete();

        return redirect()->route('admin.commandes.index')
            ->with('success', 'Commande supprimée avec succès.');
    }
}
