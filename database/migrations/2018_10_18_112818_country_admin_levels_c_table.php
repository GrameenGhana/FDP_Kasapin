<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CountryAdminLevelsCTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('country_admin_level_c', function (Blueprint $table) {

               $table->increments('id');
               $table->string('name');
               $table->string('type');
               $table->integer('country_id')->unsigned();
               $table->foreign('country_id')->references('id')->on('country_c');
               $table->integer('parent_id');
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
        Schema::dropIfExists('country_admin_level_c');

    }
}
