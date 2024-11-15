<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Pivot
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'reservations';

     protected $guarded = [];

    /**
     * Relation : La réservation appartient à un client.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
 

    /**
     * Relation : La réservation est liée à une prestation.
     */
    public function proprestation()
    {
        return $this->belongsTo(Proprestation::class, 'proprestation_id');
    }



}



