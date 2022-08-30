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
            $table->boolean('sidebar')->default(1);
            $table->boolean('footer')->default(1);
            $table->boolean('menu')->default(1);
            $table->boolean('rightmenu')->default(1);
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
