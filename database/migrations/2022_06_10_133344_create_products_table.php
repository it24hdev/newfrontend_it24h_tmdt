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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',300)->unique();
            $table->string('slug',300)->unique();
            $table->unsignedBigInteger('price')->nullable();
            $table->unsignedBigInteger('quantity')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('thumb',300)->default('no-image.jpg')->nullable();
            $table->text('image')->default('no-image.jpg')->nullable();
            $table->longText('content')->nullable();
            $table->longText('short_content')->nullable();
            $table->integer('status')->default(0);
            $table->string('cat_id')->nullable();
            $table->unsignedBigInteger('brand')->nullable();
            $table->string('unit',32)->nullable();
            $table->integer('onsale')->default(0)->nullable();
            $table->bigInteger('price_onsale')->default(0)->nullable();
            $table->integer('new')->default(0)->nullable();
            $table->integer('hot_sale')->default(0)->nullable();
            $table->timestamp('time_deal')->nullable();
            $table->text('specifications')->nullable();
            $table->string('event')->nullable();
            $table->string('installment')->nullable();
            $table->string('year')->nullable();
            $table->longText('gift')->nullable();
            $table->integer('sold')->nullable();
            $table->string('property')->nullable();
            $table->text('attr')->nullable();
            $table->string('still_stock')->nullable();
            $table->string('youtube')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
