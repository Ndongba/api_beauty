<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory,HasApiTokens, Notifiable;

    protected $guarded = [];

    public function produits() : HasMany{

        return $this->hasMany(produit::class);
    }

    public function prestations() : HasMany {

        return $this->hasMany(prestation::class);
    }

}

