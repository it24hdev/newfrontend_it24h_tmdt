<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('propertyproducts', function (Blueprint $table) {
            $table->id();
            $table->string('ma')->nullable();
            $table->string('name')->nullable();
            $table->integer('products_id')->nullable();
            $table->integer('detailproperties_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('propertyproducts');
    }
};
