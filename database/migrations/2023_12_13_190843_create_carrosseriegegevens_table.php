<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrosseriegegevensTable extends Migration
{
    public function up()
    {
        Schema::create('carrosseriegegevens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gekentekende_voertuig_id');
            $table->foreign('gekentekende_voertuig_id')->references('id')->on('gekentekende_voertuigen')->onDelete('cascade');
            $table->string('carrosserie_volgnummer')->nullable();
            $table->string('carrosserietype')->nullable();
            $table->string('type_carrosserie_europese_omschrijving')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carrosseriegegevens');
    }
}