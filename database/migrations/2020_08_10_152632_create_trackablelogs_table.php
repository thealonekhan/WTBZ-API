<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackablelogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackablelogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('referenceCode');
            $table->uuid('ownerCode')->nullable();
            $table->uuid('trackableCode')->nullable();
            $table->uuid('zumhiCode')->nullable();
            $table->date('logDate')->nullable();
            $table->text('text')->nullable();
            $table->boolean('isRot13Encoded')->nullable();
            $table->integer('trackableLogTypeId')->nullable();
            $table->integer('coordinates_id')->nullable();
            $table->integer('trackingNumber')->nullable();
            $table->text('url')->nullable();
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
        Schema::dropIfExists('trackablelogs');
    }
}
