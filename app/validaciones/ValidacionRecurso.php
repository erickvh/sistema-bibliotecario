<?php
namespace App\Validations;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\StringLength as StringLength;

class ValidacionRecurso extends Validation
{

    public function initialize()
    {
         /*Validacion especiales*/


 

         $this->add('nombreMaterial', new Regex([
                 'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9]*)*)+$/',
                 'message'=>'Nombre de recurso debe ser alfanumerico']));

        $this->add('descMaterial', new Regex([
        'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9]*)*)+$/',
        'message'=>'Descripción recurso debe ser alfanumerico',
        'allowEmpty'=>true]));
 
        $this->add('nomImgMaterial', new Regex([
            'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9]*)*)+$/',
            'message'=>'nombre imagen recurso debe ser alfanumerico',
            'allowEmpty'=>true]));
        
        

           
         //tamaño de cadenas
         $this->add("nombreMaterial",new StringLength(
                                 [
                                     "max"            => 120,
                                     "min"            => 4,
                                     "messageMaximum" => "nombre de recurso no debe contener mas de 120 caracteres",
                                     "messageMinimum" => "nombre de recurso requiere mas de 4 caracteres",
                                 ]
                             )
                 );
 
 
    $this->add("nomImgMaterial",new StringLength(
        [
            "max"            => 50,
            "min"            => 4,
            "messageMaximum" => "nombre de imagen no debe contener mas de 50 caracteres",
            "messageMinimum" => "nombre de imagen requiere mas de 4 caracteres",
            'allowEmpty' => true
        ]
    )
);
    
     /**campos obligatorios */
         $this->add('nombreMaterial',new PresenceOf(['message' => 'El nombre de recurso es requerido']));
         $this->add('cantidadMaterial',new PresenceOf(['message' => 'La cantidad es requerida']));
         $this->add('autoresRecurso',new PresenceOf(['message' => 'El recurso debe tener autores']));
         $this->add('tipoFormato',new PresenceOf(['message' => 'El recurso debe tener asociado formatos']));
         $this->add('subMaterial',new PresenceOf(['message' => 'El recurso debe tener asociada subcategoria']));
  
        }

}