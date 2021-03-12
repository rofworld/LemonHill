<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_artists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artist_id');
            $table->foreign('artist_id')->references('id')->on('artist_infos');
            $table->string('artist_name');
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
        Schema::dropIfExists('event_artists');
    }
}
