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
            $table->string('ma');
            $table->string('name',300);
            $table->string('slug',300);
            $table->unsignedBigInteger('price')->default(0)->nullable();
            $table->unsignedBigInteger('quantity')->default(0)->nullable();
            $table->unsignedBigInteger('user_id')->default(1);
            $table->string('thumb',300)->default('no-images.jpg')->nullable();
            $table->text('image')->default('no-images.jpg')->nullable();
            $table->longText('content')->nullable();
            $table->longText('short_content')->nullable();
            $table->integer('status')->default(1);
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
            $table->longtext('property')->nullable();
            $table->longtext('property_short')->nullable();
            $table->text('attr')->nullable();
            $table->string('still_stock')->nullable();
            $table->string('youtube')->nullable();
            $table->string('detailproperty')->nullable();
            $table->integer('tax')->nullable();
            $table->string('warranty')->nullable();
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
