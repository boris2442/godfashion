<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommandeImage extends Model
{
    use HasFactory;

    protected $fillable = ['commande_id', 'chemin_image'];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
