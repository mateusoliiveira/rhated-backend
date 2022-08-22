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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('brand_id');
            $table->uuid('category_id');
            $table->boolean('is_electric')->default(false);
            $table->boolean('is_automatic')->default(false);
            $table->string('name', 50);
            $table->integer('year');
            $table->integer('doors')->default(0);
            $table->decimal('liters', 8, 2)->default(0);
            $table->integer('cylinders')->default(0);
            $table->integer('horsepower')->default(0);
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
        Schema::dropIfExists('vehicles');
    }
};
