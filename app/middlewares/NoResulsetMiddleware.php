<?php
namespace App\Middlewares;

class NoResulSetMiddleware {

public function middleware($resource,$dispatcher)
{
$resource==null? $dispatcher->forward(['controller'=>'error','action'=>'mostrar404',]):'';
}

}