<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_stocks')
            ->withPivot('quantite_utilisee');
    }
}
