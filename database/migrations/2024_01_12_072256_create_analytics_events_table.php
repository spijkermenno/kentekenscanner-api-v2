<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyticsEventsTable extends Migration
{
    public function up()
    {
        Schema::create('analytics_events', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('event_name');
            $table->json('parameters')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('analytics_events');
    }
}
