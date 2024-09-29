<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Client extends Model
{
    use HasFactory,HasApiTokens, Notifiable;

    protected $guarded = [];

    public function temoignages(): HasMany {

        return $this->hasMany(temoignage::class);
    }

    public function produits(): BelongsToMany {

        return $this->belongsToMany(produit::class, 'commande')
                    ->using(Commande::class)
                    ->withPivot('quantite')
                    ->withTimestamps();
    }



    public function proprestations()
    {
        return $this->belongsToMany(proprestation::class,'reservation', 'client_id', 'proprestation_id')
                    ->using(Reservation::class)
                    ->withPivot('date_prevue')
                    ->withPivot('heure_prevue')
                    ->withPivot('montant')
                    ->withPivot('status')
                    ->withPivot('timestamps');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
