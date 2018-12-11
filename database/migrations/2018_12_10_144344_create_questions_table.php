<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_c', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('form_translation_id');
            $table->string('caption_c');
            $table->string('type_c');
            $table->integer('required_c');
            $table->string('formula_c');
            $table->string('label_c');
            $table->string('default_value_c');
            $table->integer('display_order_c');
            $table->string('help_text_c');
            $table->integer('hide_c');
            $table->text('options_c');
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
        Schema::dropIfExists('questions_c');
    }
}
