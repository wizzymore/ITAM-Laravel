<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false)->unique();

            $table->timestamps();
        });
        Schema::create('product_makers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false)->unique();

            $table->timestamps();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('model');
            $table->foreignId('product_type_id')->constrained();
            $table->foreignId('product_maker_id')->constrained();

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
        Schema::dropIfExists('product_types');
        Schema::dropIfExists('product_makers');
        Schema::dropIfExists('products');
    }
}
