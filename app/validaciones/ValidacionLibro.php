<?php
namespace App\Validations;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\StringLength as StringLength;

class ValidacionLibro extends Validation
{

    public function initialize()
    {
         /*Validacion especiales*/


 

         $this->add('nomLibro', new Regex([
                 'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9]*)*)+$/',
                 'message'=>'Nombre de libro debe ser alfanumerico']));

        $this->add('descLibro', new Regex([
        'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9]*)*)+$/',
        'message'=>'Descripción libro debe ser alfanumerico',
        'allowEmpty'=>true]));
                
        $this->add('editLibro', new Regex([
            'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9]*)*)+$/',
            'message'=>'Editorial de libro debe ser alfanumerico',
            'allowEmpty'=>true]));
       
        $this->add('volLibro', new Regex([
                'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9]*)*)+$/',
                'message'=>'Volumen libro debe ser alfanumerico',
                'allowEmpty'=>true]));
        
        $this->add('sinLibro', new Regex([
        'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9]*)*)+$/',
        'message'=>'Sinopsis libro debe ser alfanumerico',
        'allowEmpty'=>true]));

        $this->add('nomImgLibro', new Regex([
            'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9]*)*)+$/',
            'message'=>'nombre imagen libro debe ser alfanumerico',
            'allowEmpty'=>true]));
            
         //tamaño de cadenas
         $this->add("nomLibro",new StringLength(
                                 [
                                     "max"            => 120,
                                     "min"            => 4,
                                     "messageMaximum" => "nombre de libro no debe contener mas de 120 caracteres",
                                     "messageMinimum" => "nombre de libro requiere mas de 4 caracteres",
                                 ]
                             )
                 );
 

     $this->add("editLibro",new StringLength(
         [
             "max"            => 120,
             "min"            => 4,
             "messageMaximum" => "La editorial del libro no debe contener mas de 120 caracteres",
             "messageMinimum" => "La editorial del libro requiere mas de 4 caracteres",
            "allowEmpty"=>true
             ]
     ));
     
     $this->add("volLibro",new StringLength(
        [
            "max"            => 20,
            "min"            => 1,
            "messageMaximum" => "La editorial del libro no debe contener mas de 20 caracteres",
            "messageMinimum" => "La editorial del libro requiere mas de 1 caracteres",
            "allowEmpty"=>true
            ]
    ));
  
    $this->add("nomImgLibro",new StringLength(
        [
            "max"            => 50,
            "min"            => 4,
            "messageMaximum" => "nombre de imagen libro no debe contener mas de 50 caracteres",
            "messageMinimum" => "nombre de imagen libro requiere mas de 4 caracteres",
            'allowEmpty' => true
        ]
    )
);
    
     /**campos obligatorios */
         $this->add('nomLibro',new PresenceOf(['message' => 'El nombre de libro es requerido']));
         $this->add('cantidadLibro',new PresenceOf(['message' => 'La cantidad es requerida']));
         $this->add('autoresLibro',new PresenceOf(['message' => 'El libro debe tener autores']));
         $this->add('subLibro',new PresenceOf(['message' => 'EL libro debe contener subcategoria asociada']));
    
        }

}