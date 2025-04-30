<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration
{

    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->boolean('like')->default(0);
            $table->boolean('bookmark')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('property_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('boxes');
    }
};
