<?php
namespace App\Validations;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\StringLength as StringLength;
use App\Models\Prestamistas;
use App\Models\Users;

class ValidacionLector extends Validation{

    protected $idPrestamista;
    protected $actualizar;
    public function initialize()
    {
    
        /*Validacion especiales*/
        
        $this->add('email',new Email(['message' => 'El email no es valido',
        'allowEmpty'=>true]));
        $this->add('nombre', new Regex([
            'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'message'=>'El nombre no es valido']));
        $this->add('usuario', new Regex([
                'pattern'=>'/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9]+$/',
                'message'=>'El nombre de usuario no debe contener espacios']));
         $this->add('lugardeestudio', new Regex([
            'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'message'=>'El lugar de estudio no es valido']));
        $this->add('direccion', new Regex([
            'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'message'=>'la direccion no es valida']));
        $this->add('nombrePadre', new Regex([
            'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'message'=>'nombre del padre del lector no es valida']));
        $this->add('nombreMadre', new Regex([
            'pattern'=>'/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'message'=>'el nombre de la madre del lector no es valida']));
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
        $this->add("usuario",new StringLength(
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
        $this->add('usuario',new PresenceOf(['message' => 'El nombre de usuario es requerido']));
        $this->add('nombre',new PresenceOf(['message' => 'El nombres es requerido']));
        $this->add('fechanacimiento',new PresenceOf(['message' => 'La fecha de nacimiento es requerido']));
        $this->add('sexo',new PresenceOf(['message' => 'El sexo es requerido']));
        $this->add('lugardeestudio',new PresenceOf(['message' => 'Numero de dui es requerido']));
        $this->add('ocupacion',new PresenceOf(['message' => 'La ocupación es requerida']));
        $this->add('direccion',new PresenceOf(['message' => 'La dirección es requerida']));
        $this->add('nombrePadre',new PresenceOf(['message' => 'El nombre del padre es requerida']));
        $this->add('nombreMadre',new PresenceOf(['message' => 'El nombre de la madre es requerida']));
        $this->add('municipio',new PresenceOf(['message' => 'El municipio de la madre es requerida']));
    }
    //get all the messages through of the validations, into an array with  one error for each post value
    public function obtenerMensajes($post)
    {
                    //update validation is allowed, only when codigos are different db vs request
                    if(!$this->actualizar){
                        $this->add('email', new UniquenessValidator([
                            "model"=> new Users,
                            "attribute" => "email",
                            'message'=> 'El Email ya existe'
                            ]));
                        }
                    else if(Prestamistas::findFirst($this->idPrestamista)->users->email!=$this->request->getPost('email'))
                    {
            
                        $this->add('email', new UniquenessValidator([
                            "model"=> new Prestamistas,
                            "attribute" => "email",
                            'message'=> 'El email ya existe en nuestros registros'
                            ]));
            
                    }


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
        $this->idPrestamista=$id;
    }
}