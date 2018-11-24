<?php
namespace App\Validations;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\StringLength as StringLength;

class ValidacionAutor extends Validation
{

    public function initialize()
    {
        /*Validacion especiales*/

        $this->add('nombre', new Regex([
            'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'message'=>'El nombre no es valido']));
        
        $this->add('nacionalidad', new Regex([
                'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
                'message'=>'La nacionalidad debe ser alfabetica']));
     

        //tamaño de cadenas
        $this->add("nombre",new StringLength(
                                [
                                    "max"            => 120,
                                    "min"            => 4,
                                    "messageMaximum" => "nombre no debe contener mas de 50 caracteres",
                                    "messageMinimum" => "nombre requiere mas de 4 caracteres",
                                    'allowEmpty' => true
                                ]
                            )
                );

                $this->add("nacionalidad",new StringLength(
                    [
                        "max"            => 50,
                        "min"            => 4,
                        "messageMaximum" => "nacionalidad no debe contener mas de 50 caracteres",
                        "messageMinimum" => "nacionalidad requiere mas de 4 caracteres",
                        'allowEmpty' => true
                    ]
                )
    );



    /**campos obligatorios */
        $this->add('nombre',new PresenceOf(['message' => 'El nombre del autor es requerido']));
        $this->add('nacionalidad',new PresenceOf(['message' => 'nacionalidad del autor es requerido']));
        $this->add('sexo', new PresenceOf(['message'=>'El sexo es requerida']));
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