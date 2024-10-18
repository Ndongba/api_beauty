<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Prestation extends Model
{
    use HasFactory,HasApiTokens, Notifiable;

    protected $guarded = [];

    public function categories(): BelongsTo {

        return $this->belongsTo(Categorie::class);
    }

    public function professionnels(): BelongsToMany {

        return $this->belongsToMany(Professionnel::class, 'proprestations')
        ->withPivot('id','professionnel_id', 'prestation_id')
        ->withTimestamps();

    }
    public function proprestation()
    {
        return $this->hasMany(Proprestation::class, 'prestation_id');
    }
}
