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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->text('order_note')->nullable();
            $table->string('invoice_id');
            $table->float('grand_total');
            $table->tinyInteger('order_status')->default(1)->comment('1=pending,2=confirm,3=delivered,4=cancel');
            $table->tinyInteger('payment_status')->default(1)->comment('1=unpaid,2=paid,3=refund');
            $table->tinyInteger('payment_method')->comment('1=cod, 2=bkash, 3=paypal, 4=stripe');
            $table->string('coupon_name')->nullable();
            $table->string('coupon_code')->nullable();
            $table->float('coupon_amount')->nullable();
            $table->float('extra_amount')->default(0);
            $table->text('extra_amount_note')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
