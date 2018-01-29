<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Route::group(['prefix' => 'test'],function() {
    Route::get('/', 'TestController@index')->name('test.index');
});

Route::group(['middleware' => ['g9zz','permission']],function(){
    Route::group(['prefix' => 'user','middleware' => 'idDecode'],function(){
        Route::get('/','Console\UserController@index')->name('console.user.index');
        Route::get('/{hid}','Console\UserController@show')->name('console.user.show');
        Route::post('/{userId}/role/{roleId}','Console\UserController@attachRole')->name('console.user.attach.role');

        Route::get('/{userId}/post','Console\UserController@getPostByUser')->name('console.all.post.by.user');
        Route::get('/{userId}/reply','Console\UserController@getReplyByUser')->name('console.all.reply.by.user');


    });

    Route::group(['prefix' => 'notify'],function() {
        //获取所有通知
        Route::get('/','Console\NotifyController@getNotify')->name('console.user.get.notify');
        Route::get('/unreadNum','Console\NotifyController@getUnreadNotifyNum')->name('console.user.notify.unread.num');
//        Route::get('/notify/unread','Console\NotifyController@getUnReadNotify')->name('console.user.get.unread.notify');
//        Route::get('/notify/read','Console\NotifyController@getHadReadNotify')->name('console.user.get.had.read.notify');
        //标记某个通知已读
        Route::post('/set/{notifyId}/read','Console\NotifyController@setNotifyRead')->name('console.user.set.notify.read');
        //标记所有通知已读
        Route::post('/set/allRead','Console\NotifyController@setAllNotifyRead')->name('console.user.set.all.notify.read');
    });


    Route::group(['prefix' => 'post'],function() {
        Route::get('/','Console\PostController@index')->name('console.post.index');
        Route::post('/','Console\PostController@store')->name('console.post.store');
        Route::get('/{hid}','Console\PostController@show')->name('console.post.show');
        Route::put('/{hid}','Console\PostController@update')->name('console.post.put');
        Route::delete('/{hid}','Console\PostController@destroy')->name('console.post.destroy');

        Route::get('/{postHid}/reply','Console\PostController@getReply')->name('console.post.get.reply');
    });

    Route::group(['prefix' => 'node'],function() {
        Route::get('/','Console\NodeController@index')->name('console.node.index');
        Route::post('/','Console\NodeController@store')->name('console.node.store');
        Route::get('/{hid}','Console\NodeController@show')->name('console.node.show');
        Route::put('/{hid}','Console\NodeController@update')->name('console.node.put');
        Route::delete('/{hid}','Console\NodeController@destroy')->name('console.node.destroy');

        //节点下所有帖子
        Route::get('/{hid}/post','Console\NodeController@getPostByNode')->name('console.get.post.by.node');
    });

    Route::group(['prefix' => 'tag'],function() {
        Route::get('/','Console\TagController@index')->name('console.tag.index');
        Route::post('/','Console\TagController@store')->name('console.tag.store');
        Route::get('/{hid}','Console\TagController@show')->name('console.tag.show');
        Route::put('/{hid}','Console\TagController@update')->name('console.tag.put');
        Route::delete('/{hid}','Console\TagController@destroy')->name('console.tag.destroy');
    });

    Route::group(['prefix' => 'reply'],function() {
        Route::get('/','Index\ReplyController@index')->name('console.reply.index');
        Route::post('/','Index\ReplyController@store')->name('console.reply.store');
        Route::get('/{hid}','Index\ReplyController@show')->name('console.reply.show');
        Route::put('/{hid}','Index\ReplyController@update')->name('console.reply.put');
        Route::delete('/{hid}','Index\ReplyController@destroy')->name('console.reply.destroy');
    });

    Route::group(['prefix' => 'append'],function() {
        Route::get('/','Index\AppendController@index')->name('console.append.index');
        Route::post('/','Index\AppendController@store')->name('console.append.store');
        Route::get('/{hid}','Index\AppendController@show')->name('console.append.show');
//    Route::put('/{id}','Index\AppendController@update')->name('console.append.put');
//    Route::delete('/{id}','Index\AppendController@destroy')->name('console.append.destroy');
    });

    Route::group(['prefix' => 'permission'],function() {
        Route::get('/','Console\PermissionController@index')->name('console.permission.index');
        Route::post('/','Console\PermissionController@store')->name('console.permission.store');
        Route::get('/{id}','Console\PermissionController@show')->name('console.permission.show');
        Route::put('/{id}','Console\PermissionController@update')->name('console.permission.put');
        Route::delete('/{id}','Console\PermissionController@destroy')->name('console.permission.destroy');
    });

    Route::group(['prefix' => 'role'],function() {
        Route::get('/','Console\RoleController@index')->name('console.role.index');
        Route::post('/','Console\RoleController@store')->name('console.role.store');
        Route::get('/{id}','Console\RoleController@show')->name('console.role.show');
        Route::put('/{id}','Console\RoleController@update')->name('console.role.put');
        Route::delete('/{id}','Console\RoleController@destroy')->name('console.role.destroy');

        Route::post('/{roleId}/permission','Console\RoleController@attachPermission')->name('console.role.attach.permission');

    });

    Route::group(['prefix' => 'code'],function() {
        Route::get('/','Console\InviteCodeController@index')->name('console.code.store');
        Route::get('/ownCode','Console\InviteCodeController@getOwnCode')->name('console.code.own.code');
        Route::post('/','Console\InviteCodeController@store')->name('console.code.store');
    });
});

