<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title',150);
            $table->longtext('description');
            $table->integer('status');
            $table->string('slug',255);
            $table->string('image',255);
            $table->integer('film_hot');
            $table->string('name_eng',250);
            $table->integer('resolution');
            $table->integer('subtitle');
            $table->string('date_created',50)->nullable();
            $table->string('update_day',50)->nullable();
            $table->string('year', 25);
            $table->integer('topview')->nullable();
            $table->string('movie_duration',100)->nullable();
            $table->text('tags',100)->nullable();
            $table->string('session',50)->nullable()->default('0');
            $table->string('trailer',110)->nullable();
            $table->integer('episode_film')->nullable();
            $table->integer('belonging_movie');
            $table->string('director',255)->nullable();
            $table->string('actor',255)->nullable();
            $table->integer('film_vip')->default(1);
            $table->foreignId('category_id');
            $table->foreignId('genre_id');
            $table->foreignId('country_id');
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
        Schema::dropIfExists('movies');
    }
};
