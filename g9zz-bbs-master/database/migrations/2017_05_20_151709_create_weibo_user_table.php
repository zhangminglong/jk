<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeiboUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weibo_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('weibo_id')->default(0)->index()->comment('微博ID');
            $table->integer('weibo_idstr')->default(0)->comment('');
            $table->string('screen_name')->nullable()->comment('微博昵称');
            $table->string('name')->nullable()->index()->comment('微博昵称');
            $table->string('email')->nullable()->index()->comment('邮箱');
            $table->string('province')->nullable()->comment('省份');
            $table->string('city')->nullable()->comment('城市');
            $table->string('location')->nullable()->comment('现居住地');
            $table->string('description')->nullable()->comment('个人描述');
            $table->string('url')->nullable()->comment('url');
            $table->string('profile_image_url')->nullable()->comment('头像');
            $table->string('profile_url')->nullable()->comment('个人微博地址');
            $table->string('domain')->nullable()->comment('个人微博域名');
            $table->string('weihao')->nullable()->comment('个人爱好');
            $table->string('gender')->nullable()->comment('性别');
            $table->integer('followers_count')->nullable()->comment('粉丝');
            $table->integer('friends_count')->nullable()->comment('关注');
            $table->integer('pagefriends_count')->nullable()->comment('朋友页数');
            $table->integer('statuses_count')->nullable()->comment('微博数');
            $table->integer('favourites_count')->nullable()->comment('收藏数');
            $table->string('weibo_created_at')->nullable()->comment('加入微博时间');
            $table->string('avatar_large')->nullable()->comment('大头像');
            $table->string('avatar')->nullable()->comment('头像');
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
        Schema::dropIfExists('weibo_user');
    }
}
