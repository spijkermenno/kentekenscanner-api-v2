<?php

// app/Carrosseriegegevens.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrosseriegegevens extends Model
{
    use HasFactory;

    protected $fillable = [
        'carrosserie_volgnummer',
        'carrosserietype',
        'type_carrosserie_europese_omschrijving',
        'gekentekende_voertuig_id',
    ];
    
    protected $table = 'carrosseriegegevens';

    // Define the inverse relationship
    public function gekentekendeVoertuig()
    {
        return $this->belongsTo(GekentekendeVoertuigen::class, 'gekentekende_voertuig_id');
    }
}
