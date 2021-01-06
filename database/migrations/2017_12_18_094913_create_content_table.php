<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
    private $_table = 'co_content';
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
            $table->unsignedInteger('category_id')->default(0);
            $table->string('image', 255)->default('');
            $table->string('image_alt', 255)->default('');
            $table->unsignedTinyInteger('layout_type')->default(1);
            $table->string('layout', 1000)->default('');
            $table->text('introtext');
            $table->mediumText('fulltext');
            $table->unsignedInteger('created_by')->default(0);
            $table->unsignedInteger('modified_by')->default(0);
            $table->string('author', 255)->default('');
            $table->text('meta');
            $table->dateTime('publish_up')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('publish_down')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedInteger('rating_sum')->default(0);
            $table->unsignedInteger('rating_count')->default(0);
            $table->text('params');
            $table->unsignedInteger('hits')->default(0);
            $table->string('source', 255)->default('');
            $table->unsignedInteger('ordering')->default(0);
            $table->string('language', 5)->default('*');
            $table->string('attribs', 255)->default('');
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
