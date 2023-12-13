<?php

// app/Emissiegegevens.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emissiegegevens extends Model
{
    use HasFactory;

    protected $fillable = [
        'brandstof_volgnummer',
        'brandstof_omschrijving',
        'brandstofverbruik_buiten_de_stad',
        'brandstofverbruik_gecombineerd',
        'brandstofverbruik_stad',
        'co2_uitstoot_gecombineerd',
        'co2_uitstoot_gewogen',
        'geluidsniveau_rijdend',
        'geluidsniveau_stationair',
        'emissieklasse',
        'milieuklasse_eg_goedkeuring_licht',
        'milieuklasse_eg_goedkeuring_zwaar',
        'uitstoot_deeltjes_licht',
        'uitstoot_deeltjes_zwaar',
        'nettomaximumvermogen',
        'nominaal_continu_maximumvermogen',
        'roetuitstoot',
        'toerental_geluidsniveau',
        'emissie_deeltjes_type1_wltp',
        'emissie_co2_gecombineerd_wltp',
        'emissie_co2_gewogen_gecombineerd_wltp',
        'brandstof_verbruik_gecombineerd_wltp',
        'brandstof_verbruik_gewogen_gecombineerd_wltp',
        'elektrisch_verbruik_enkel_elektrisch_wltp',
        'actie_radius_enkel_elektrisch_wltp',
        'actie_radius_enkel_elektrisch_stad_wltp',
        'elektrisch_verbruik_extern_opladen_wltp',
        'actie_radius_extern_opladen_wltp',
        'actie_radius_extern_opladen_stad_wltp',
        'max_vermogen_15_minuten',
        'max_vermogen_60_minuten',
        'netto_max_vermogen_elektrisch',
        'klasse_hybride_elektrisch_voertuig',
        'opgegeven_maximum_snelheid',
        'uitlaatemissieniveau',
        'gekentekende_voertuig_id',
    ];
        protected $table = 'emissiegegevens';

    // Define the inverse relationship
    public function gekentekendeVoertuig()
    {
        return $this->belongsTo(GekentekendeVoertuigen::class, 'gekentekende_voertuig_id');
    }
}
