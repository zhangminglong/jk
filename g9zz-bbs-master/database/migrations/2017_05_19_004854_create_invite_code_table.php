<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInviteCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invite_code', function (Blueprint $table) {
            $table->increments('id');
            $table->string('inviter_hid')->default('')->comment('邀请者HID');
            $table->string('invitee_hid')->default('')->nullable()->comment('被邀请者HID');
            $table->string('status')->default('created')->comment('状态 created创建,used已使用,obsolete过时了');
            $table->string('code')->comment('邀请码');
            $table->dateTime('obsoleted_at')->nullable()->default(null)->comment('过时时间');
            $table->timestamps();
            $table->index('inviter_hid');
            $table->index('invitee_hid');
            $table->index('status');
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invite_code');
    }
}
