<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourMapZumhiCachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_map_zumhi_caches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('zumhicache_id')->unsigned()->index();
            $table->integer('tour_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_map_zumhi_caches');
    }
}
