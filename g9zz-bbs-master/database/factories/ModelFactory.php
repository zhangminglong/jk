<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$a = $factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    $faker = \Faker\Factory::create('zh_CN');
    static $password;
    return [
        'name' => 'G9ZZ管理员测试号',
        'email' => 'test@g9zz.com',
        'password' => bcrypt('g9zzadmin'),
        'hid' => '',
        'avatar' => 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1497014683027&di=3cfb152ddbcdb74cc2840e92022e6888&imgtype=0&src=http%3A%2F%2Fwww.ucicq.com%2Fuploads%2Fallimg%2F170307%2F2234302133_0.jpg'
    ];
//    return [
//        'name' => $faker->name,
//        'email' => $faker->unique()->safeEmail,
//        'password' => $password ?: $password = bcrypt('secret'),
//        'hid' => '',
//        'avatar' => ''
//    ];
});

$factory->define(\App\Models\Nodes::class,function(){
    $faker = \Faker\Factory::create('zh_CN');
    return [
        'hid' => '',
        'parent_hid' => 0,
        'weight' => 0,
        'level' => 0,
        'name' => 'default-node',
        'display_name' => "默认节点",
        'description' => "这是默认节点,创建时自动创建",
    ];
});

$factory->define(\App\Models\Roles::class,function(){
    $faker = \Faker\Factory::create('zh_CN');
    return [
        'name' => 'super_admin',
        'level' => 1,
        'display_name' => "超级管理员",
        'description' => "权限最大的管理员..可以操控世界!改变世界!",
    ];
});




