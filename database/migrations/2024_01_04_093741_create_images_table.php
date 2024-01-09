<?php

// database/migrations/create_images_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gekentekende_voertuigen_id');
            $table->foreign('gekentekende_voertuigen_id')->references('id')->on('gekentekende_voertuigen')->onDelete('cascade');
            $table->string('file_path');
            $table->boolean("validated")->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
}
