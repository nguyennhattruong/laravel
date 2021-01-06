<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('co_config', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedTinyInteger('off')->default(0);
            $table->text('off_message')->nullable();
            $table->string('site_name', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords', 255)->nullable();
            $table->string('meta_robots', 255)->nullable();
            $table->text('meta_extension', 255)->nullable();
            $table->string('mail_from', 255)->nullable();
            $table->string('from_name', 255)->nullable();
            $table->string('reply_to_email', 255)->nullable();
            $table->string('reply_to_name', 255)->nullable();
            $table->string('mailer', 255)->nullable();
            $table->string('smtp_host', 255)->nullable();
            $table->unsignedSmallInteger('smtp_port')->nullable();
            $table->string('smtp_secure', 255)->nullable();
            $table->unsignedTinyInteger('smtp_auth')->nullable();
            $table->string('smtp_user', 255)->nullable();
            $table->string('smtp_pass', 255)->nullable();
            $table->text('header_script')->nullable();
            $table->text('header_css')->nullable();
            $table->text('header_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('co_config');
    }
}
