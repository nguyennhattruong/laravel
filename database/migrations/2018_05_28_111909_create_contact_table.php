<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration
{
    private $_table = 'co_contact';

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
            $table->string('content', 400)->default('');
            $table->string('fullname', 255)->default('');
            $table->string('email', 100)->default('');
            $table->string('mobile', 100)->default('');
            $table->string('phone', 100)->default('');
            $table->string('address', 100)->default('');
            $table->string('ip', 100)->default('');
            $table->dateTime('send_time');
            $table->unsignedTinyInteger('type')->default(1);
            $table->unsignedTinyInteger('read')->default(1);
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
