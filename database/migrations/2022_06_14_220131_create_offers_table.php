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
        Schema::create('offers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('brand_id');
            $table->uuid('category_id');
            $table->uuid('vehicle_id');      
            $table->uuid('user_id'); 
            $table->string('title', 50);
            $table->string('description', 150);
            $table->string('picture')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('contact', 11);
            $table->string('zip_code', 8);
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
        Schema::dropIfExists('offers');
    }
};
