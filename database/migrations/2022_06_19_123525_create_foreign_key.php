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
        Schema::table('catogories', function (Blueprint $table) {
            //
        });
        Schema::table('episodes', function (Blueprint $table) {
            $table->foreign('movie_id')->references('id')->on('movies');
        });
        Schema::table('movies', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
        Schema::table('movie_genres', function (Blueprint $table) {
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
        });
        Schema::table('movie_categories', function (Blueprint $table) {
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
        Schema::table('ratings', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('episode_id')->references('id')->on('episodes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catogories', function (Blueprint $table) {
            //
        });
    }
};
