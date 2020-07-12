<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZumhicachelogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zumhicachelogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('referenceCode')->comment('uniquely identifies the zumhicache user');
            $table->uuid('ownerCode')->nullable()->comment('relation to zumhicache user table');
            $table->uuid('zumhicacheCode')->nullable()->comment('relation to zumhicache table');
            $table->dateTimeTz('loggedDate', 0)->nullable()->comment('date and time of when user logged the zumhicache in the timezone of the zumhicache');
            $table->string('text', 191)->nullable()->comment('display text of the zumhicache log');
            $table->integer('logtype_id')->nullable()->comment('relation to zumhicache log types table');
            $table->integer('coordinates_id')->nullable()->comment('latitude and longitude of the zumhicache (only used with log type - Updated Coordinates)');
            $table->boolean('usedFavoritePoint')->nullable()->comment('if a favorite point was awarded from this log');
            $table->boolean('isEncoded')->nullable()->comment('if log was encrypted using ROT13. This field is grandfathered to logs already set to true. New logs cannot be encoded.');
            $table->boolean('isArchived')->nullable()->comment('if the log has been deleted');
            $table->text('url')->nullable()->comment('zumhicache.com web page associated with zumhicache log');
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
        Schema::dropIfExists('zumhicachelogs');
    }
}
