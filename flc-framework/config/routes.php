<?php 
/**
 * 路由配置
 * @author Flc <2016-07-26 23:49:40>
 */
use \NoahBuscher\Macaw\Macaw;

Macaw::get('/', 'App\Http\Controller\Index@index');

Macaw::dispatch();