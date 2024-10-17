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
            ->withPivot('date_prévue', 'heure_prévue', 'montant', 'status')
            ->withTimestamps(); // Remplace `withPivot('timestamps')` par `withTimestamps()`

    }
    public function professionnel()
    {
        return $this->belongsTo(Professionnel::class,'professionnel_id');
    }

    //relation avec presation
    public function prestation()
    {
        return $this->belongsTo(Prestation::class,'prestation_id');
    }

    /**
     * Relation many-to-many avec Client via Reservation.
     */

}


