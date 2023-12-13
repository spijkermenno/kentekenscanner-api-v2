<?php

// database/migrations/2023_01_03_create_gekentekende_voertuigen_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGekentekendeVoertuigenTable extends Migration
{
    public function up()
    {
        Schema::create('gekentekende_voertuigen', function (Blueprint $table) {
            $table->id();
            $table->string('kenteken')->unique();
            $table->string('voertuigsoort')->nullable();
            $table->string('merk')->nullable();
            $table->string('handelsbenaming')->nullable();
            $table->integer('vervaldatum_apk')->nullable();
            $table->integer('datum_tenaamstelling')->nullable();
            $table->float('bruto_bpm')->nullable();
            $table->string('inrichting')->nullable();
            $table->integer('aantal_zitplaatsen')->nullable();
            $table->string('eerste_kleur')->nullable();
            $table->string('tweede_kleur')->nullable();
            $table->integer('aantal_cilinders')->nullable();
            $table->float('cilinderinhoud')->nullable();
            $table->float('massa_ledig_voertuig')->nullable();
            $table->float('toegestane_maximum_massa_voertuig')->nullable();
            $table->float('massa_rijklaar')->nullable();
            $table->float('maximum_massa_trekken_ongeremd')->nullable();
            $table->float('maximum_trekken_massa_geremd')->nullable();
            $table->integer('datum_eerste_toelating')->nullable();
            $table->integer('datum_eerste_tenaamstelling_in_nederland')->nullable();
            $table->string('wacht_op_keuren')->nullable();
            $table->float('catalogusprijs')->nullable();
            $table->string('wam_verzekerd')->nullable();
            $table->float('maximum_constructiesnelheid')->nullable();
            $table->float('laadvermogen')->nullable();
            $table->float('oplegger_geremd')->nullable();
            $table->float('aanhangwagen_autonoom_geremd')->nullable();
            $table->integer('aanhangwagen_middenas_geremd')->nullable();
            $table->integer('aantal_staanplaatsen')->nullable();
            $table->integer('aantal_deuren')->nullable();
            $table->integer('aantal_wielen')->nullable();
            $table->float('afstand_hart_koppeling_tot_achterzijde_voertuig')->nullable();
            $table->float('afstand_voorzijde_voertuig_tot_hart_koppeling')->nullable();
            $table->float('afwijkende_maximum_snelheid')->nullable();
            $table->float('lengte')->nullable();
            $table->float('breedte')->nullable();
            $table->string('europese_voertuigcategorie')->nullable();
            $table->string('europese_voertuigcategorie_toevoeging')->nullable();
            $table->string('europese_uitvoeringcategorie_toevoeging')->nullable();
            $table->string('plaats_chassisnummer')->nullable();
            $table->float('technische_max_massa_voertuig')->nullable();
            $table->string('type')->nullable();
            $table->string('type_gasinstallatie')->nullable();
            $table->string('typegoedkeuringsnummer')->nullable();
            $table->string('variant')->nullable();
            $table->string('uitvoering')->nullable();
            $table->float('volgnummer_wijziging_eu_typegoedkeuring')->nullable();
            $table->float('vermogen_massarijklaar')->nullable();
            $table->float('wielbasis')->nullable();
            $table->string('export_indicator')->nullable();
            $table->string('openstaande_terugroepactie_indicator')->nullable();
            $table->integer('vervaldatum_tachograaf')->nullable();
            $table->string('taxi_indicator')->nullable();
            $table->float('maximum_massa_samenstelling')->nullable();
            $table->integer('aantal_rolstoelplaatsen')->nullable();
            $table->float('maximum_ondersteunende_snelheid')->nullable();
            $table->integer('jaar_laatste_registratie_tellerstand')->nullable();
            $table->string('tellerstandoordeel')->nullable();
            $table->string('code_toelichting_tellerstandoordeel')->nullable();
            $table->string('tenaamstellen_mogelijk')->nullable();
            $table->datetime('vervaldatum_apk_dt')->nullable();
            $table->datetime('datum_tenaamstelling_dt')->nullable();
            $table->datetime('datum_eerste_toelating_dt')->nullable();
            $table->datetime('datum_eerste_tenaamstelling_nederland_dt')->nullable();
            $table->datetime('vervaldatum_tachograaf_dt')->nullable();
            $table->float('max_last_onder_de_voorassen_koppeling')->nullable();
            $table->string('type_remsysteem_voertuig_code')->nullable();
            $table->string('rupsonderstel_configuratiecode')->nullable();
            $table->float('wielbasis_voertuig_minimum')->nullable();
            $table->float('wielbasis_voertuig_maximum')->nullable();
            $table->float('lengte_voertuig_minimum')->nullable();
            $table->float('lengte_voertuig_maximum')->nullable();
            $table->float('breedte_voertuig_minimum')->nullable();
            $table->float('breedte_voertuig_maximum')->nullable();
            $table->float('hoogte_voertuig')->nullable();
            $table->float('hoogte_voertuig_minimum')->nullable();
            $table->float('hoogte_voertuig_maximum')->nullable();
            $table->float('massa_bedrijfsklaar_minimaal')->nullable();
            $table->float('massa_bedrijfsklaar_maximaal')->nullable();
            $table->float('technisch_toelaatbaar_massa_koppelpunt')->nullable();
            $table->float('maximum_massa_technisch_maximaal')->nullable();
            $table->float('maximum_massa_technisch_minimaal')->nullable();
            $table->string('subcategorie_nederland')->nullable();
            $table->float('verticale_belasting_koppelpunt_getrokken_voertuig')->nullable();
            $table->string('zuinigheidsclassificatie')->nullable();
            $table->integer('registratie_datum_goedkeuring_afschrijvingsmoment_bpm')->nullable();
            $table->datetime('registratie_datum_goedkeuring_afschrijvingsmoment_bpm_dt')->nullable();
            $table->float('gemiddelde_lading_waarde')->nullable();
            $table->string('aerodynamische_voorziening_of_uitrusting')->nullable();
            $table->float('additionele_massa_alternatieve_aandrijving')->nullable();
            $table->string('verlengde_cabine_indicator')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gekentekende_voertuigen');
    }
}
