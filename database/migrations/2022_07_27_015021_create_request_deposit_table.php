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
        Schema::create('request_deposit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('money');
            $table->string('phone');
            $table->string('number');
            $table->string('name');
            $table->foreignId('payment_id');
            $table->foreignId('user_id');
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_deposit');
    }
};
