<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserwaypointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userwaypoints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('referenceCode');
            $table->text('description')->nullable();
            $table->boolean('isCorrectedCoordinates')->nullable();
            $table->integer('coordinates_id')->nullable();
            $table->uuid('zumhiCode')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userwaypoints');
    }
}
