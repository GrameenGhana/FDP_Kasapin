<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkiplogicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skip_logic_c', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id');
            $table->integer('user_id');
            $table->string('formula_c')->nullable();
            $table->integer('hide_c');
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
        Schema::dropIfExists('skip_logic_c');
    }
}
