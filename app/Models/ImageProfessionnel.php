<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProfessionnel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function professionnel()
    {
        return $this->belongsTo(Professionnel::class, 'etablissement_id');
    }
}
