<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenu extends Migration
{
    private $_table = 'co_menu';

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
            $table->string('description', 1000);
            $table->unsignedInteger('menutype_id')->default(0);
            $table->unsignedTinyInteger('onsite')->default(1);
            $table->integer('parent_id')->nullable()->index();
            $table->integer('lft')->nullable()->index();
            $table->integer('rgt')->nullable()->index();
            $table->integer('depth')->nullable();
            $table->string('icon', 255)->default('');
            $table->string('link', 255)->default('');
            $table->string('target', 255)->default('');
            $table->unsignedTinyInteger('home')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
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
