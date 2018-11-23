<?php
namespace App\Validations;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\StringLength as StringLength;

class ValidacionBiblioteca extends Validation
{

    public function initialize()
    {
        /*Validacion especiales*/

        $this->add('emailBiblioteca',new Email(['message' => 'El email no es valido',
        'allowEmpty'=>true]));

        $this->add('nombreBiblioteca', new Regex([
            'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'message'=>'El nombre no es valido']));
        
        $this->add('ubicacionBiblioteca', new Regex([
                'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9]*)*)+$/',
                'message'=>'La ubicación de la biblioteca debe ser alfa numerica']));
     
        $this->add('telefonoBiblioteca', new Regex([
                        'pattern'=>'/^\d{4}-\d{4}$/',
                        'message'=>'El numero debe ser, formato ejemplo 2351-1243',
                        'allowEmpty' => true]));

        $this->add('clasBiblioteca', new Regex([
                        'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
                        'message'=>'La clasificacion de la biblioteca, debe solo ser texto',
                        'allowEmpty'=>true]));
    
        $this->add('nomlogoBiblioteca', new Regex([
                        'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
                        'message'=>'El nombre logo de la biblioteca, debe solo ser texto',
                        'allowEmpty'=>true]));

        //tamaño de cadenas
        $this->add("clasBiblioteca",new StringLength(
                                [
                                    "max"            => 120,
                                    "min"            => 4,
                                    "messageMaximum" => "clasificación no debe contener mas de 120 caracteres",
                                    "messageMinimum" => "clasificación requiere mas de 4 caracteres",
                                    'allowEmpty' => true
                                ]
                            )
                );

        $this->add("ubicacionBiblioteca",new StringLength(
                    [
                        "max"            => 300,
                        "min"            => 4,
                        "messageMaximum" => "ubicación no debe contener mas de 300 caracteres",
                        "messageMinimum" => "ubicación requiere mas de 4 caracteres",
                    ]
                )
    );
    $this->add("nomlogoBiblioteca",new StringLength(
        [
            "max"            => 50,
            "min"            => 4,
            "messageMaximum" => "nombre de logo no debe contener mas de 50 caracteres",
            "messageMinimum" => "nombre de logo requiere mas de 4 caracteres",
            'allowEmpty' => true
        ]
    )
);


    /**campos obligatorios */
        $this->add('nombreBiblioteca',new PresenceOf(['message' => 'El nombre de la biblioteca es requerido']));
        $this->add('ubicacionBiblioteca',new PresenceOf(['message' => 'La ubicacion es requerida']));
        $this->add('telefonoBiblioteca',new PresenceOf(['message' => 'El telefono biblioteca es requerido']));
    
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