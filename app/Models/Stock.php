<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
   public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit');
    }
}
