<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilite extends Model
{
    use HasFactory;
     // Définition de la table (facultatif si le nom de la table suit la convention plurielle de Laravel)
     protected $table = 'disponibilites';

     // Autorisation des attributs modifiables en masse
     protected $fillable = [
         'jour',
         'heure_ouverture',
         'heure_fermeture',
         'professionnel_id'
     ];

     // Relation entre la disponibilité et le professionnel
     public function professionnel()
     {
         return $this->belongsTo(Professionnel::class);
     }
 }

