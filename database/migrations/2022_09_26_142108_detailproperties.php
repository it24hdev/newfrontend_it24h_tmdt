<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('detailproperties', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('stt')->nullable();
            $table->integer('categoryproperties_id')->nullable();
            $table->string('explain')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detailproperties');
    }
};
