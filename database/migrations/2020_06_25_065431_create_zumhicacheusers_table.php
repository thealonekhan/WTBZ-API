<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZumhicacheusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zumhicacheusers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('referenceCode')->comment('uniquely identifies the zumhicache user');
            $table->integer('user_id')->nullable()->comment('relation to main user table');
            $table->integer('membership_id')->nullable()->comment('type of the membership');
            $table->dateTimeTz('joinedDateUtc', 0)->nullable()->comment('datetime indicating when the user account was created.');
            $table->longText('avatarUrl')->nullable()->comment('link to image of the user\'s profile avatar');
            $table->longText('bannerUrl')->nullable()->comment('link to image of the user\'s banner image');
            $table->text('url')->nullable()->comment('zumhicache.com web page associated with user profile');
            $table->text('profileText')->nullable()->comment('text from Profile Information section on user profile page');
            $table->integer('coordinates_id')->nullable()->comment('latitude and longitude of the user\'s home location');
            $table->boolean('isFriend')->nullable()->comment('if the user is a friend of the calling user');
            $table->boolean('optedInFriendSharing')->nullable()->comment('if the user has opted to to share zumhicaching activity with friends');
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
        Schema::dropIfExists('zumhicacheusers');
    }
}
