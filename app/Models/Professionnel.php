<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Professionnel extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'professionnels'; // Utiliser la table professionnels

    protected $guarded = [];

    public function produits(): HasMany {

        return $this->hasMany(Produit::class);
    }

    public function prestations() : BelongsToMany {

        return $this->belongsToMany(Prestation::class, 'proprestations')
        ->withPivot('id','professionnel_id', 'prestation_id')
        ->withTimestamps();
    }
    public function proprestation()
    {
        return $this->hasMany(Proprestation::class, 'professionnel_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(ImageProfessionnel::class, 'professionnel_id');
    }



}
