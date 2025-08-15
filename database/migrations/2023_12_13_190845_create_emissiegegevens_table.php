<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmissiegegevensTable extends Migration
{
    public function up()
    {
        Schema::create('emissiegegevens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gekentekende_voertuig_id');
            $table->foreign('gekentekende_voertuig_id')->references('id')->on('gekentekende_voertuigen')->onDelete('cascade');
            $table->string('brandstof_volgnummer')->nullable();
            $table->string('brandstof_omschrijving')->nullable();
            $table->string('brandstofverbruik_buiten_de_stad')->nullable();
            $table->string('brandstofverbruik_gecombineerd')->nullable();
            $table->string('brandstofverbruik_stad')->nullable();
            $table->string('co2_uitstoot_gecombineerd')->nullable();
            $table->string('co2_uitstoot_gewogen')->nullable();
            $table->string('geluidsniveau_rijdend')->nullable();
            $table->string('geluidsniveau_stationair')->nullable();
            $table->string('emissieklasse')->nullable();
            $table->string('milieuklasse_eg_goedkeuring_licht')->nullable();
            $table->string('milieuklasse_eg_goedkeuring_zwaar')->nullable();
            $table->string('uitstoot_deeltjes_licht')->nullable();
            $table->string('uitstoot_deeltjes_zwaar')->nullable();
            $table->string('nettomaximumvermogen')->nullable();
            $table->string('nominaal_continu_maximumvermogen')->nullable();
            $table->string('roetuitstoot')->nullable();
            $table->string('toerental_geluidsniveau')->nullable();
            $table->float('emissie_deeltjes_type1_wltp')->nullable();
            $table->float('emissie_co2_gecombineerd_wltp')->nullable();
            $table->float('emissie_co2_gewogen_gecombineerd_wltp')->nullable();
            $table->float('brandstof_verbruik_gecombineerd_wltp')->nullable();
            $table->float('brandstof_verbruik_gewogen_gecombineerd_wltp')->nullable();
            $table->float('elektrisch_verbruik_enkel_elektrisch_wltp')->nullable();
            $table->float('actie_radius_enkel_elektrisch_wltp')->nullable();
            $table->float('actie_radius_enkel_elektrisch_stad_wltp')->nullable();
            $table->float('elektrisch_verbruik_extern_opladen_wltp')->nullable();
            $table->float('actie_radius_extern_opladen_wltp')->nullable();
            $table->float('actie_radius_extern_opladen_stad_wltp')->nullable();
            $table->float('max_vermogen_15_minuten')->nullable();
            $table->float('max_vermogen_60_minuten')->nullable();
            $table->float('netto_max_vermogen_elektrisch')->nullable();
            $table->string('klasse_hybride_elektrisch_voertuig')->nullable();
            $table->float('opgegeven_maximum_snelheid')->nullable();
            $table->string('uitlaatemissieniveau')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('emissiegegevens');
    }
}