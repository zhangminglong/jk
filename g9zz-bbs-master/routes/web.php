<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test','TestController@index');


$this->post('register', 'Auth\MyRegisterController@store')->name('register.store');
$this->post('login', 'Auth\MyLoginController@login');
$this->get('login','Auth\MyLoginController@getLogin')->name('web.get.login');

Route::get('auth/{service}', 'Auth\MyLoginController@redirectToProvider');
Route::get('auth/{service}/callback', 'Auth\MyLoginController@handleProviderCallback');

//激活账号
Route::get('/verify','Auth\MyLoginController@verify')->name('index.auth.login.verify.account');

Route::group(['prefix' => 'wechat'],function () {
    Route::get('/xcx/userInfo','Auth\MyLoginController@getWechatMiniProgramUserInfo')->name('index.xcx.userInfo');
});

Route::group([],function(){
    Route::group(['prefix' => 'user','middleware' => 'idDecode'],function(){
//        Route::get('/{hid}','Console\UserController@show')->name('index.user.show');
//        Route::get('/','Console\UserController@index')->name('console.user.index');
//        Route::post('/{userId}/role/{roleId}','Console\UserController@attachRole')->name('console.user.attach.role');
        Route::get('/{userId}/post','Console\UserController@getPostByUser')->name('index.all.post.by.user');
        Route::get('/{userId}/reply','Console\UserController@getReplyByUser')->name('index.all.reply.by.user');


    });

    Route::group(['prefix' => 'post'],function() {
        Route::get('/','Console\PostController@index')->name('index.post.index');
//        Route::post('/','Console\PostController@store')->name('index.post.store');
        Route::get('/{hid}','Console\PostController@show')->name('index.post.show');

        Route::get('/{postHid}/reply','Console\PostController@getReply')->name('index.post.get.reply');

    });

    Route::group(['prefix' => 'node'],function() {
        Route::get('/','Console\NodeController@index')->name('index.node.index');
        Route::get('/{hid}','Console\NodeController@show')->name('index.node.show');

        Route::get('/{hid}/post','Console\NodeController@getPostByNode')->name('index.get.post.by.node');
        Route::get('/all/showNode','Console\NodeController@getShowNode')->name('index.get.show.node');
    });

    Route::group(['prefix' => 'tag'],function() {
        Route::get('/','Console\TagController@index')->name('index.tag.index');
        Route::get('/{hid}','Console\TagController@show')->name('index.tag.show');
    });

    Route::group(['prefix' => 'reply'],function() {
        Route::get('/','Index\ReplyController@index')->name('index.reply.index');
//        Route::post('/','Index\ReplyController@store')->name('index.reply.store');
        Route::get('/{hid}','Index\ReplyController@show')->name('index.reply.show');
    });

    Route::group(['prefix' => 'append'],function() {
        Route::get('/','Index\AppendController@index')->name('index.append.index');
//        Route::post('/','Index\AppendController@store')->name('index.append.store');
        Route::get('/{hid}','Index\AppendController@show')->name('index.append.show');
    });

});

/**
 * 普通用户 可以操作 但必须登录的
 */
Route::group(['middleware' => 'g9zz'],function(){

    Route::group(['prefix' => 'user'],function(){
        Route::get('/{hid}','Console\UserController@show')->name('index.user.show');

        //点击获取 验证链接
        Route::get('/verify','Auth\MyLoginController@getVerifyToken')->name('console.user.get.verify.token');

    });

    Route::group(['prefix' => 'post'],function() {
        Route::post('/','Console\PostController@store')->name('index.post.store');
    });

    Route::group(['prefix' => 'reply'],function() {
        Route::post('/','Index\ReplyController@store')->name('index.reply.store');
    });

    Route::group(['prefix' => 'append'],function() {
        Route::post('/','Index\AppendController@store')->name('index.append.store');
    });

    Route::group(['prefix' => 'notify'],function() {
        //获取所有通知
        Route::get('/','Console\NotifyController@getNotify')->name('index.user.get.notify');
        Route::get('/unreadNum','Console\NotifyController@getUnreadNotifyNum')->name('index.user.notify.unread.num');
        //标记某个通知已读
        Route::post('/set/{notifyId}/read','Console\NotifyController@setNotifyRead')->name('index.user.set.notify.read');
        //标记所有通知已读
        Route::post('/set/allRead','Console\NotifyController@setAllNotifyRead')->name('index.user.set.all.notify.read');
    });
});