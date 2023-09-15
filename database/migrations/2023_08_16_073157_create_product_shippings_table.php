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
        Schema::create('product_shippings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipping_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('price')->nullable();
            $table->integer('shipping_apply')->nullable()->comment('1=per qty, 2=all qty');
            $table->tinyInteger('is_free')->default(0)->comment('1=free shipping, 0=not free');
            $table->timestamps();
            $table->foreign('shipping_id')->references('id')->on('shippings');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_shippings');
    }
};
