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
        Schema::create('userlog_activities', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->nullable();
            $table->string('modify_user',100);
            $table->string('email',150)->nullable();
            $table->string('address',250)->nullable();
            $table->string('date_time',250);
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
        Schema::dropIfExists('userlog__activities');
    }
};
