<?php

// app/GekentekendeVoertuigen.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GekentekendeVoertuigen extends Model
{
    use HasFactory;

    protected $fillable = [
        'kenteken',
        'voertuigsoort',
        'merk',
        'handelsbenaming',
        'vervaldatum_apk',
        'datum_tenaamstelling',
        'bruto_bpm',
        'inrichting',
        'aantal_zitplaatsen',
        'eerste_kleur',
        'tweede_kleur',
        'aantal_cilinders',
        'cilinderinhoud',
        'massa_ledig_voertuig',
        'toegestane_maximum_massa_voertuig',
        'massa_rijklaar',
        'maximum_massa_trekken_ongeremd',
        'maximum_trekken_massa_geremd',
        'datum_eerste_toelating',
        'datum_eerste_tenaamstelling_in_nederland',
        'wacht_op_keuren',
        'catalogusprijs',
        'wam_verzekerd',
        'maximum_constructiesnelheid',
        'laadvermogen',
        'oplegger_geremd',
        'aanhangwagen_autonoom_geremd',
        'aanhangwagen_middenas_geremd',
        'aantal_staanplaatsen',
        'aantal_deuren',
        'aantal_wielen',
        'afstand_hart_koppeling_tot_achterzijde_voertuig',
        'afstand_voorzijde_voertuig_tot_hart_koppeling',
        'afwijkende_maximum_snelheid',
        'lengte',
        'breedte',
        'europese_voertuigcategorie',
        'europese_voertuigcategorie_toevoeging',
        'europese_uitvoeringcategorie_toevoeging',
        'plaats_chassisnummer',
        'technische_max_massa_voertuig',
        'type',
        'type_gasinstallatie',
        'typegoedkeuringsnummer',
        'variant',
        'uitvoering',
        'volgnummer_wijziging_eu_typegoedkeuring',
        'vermogen_massarijklaar',
        'wielbasis',
        'export_indicator',
        'openstaande_terugroepactie_indicator',
        'vervaldatum_tachograaf',
        'taxi_indicator',
        'maximum_massa_samenstelling',
        'aantal_rolstoelplaatsen',
        'maximum_ondersteunende_snelheid',
        'jaar_laatste_registratie_tellerstand',
        'tellerstandoordeel',
        'code_toelichting_tellerstandoordeel',
        'tenaamstellen_mogelijk',
        'vervaldatum_apk_dt',
        'datum_tenaamstelling_dt',
        'datum_eerste_toelating_dt',
        'datum_eerste_tenaamstelling_nederland_dt',
        'vervaldatum_tachograaf_dt',
        'max_last_onder_de_voorassen_koppeling',
        'type_remsysteem_voertuig_code',
        'rupsonderstel_configuratiecode',
        'wielbasis_voertuig_minimum',
        'wielbasis_voertuig_maximum',
        'lengte_voertuig_minimum',
        'lengte_voertuig_maximum',
        'breedte_voertuig_minimum',
        'breedte_voertuig_maximum',
        'hoogte_voertuig',
        'hoogte_voertuig_minimum',
        'hoogte_voertuig_maximum',
        'massa_bedrijfsklaar_minimaal',
        'massa_bedrijfsklaar_maximaal',
        'technisch_toelaatbaar_massa_koppelpunt',
        'maximum_massa_technisch_maximaal',
        'maximum_massa_technisch_minimaal',
        'subcategorie_nederland',
        'verticale_belasting_koppelpunt_getrokken_voertuig',
        'zuinigheidsclassificatie',
        'registratie_datum_goedkeuring_afschrijvingsmoment_bpm',
        'registratie_datum_goedkeuring_afschrijvingsmoment_bpm_dt',
        'gemiddelde_lading_waarde',
        'aerodynamische_voorziening_of_uitrusting',
        'additionele_massa_alternatieve_aandrijving',
        'verlengde_cabine_indicator',
        'updated_at'
    ];
    
    protected $table = 'gekentekende_voertuigen';

    // Define the one-to-many relationship
    public function emissiegegevens()
    {
        return $this->hasMany(Emissiegegevens::class, 'gekentekende_voertuig_id');
    }

    // Define the one-to-many relationship
    public function carrosseriegegevens()
    {
        return $this->hasMany(Carrosseriegegevens::class, 'gekentekende_voertuig_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'gekentekende_voertuigen_id')->where('validated', true);
    }   
}
