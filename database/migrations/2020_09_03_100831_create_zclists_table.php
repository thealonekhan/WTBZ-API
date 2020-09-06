<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZclistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('referenceCode');
            $table->dateTimeTz('createdDateUtc', 0)->nullable();
            $table->dateTimeTz('lastUpdatedDateUtc', 0)->nullable();
            $table->string('name', 191)->nullable();
            $table->uuid('ownerCode')->nullable();
            $table->longText('description')->nullable();
            $table->integer('listtype_id')->nullable();
            $table->boolean('isShared')->nullable();
            $table->boolean('isPublic')->nullable();
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
        Schema::dropIfExists('lists');
    }
}
