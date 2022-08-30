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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('name2');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('taxonomy');
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('user_id');
            $table->string('thumb')->nullable();
            $table->string('banner')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('status');
            $table->boolean('show_push_product');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
