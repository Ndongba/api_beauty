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

        return $this->belongsToMany(Client::class, 'reservation', 'client_id', 'proprestation_id')
            ->using(Reservation::class)
            ->withPivot('date_prevue', 'heure_prevue', 'montant', 'status')
            ->withTimestamps(); // Remplace `withPivot('timestamps')` par `withTimestamps()`

    }


    /**
     * Relation many-to-many avec Client via Reservation.
     */

}


