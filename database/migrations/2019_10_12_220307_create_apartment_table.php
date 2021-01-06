<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentTable extends Migration
{
    private $_table = 'co_apartment';

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
            $table->string('name', 255)->default('');
            $table->string('alias', 400)->default('');
            $table->text('content');
            $table->string('description', 1000)->default('');
            $table->unsignedInteger('feature_id')->default(1);
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedTinyInteger('state')->default(0);
            $table->unsignedInteger('label_id')->default(0);
            $table->unsignedInteger('type_id')->default(0);
            $table->unsignedInteger('location_id')->default(0);
            $table->string('images', 1000)->default('');
            $table->unsignedBigInteger('price')->default(0);
            $table->string('code', 100)->default('');
            $table->unsignedInteger('bedroom')->default(0);
            $table->unsignedInteger('bathroom')->default(0);
            $table->unsignedInteger('land_size')->default(0);
            $table->unsignedInteger('year_built')->default(0);
            $table->string('meta_title', 100)->default('');
            $table->string('meta_keywords', 100)->default('');
            $table->string('meta_description', 255)->default('');
            $table->dateTime('publish_up', 10)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('language', 5)->default('*');
            $table->unsignedInteger('hits')->default(0);

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
