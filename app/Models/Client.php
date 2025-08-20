<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'adresse',
        'type_client',
    ];
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
