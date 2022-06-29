<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('serial', false, true)->nullable(false)->unique();
            $table->foreignId('product_id')->constrained();
            $table->integer('asset_type_id')->nullable(false);
            $table->string('service_tag')->nullable()->unique();
            $table->string('aviz')->nullable();

            $table->date('primire')->nullable(false);
            $table->date('invoice')->nullable(false);
            $table->enum('status', ['active', 'in-service', 'inactive']);
            $table->timestamps();
        });
        Schema::create('asset_types', function (Blueprint $table) {
            $table->id();

            $table->string('label')->nullable(false)->unique();

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
        Schema::dropIfExists('assets');
        Schema::dropIfExists('asset_types');
    }
}
