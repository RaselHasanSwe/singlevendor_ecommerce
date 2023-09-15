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
        Schema::create('ordered_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->string('prduct_name');
            $table->float('qty');
            $table->string('color_name')->nullable();
            $table->string('size_name')->nullable();
            $table->string('main_image');
            $table->string('color_image')->nullable();
            $table->float('discount');
            $table->tinyInteger('discount_type')->nullable()->comment('1=percent, 2=flat price');
            $table->unsignedBigInteger('shipping_id');
            $table->float('shipping_original_price')->default(0);
            $table->tinyInteger('shipping_apply')->comment('1=per qty, 2=all qty');
            $table->string('is_free')->default(0)->comment('1=free, 0=not free');
            $table->float('product_original_price');
            $table->float('discounted_price');
            $table->float('total_shipping_price');
            $table->float('grand_total');
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('shipping_id')->references('id')->on('shippings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordered_products');
    }
};
