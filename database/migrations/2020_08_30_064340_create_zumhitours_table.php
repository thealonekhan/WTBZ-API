<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZumhitoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zumhitours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('referenceCode');
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->integer('coordinates_id')->nullable();
            $table->integer('sponsor_id')->nullable();
            $table->text('url')->nullable();
            $table->text('coverImageUrl')->nullable();
            $table->text('logoImageUrl')->nullable();
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
        Schema::dropIfExists('zumhitours');
    }
}
