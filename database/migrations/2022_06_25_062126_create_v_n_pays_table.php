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
        Schema::create('v_n_pays', function (Blueprint $table) {
            $table->id();
            $table->string('Amount',50);
            $table->string('BankCode',50);
            $table->string('BankTranNo',50);
            $table->string('CardType',50);
            $table->string('OrderInfo',50);
            $table->string('PayDate',50);
            $table->string('TmnCode',50);
            $table->string('TransactionNo',50);
            $table->integer('user_id');
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
        Schema::dropIfExists('v_n_pays');
    }
};
