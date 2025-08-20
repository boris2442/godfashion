<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
