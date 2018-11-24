<?php
namespace App\Middlewares;

use App\Models\Users;



class RolMiddleware {

    public function middleware($session,$response,$permisoRol){
            // redirige si el rol cargado es diferente
            $user= Users::findFirst($session->get('id'));

            if($permisoRol!==$user->roles->nombre){
                return $response->redirect('/404');
            }

    }

}