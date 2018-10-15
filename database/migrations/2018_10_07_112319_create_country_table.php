<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        Schema::create('country_c', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('avg_gate_price',16,2);
            $table->string('currency');
            $table->string('iso_code');
            $table->integer('admin_level');
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
        $tableNames = config('permission.table_names');
        Schema::dropIfExists('country_c');
    }
}
