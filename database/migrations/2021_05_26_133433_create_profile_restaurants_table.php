<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->string('categorie')->nullable();
            $table->string('reseausocial')->nullable();
            $table->string('photo')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedInteger('user_id')->index(); //definir la cle etrangere
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
        Schema::dropIfExists('profile_restaurants');
    }
}
