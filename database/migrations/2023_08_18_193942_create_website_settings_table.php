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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_name')->nullable();
            $table->string('website_email')->nullable();
            $table->string('website_phone')->nullable();
            $table->string('website_address')->nullable();
            $table->text('website_contact_us')->nullable();
            $table->text('website_about_us')->nullable();
            $table->string('happy_customer_background_image')->nullable();
            $table->string('website_working_hours')->nullable();
            $table->string('website_logo')->nullable();
            $table->string('website_favicon')->nullable();
            $table->string('fb')->nullable();
            $table->string('tw')->nullable();
            $table->string('ins')->nullable();
            $table->string('gp')->nullable();
            $table->string('yt')->nullable();

            $table->string('section_1_title')->nullable();
            $table->string('section_1_sort_title')->nullable();
            $table->string('section_1_icon')->nullable();

            $table->string('section_2_title')->nullable();
            $table->string('section_2_sort_title')->nullable();
            $table->string('section_2_icon')->nullable();

            $table->string('section_3_title')->nullable();
            $table->string('section_3_sort_title')->nullable();
            $table->string('section_3_icon')->nullable();
            $table->text('invoice_aditional')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_settings');
    }
};
