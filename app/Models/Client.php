<?php

namespace App\Models;

use App\Models\Reservation;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Reservation as GlobalReservation;

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

    /**
     * Relation many-to-many avec Prestation via Reservation.
     */
    public function proprestations()
    {
        return $this->belongsToMany(Proprestation::class, 'reservations')
                    ->using(Reservation::class)
                    ->withPivot('date_prévue', 'heure_prévue', 'montant', 'status')
                    ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}




