<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('referenceCode');
            $table->text('iconUrl')->nullable();
            $table->string('name', 191)->nullable();
            $table->string('goal', 255)->nullable();
            $table->longText('description')->nullable();
            $table->date('releasedDate')->nullable();
            $table->integer('country_id')->nullable();
            $table->uuid('ownerCode')->nullable();
            $table->uuid('holderCode')->nullable();
            $table->boolean('inHolderCollection')->nullable();
            $table->uuid('zumhiCode')->nullable();
            $table->boolean('isMissing')->nullable();
            $table->integer('trackingNumber')->nullable();
            $table->decimal('kilometersTraveled', 10, 1)->nullable();
            $table->decimal('milesTraveled', 10, 1)->nullable();
            $table->integer('type_id')->nullable();
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
        Schema::dropIfExists('trackables');
    }
}
