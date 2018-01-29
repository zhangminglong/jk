<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

define('ROOT_PATH', __DIR__);

// 自动载入
require_once ROOT_PATH . '/vendor/autoload.php';

// 连接数据库
$capsule = new Capsule;

$capsule->addConnection(require ROOT_PATH . '/config/database.php');

$capsule->setEventDispatcher(new Dispatcher(new Container));

$capsule->setAsGlobal();

$capsule->bootEloquent();