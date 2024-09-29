<?php

namespace App\Models;


use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proprestation extends Model
{
   use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'proprestations';

    protected $guarded = [];

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'reservations')
                    ->using(Reservation::class)
                    ->withPivot('date_prévue', 'heure_prévue', 'montant', 'status')
                    ->withTimestamps();
    }


    /**
     * Relation many-to-many avec Client via Reservation.
     */

}


