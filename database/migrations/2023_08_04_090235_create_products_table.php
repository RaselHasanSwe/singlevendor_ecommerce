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
            $table->string('name');
            $table->string('slug');
            $table->string('sku');
            $table->float('stock');
            $table->float('price');
            $table->float('discount')->nullable();
            $table->tinyInteger('discount_type')->nullable()->comment('1=Percentence, 2=Flat price');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->unsignedBigInteger('inner_category_id')->nullable();
            $table->text('sort_description')->nullable();
            $table->string('thumbnail');
            $table->text('full_description')->nullable();
            $table->text('full_specfications')->nullable();
            $table->tinyInteger('status')->default(0)->comment('1=Active; 0=Inactive');
            $table->tinyInteger('hot')->default(0);
            $table->tinyInteger('recomend')->default(0);
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
            $table->foreign('inner_category_id')->references('id')->on('inner_categories');
            $table->foreign('brand_id')->references('id')->on('brands');
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
