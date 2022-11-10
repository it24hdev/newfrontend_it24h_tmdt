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
        Schema::create('recentactivities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('activities')->nullable();
            $table->string('attr')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('recentactivities');
    }
};
