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
            $table->string('ma');
            $table->string('name')->nullable();
            $table->string('name2')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('taxonomy');
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->unsignedBigInteger('user_id')->default(1);
            $table->string('thumb')->default('no-images.jpg')->nullable();
            $table->string('banner')->default('no-images.jpg')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('show_push_product')->default(1);
            $table->longText('content')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
