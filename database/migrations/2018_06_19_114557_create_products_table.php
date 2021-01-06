<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    private $_table = 'co_products';

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
            $table->text('content');
            $table->string('description', 1000)->default('');
            $table->unsignedInteger('price')->default(0);
            $table->unsignedTinyInteger('price_contact')->default(0);
            $table->unsignedInteger('price_compare')->default(0);
            $table->unsignedTinyInteger('vat')->default(0);
            $table->string('sku', 100)->default('');
            $table->string('barcode', 100)->default('');
            $table->unsignedTinyInteger('inventory')->default(0);
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedTinyInteger('inventory_policy')->default(0);
            $table->string('meta_title', 100)->default('');
            $table->string('meta_keywords', 100)->default('');
            $table->string('meta_description', 255)->default('');
            $table->string('images', 1000)->default('');
            $table->unsignedTinyInteger('status')->default(1);
            $table->dateTime('publish_up', 10)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedInteger('category_id')->default(0);
            $table->unsignedInteger('vendor_id')->default(0);
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
