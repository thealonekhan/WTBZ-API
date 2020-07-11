<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZumhicacheattributetypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zumhicacheattributetypes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('attribute_id')->comment('Attributes with relation');
            $table->string('name', 191)->nullable();
            $table->boolean('hasYesOption')->nullable();
            $table->boolean('hasNoOption')->nullable();
            $table->text('yesIconUrl')->nullable();
            $table->text('noIconUrl')->nullable();
            $table->text('notChosenIconUrl')->nullable();
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
        Schema::dropIfExists('zumhicacheattributetypes');
    }
}
