<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Traits\HasRoles;

class Professionnel extends Model
{
    use HasFactory, HasApiTokens, Notifiable, HasRoles;

    protected $guarded = [];

    public function produits(): HasMany {

        return $this->hasMany(produit::class);
    }

    public function prestations() : BelongsToMany {

        return $this->belongsToMany(prestation::class, 'proprestation');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(ImageProfessionnel::class, 'etablissement_id');
    }
}
