<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('sku')->unique();
            $table->string('name');
            $table->decimal('price_profit')->default(0);
            $table->double('price_purchase', 19, 2)->default(0);
            $table->double('price_sale', 19, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->date('date_expired')->nullable();
            $table->text('notes')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index("category_id");
            $table->index("group_id");
            $table->index("brand_id");
            $table->engine = 'InnoDB';
        });

        Schema::create('products_images', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->unsignedBigInteger('product_id');
             $table->text('path')->nullable();
             $table->boolean('is_primary')->default(0);
             $table->timestamps();
             $table->index("product_id");
             $table->engine = 'InnoDB';
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
        Schema::dropIfExists('products_images');
    }
}
