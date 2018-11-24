<?php
namespace App\Validations;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\StringLength as StringLength;
use App\Models\Bibliotecarios;
use App\Models\Users;

class ValidacionBibliotecario extends Validation{

    protected $idBibliotecario;
    protected $actualizar;
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
                    //update validation is allowed, only when codigos are different db vs request
                    if(!$this->actualizar){
                        $this->add('email', new UniquenessValidator([
                            "model"=> new Users,
                            "attribute" => "email",
                            'message'=> 'El Email ya existe'
                            ]));
                        $this->add('dui', new UniquenessValidator([
                            "model"=> new Bibliotecarios,
                            "attribute" => "dui",
                            'message'=> 'El dui ya existe'
                            ]));
                        }
                    else if(Bibliotecarios::findFirst($this->idBibliotecario)->users->email!=$this->request->getPost('email')
                    ||Bibliotecarios::findFirst($this->idBibliotecario)->dui!=$this->request->getPost('dui'))
                    {
            
                        $this->add('email', new UniquenessValidator([
                            "model"=> new Bibliotecarios,
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
        $this->idBibliotecario=$id;
    }
}