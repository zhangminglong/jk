<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXcxUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xcx_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('open_id')->unique()->index()->comment('openID');
            $table->string('nick_name')->nullable()->default('')->comment('昵称');
            $table->string('language')->nullable()->default('')->comment('城市');
            $table->string('province')->nullable()->default('')->comment('省份');
            $table->string('country')->nullable()->default('')->comment('国家');
            $table->string('city')->nullable()->default('')->comment('城市');
            $table->string('avatar_url')->nullable()->default('')->comment('头像');
            $table->integer('gender')->nullable()->default(1)->comment('性别 1 男,0 女');
            $table->string('status')->default('created')->index()->comment('状态');
//            $table->timestamp('last_reply_actived_at')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable()->comment('');
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
        Schema::dropIfExists('xcx_user');
    }
}
