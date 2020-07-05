<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZumhiCachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zumhi_caches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('referenceCode')->comment('uniquely identifies the zumhicache');
            $table->string('name', 191)->nullable()->comment('name of the zumhicache');
            $table->decimal('difficulty', 2, 1)->nullable()->comment('difficulty rating of the zumhicache between 1.0 and 5.0');
            $table->decimal('terrain', 2, 1)->nullable()->comment('	terrain rating of the zumhicache between 1.0 and 5.0');
            $table->dateTimeTz('placedDate', 0)->nullable()->comment('date when the cache was placed (if an event, this is the date of the event) in the timezone of the zumhicache');
            $table->dateTimeTz('publishedDate', 0)->nullable()->comment('date when the cache was published in the timezone of the zumhicache');
            $table->dateTimeTz('eventEndDate', 0)->nullable()->comment('date and time of when an event will end (in the timezone of the zumhicache). null if an end date doesn\'t exist or if zumhicache is not event type.');
            $table->integer('type_id')->nullable()->comment('type of the zumhicache type');
            $table->integer('size_id')->nullable()->comment('size of the zumhicache type');
            $table->integer('user_id')->nullable()->comment('user specific information about the zumhicache');
            $table->integer('status_id')->nullable()->comment('current status of the zumhicache');
            $table->integer('country_id')->nullable()->comment('country information about the zumhicache');
            $table->integer('state_id')->nullable()->comment('state information about the zumhicache');
            $table->integer('coordinates_id')->nullable()->comment('Coordinates information about the zumhicache');
            $table->dateTimeTz('lastVisitedDate', 0)->nullable()->comment('datetime of last logged visit to zumhicache in the timezone of the zumhicache');
            $table->longText('shortDescription')->nullable()->comment('summary about the zumhicache');
            $table->longText('longDescription')->nullable()->comment('details about the zumhicache');
            $table->text('hints')->nullable()->comment('hints/spoilers to help to find the zumhicache');
            $table->string('ianaTimezoneId', 191)->nullable()->comment('timezone of the zumhicache');
            $table->text('relatedWebPage')->nullable()->comment('external web page associated with zumhicache');
            $table->text('url')->nullable()->comment('zumhicache.com web page associated with zumhicache');
            $table->boolean('isPremiumOnly')->nullable()->comment('whether the zumhicache can only be viewed by premium members');
            $table->boolean('containsHtml')->nullable()->comment('flag for if the short or long description contains html');
            $table->boolean('hasSolutionChecker')->nullable()->comment('flag for if the short or long description contains htmlflag for if the native solution checker is used on the website');
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
        Schema::dropIfExists('zumhi_caches');
    }
}
