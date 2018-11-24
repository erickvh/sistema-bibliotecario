<?php
namespace App\Middlewares;


class AuthMiddleware {

    public function middleware($session,$response){

        if(!$session->has('id')){
            return $response->redirect('/404');
          }
    }

}