<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaisyosyaListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taisyosya_lists', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('i_question_id');
            $table->integer('i_taisyosha_id');
            $table->string('c_taisyosha_name_sei');
            $table->string('c_taisyosha_name_mei');
            $table->string('e_mail');
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
        Schema::dropIfExists('taisyosya_lists');
    }
}
