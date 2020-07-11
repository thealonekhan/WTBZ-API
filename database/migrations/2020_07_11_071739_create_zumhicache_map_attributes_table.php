<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZumhicacheMapAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zumhicache_map_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('zumhicache_id')->unsigned()->index();
            $table->integer('attribute_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zumhicache_map_attributes');
    }
}
