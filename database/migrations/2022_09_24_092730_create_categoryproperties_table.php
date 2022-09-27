<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('categoryproperties', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('ma')->nullable();
            $table->integer('stt')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('explain')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categoryproperties');
    }
};
