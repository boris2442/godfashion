<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commande;

class PaiementController extends Controller
{
   public function create()
   {
    //$commandes = Commande::with([]); // Récupérer toutes les commandes pour le formulaire
       // Logique pour afficher le formulaire de création de paiement
       return view('pages.admin.paiements.create');
   }
}
