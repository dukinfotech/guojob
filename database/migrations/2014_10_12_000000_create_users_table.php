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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('balance')->default(0);
            $table->string('role')->default('user');
            $table->string('cskh_url')->default('');
            $table->string('username')->unique();
            $table->string('phone')->unique();
            $table->string('level')->default('v1');
            $table->unsignedBigInteger('commission')->default(0);
            $table->integer('active')->default(1);
            $table->string('password');
            $table->string('passcode');
            $table->string('invite_code')->unique();
            $table->timestamps();
            $table->foreignId('parent_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
