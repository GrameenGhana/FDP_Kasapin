<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_c', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('form_name_c');
            $table->integer('display_order_c');
            $table->string('type_c');
            $table->string('display_type_c');
            $table->string('custom_c')->nullable();
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
        Schema::dropIfExists('form_c');
    }
}
