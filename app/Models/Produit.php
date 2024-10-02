<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produit extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $guarded = [];

    public function categories(): BelongsTo {

        return $this->belongsTo(Categorie::class);
    }

    public function professionnels() : BelongsTo {

        return $this->belongsTo(professionnel::class);
    }

    public function clients(): BelongsToMany {

        return $this->belongsToMany(client::class, 'commande')
                    ->using(Commande::class)
                    ->withPivot('quantite')
                    ->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(ImageProduit::class, 'produit_id');
    }
}
