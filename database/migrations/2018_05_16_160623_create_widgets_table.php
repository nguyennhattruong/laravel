<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration
{
    private $_table = 'co_widgets';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 255);
            $table->text('content');
            $table->string('link', 255);
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedTinyInteger('show_title')->default(1);
            $table->string('layout', 45);
            $table->string('position', 255);
            $table->unsignedInteger('ordering')->default(0);
            $table->string('widget', 255);
            $table->text('access');
            $table->text('params');
            $table->text('options');
            $table->string('language', 5)->default('*');
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
        Schema::dropIfExists($this->_table);
    }
}
