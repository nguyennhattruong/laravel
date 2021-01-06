<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    private $_table = 'co_pages';

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
            $table->string('title', 255)->default('');
            $table->string('alias', 400)->default('');
            $table->string('layout', 1000)->default('');
            $table->text('description');
            $table->mediumText('content');
            $table->unsignedTinyInteger('status')->default(1);
            $table->string('attribs', 255)->default('');
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
