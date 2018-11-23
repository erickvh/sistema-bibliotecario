<?php
namespace App\Validations;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\StringLength as StringLength;

class ValidacionBibliotecario extends Validation{

    public function initialize()
    {
    
        /*Validacion especiales*/

        $this->add('email',new Email(['message' => 'El email no es valido',
        'allowEmpty'=>true]));
        $this->add('nombre', new Regex([
            'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'message'=>'El nombre no es valido']));
        $this->add('username', new Regex([
                'pattern'=>'/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9]+$/',
                'message'=>'El nombre de usuario no debe contener espacios']));
        $this->add('dui', new Regex([
                    'pattern'=>'/^\d{8}-\d{1}$/',
                    'message'=>'El dui debe contener formato ejemplo 00000000-0']));
        $this->add('telefono', new Regex([
                        'pattern'=>'/^\d{4}-\d{4}$/',
                        'message'=>'El numero debe ser, formato ejemplo 2351-1243',
                        'allowEmpty' => true]));
    
        $this->add("nombre",new StringLength(
                                [
                                    "max"            => 120,
                                    "min"            => 6,
                                    "messageMaximum" => "Nombre no debe contener mas de 120 caracteres",
                                    "messageMinimum" => "Nombre requiere mas de 6 caracteres",
                                ]
                            )
                        );
        $this->add("username",new StringLength(
                            [
                                "max"            => 40,
                                "min"            => 2,
                                "messageMaximum" => "Nombre de usuario no debe contener mas de 120 caracteres",
                                "messageMinimum" => "Nombre de usuario requiere mas de 2 caracteres",
                            ]
                        )
                    );
                    $this->add("sexo",new StringLength(
                        [
                            "max"            => 1,
                            "min"            => 1,
                            "messageMaximum" => "El sexo debe poseer un caracter",
                            "messageMinimum" => "El sexo debe  poseer un caracter",
                        ]
                    )
                );
         /**campos obligatorios */
        $this->add('username',new PresenceOf(['message' => 'El nombre de usuario es requerido']));
        $this->add('nombre',new PresenceOf(['message' => 'El nombres es requerido']));
        $this->add('fechanacimiento',new PresenceOf(['message' => 'La fecha de nacimiento es requerido']));
        $this->add('sexo',new PresenceOf(['message' => 'El sexo es requerido']));
        $this->add('dui',new PresenceOf(['message' => 'Numero de dui es requerido']));
        $this->add('biblioteca',new PresenceOf(['message' => 'La biblioteca es requerida']));
    
    }
    //get all the messages through of the validations, into an array with  one error for each post value
    public function obtenerMensajes($post)
    {
        $mensajes=[];
    
        $messagesFromValidation=$this->validate($post);
    
        foreach ($messagesFromValidation as  $m) 
        {
            $mensajes[$m->getField()]=$m->getMessage();
        }
    
        return $mensajes;
    }
    
    //this print the flash values 
    public function gettingFlashMessages($mensajes){   
        if(!empty($mensajes))
        {
            foreach ($mensajes as $mensaje ) {
            $this->flashSession->warning($mensaje);               
            }
        }
    
    }
    
    public function setUpdate($id){
        $this->actualizar = true;
        $this->idCategoria=$id;
    }
}