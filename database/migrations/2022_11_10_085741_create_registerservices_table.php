<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('registerservices', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('request')->nullable();
            $table->string('respond')->nullable();
            $table->text('images')->default('no-images.jpg');
            $table->longText('describe')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('registerservices');
    }
};
