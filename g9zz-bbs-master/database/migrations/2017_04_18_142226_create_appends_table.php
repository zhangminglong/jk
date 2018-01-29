<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appends', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hid')->default('')->comment('加密ID');
            $table->text('content')->comment('帖子附言内容');
            $table->text('content_original')->nullable()->comment('附言原文');
            $table->string('topic_hid')->default('')->index()->comment('帖子HID');
            $table->timestamps();
            $table->softDeletes();
            $table->index('hid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appends');
    }
}
