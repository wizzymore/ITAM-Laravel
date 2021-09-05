<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('last_name')->nullable(false);
            $table->string('first_name')->nullable();
            $table->unique(['first_name', 'last_name']);

            $table->string('email')->unique()->nullable(false);

            $table->boolean('is_manager')->default(false);
            $table->foreignId('manager_id')->nullable()->references('id')->on('employees');

            $table->timestamps();
        });

        if (Schema::hasTable('assets')) {
            Schema::table('assets', function (Blueprint $table) {
                $table->foreignId('employee_id')->nullable()->after('aviz')->constrained()->nullOnDelete()->cascadeOnUpdate();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
        Schema::dropColumns('assets', 'employee_id');
    }
}
