<?php
namespace App\Validations;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\StringLength as StringLength;

class ValidacionFormato extends Validation
{

    public function initialize()
    {
        /*Validacion especiales*/

        $this->add('tipoFormato', new Regex([
            'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'message'=>'El tipo formato no es valido']));
        $this->add('descFormato', new Regex([
                'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
                'message'=>'La descripción del formato debe ser alfanumerica']));


        //tamaño de cadenas
        $this->add("tipoFormato",new StringLength(
                                [
                                    "max"            => 50,
                                    "messageMaximum" => "tipo formato no debe contener mas de 50 caracteres",
                                   
                                ]
                            )
                );




    /**campos obligatorios */
        $this->add('tipoFormato',new PresenceOf(['message' => 'El tipo de formato es requerido']));
   }

}