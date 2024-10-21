<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProfessionnel extends Model
{
    use HasFactory;

    protected $table = 'images_professionnels'; // Assure-toi que le nom de la table est correct
    protected $guarded = [];

    public function professionnel()
    {
        return $this->belongsTo(Professionnel::class, 'professionnel_id');
    }
}
