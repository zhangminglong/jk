<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hid')->default('')->comment('加密ID');
            $table->string('name')->nullable()->default('')->comment('用户名');
            $table->string('email')->nullable()->default('');
            $table->string('mobile', 11)->default('')->comment('手机号');
            $table->string('password')->nullable()->default('');
            $table->string('avatar')->nullable();
            $table->string('status')->default('activited')->nullable();
            $table->integer('github_id')->default(0);
            $table->integer('wechat_id')->default(0);
            $table->integer('weibo_id')->default(0);
            $table->integer('qq_id')->default(0);
            $table->integer('google_id')->default(0);
            $table->integer('douban_id')->default(0);
            $table->integer('xcx_id')->default(0);
            $table->integer('topic_count')->default(0)->index();
            $table->integer('reply_count')->default(0)->index();
            $table->integer('follower_count')->default(0)->index();
            $table->string('verified')->default('false')->index();
            $table->enum('email_notify_enabled', ['yes',  'no'])->default('yes')->index();
            $table->string('register_source')->nullable()->index();
            $table->timestamp('last_activated_at')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
            $table->index('hid');
            $table->index('name');
            $table->index('email');
            $table->index('status');
            $table->index('github_id');
            $table->index('wechat_id');
            $table->index('weibo_id');
            $table->index('qq_id');
            $table->index('google_id');
            $table->index('douban_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
