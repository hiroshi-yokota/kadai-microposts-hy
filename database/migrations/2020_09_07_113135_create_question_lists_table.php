<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('i_question_id');
            $table->integer('i_quest_no');
            $table->string('c_quest_type');
            $table->string('c_quest_title');
            $table->string('c_quest_label1');
            $table->string('c_quest_value1');
            $table->string('c_quest_label2');
            $table->string('c_quest_value2');
            $table->string('c_quest_label3');
            $table->string('c_quest_value3');
            $table->string('c_quest_label4');
            $table->string('c_quest_value4');
            $table->string('c_quest_label5');
            $table->string('c_quest_value5');
            $table->string('c_quest_label6');
            $table->string('c_quest_value6');
            $table->string('c_quest_label7');
            $table->string('c_quest_value7');
            $table->string('c_quest_label8');
            $table->string('c_quest_value8');
            $table->string('c_quest_label9');
            $table->string('c_quest_value9');
            $table->string('c_quest_label10');
            $table->string('c_quest_value10');
            $table->string('c_quest_label11');
            $table->string('c_quest_value11');
            $table->string('c_quest_label12');
            $table->string('c_quest_value12');
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
        Schema::dropIfExists('question_lists');
    }
}
