<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function stocks()
    {
        return $this->belongsToMany(Stock::class, 'commande_stocks')
            ->withPivot('quantite_utilisee');
    }
}
