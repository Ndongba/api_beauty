<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Temoignage extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $guarded = [];

    public function clients() : BelongsTo {

        return $this->belongsTo(client::class);
    }
}
