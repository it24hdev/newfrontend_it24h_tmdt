<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('categoryproperties_manages', function (Blueprint $table) {
            $table->id();
            $table->string('ma')->nullable();
            $table->string('name')->nullable();
            $table->integer('stt')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('categoryproperties_id')->nullable();
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
        Schema::dropIfExists('categoryproperties_manages');
    }
};
