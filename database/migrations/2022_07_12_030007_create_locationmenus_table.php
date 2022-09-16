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
        Schema::create('locationmenus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name2');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->integer('sidebar_location')->nullable();
            $table->integer('footer_location')->nullable();
            $table->integer('menu_location')->nullable();
            $table->integer('rightmenu_location')->nullable();
            $table->integer('position')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
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
        Schema::dropIfExists('locationmenus');
    }
};
