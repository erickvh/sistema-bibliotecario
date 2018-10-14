<?php
namespace App\Validations;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\StringLength as StringLength;

class ValidacionSubcategoria extends Validation
{

    public function initialize()
    {
        /*Validacion especiales*/

        $this->add('nombreCat', new Regex([
            'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'message'=>'El nombre no es valido']));
        
        $this->add('descCat', new Regex([
                'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9]*)*)+$/',
                'message'=>'La descripción debe ser alfa numerica']));
     
        $this->add('codCat', new Regex([
                        'pattern'=>'/^[0-9]{3}$/',
                        'message'=>'El codigo subcategoria, formato ejemplo 112,231,999',
                        'allowEmpty' => true]));

        //tamaño de cadenas
        $this->add("nombreCat",new StringLength(
                                [
                                    "max"            => 50,
                                    "min"            => 4,
                                    "messageMaximum" => "subcategoria no debe contener mas de 50 caracteres",
                                    "messageMinimum" => "subcategoria requiere mas de 4 caracteres",
                                    'allowEmpty' => true
                                ]
                            )
                );



    /**campos obligatorios */
        $this->add('nombreCat',new PresenceOf(['message' => 'El nombre de la categoria es requerido']));
        $this->add('codCat',new PresenceOf(['message' => 'El codigo de la categoria es requerido']));
        $this->add('categoria', new PresenceOf(['message'=>'La categoria es requerida']));
    }

}