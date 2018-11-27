<?php
namespace App\Validations;
use App\Models\Categorias;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\StringLength as StringLength;
use Phalcon\Validation\Validator\Uniqueness  as UniquenessValidator;
class ValidacionCategoria extends Validation
{

    public $idCategoria;
    public $actualizar;

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
                        'pattern'=>'/^[0-9]{1}00$/',
                        'message'=>'El codigo categoria, formato ejemplo 100,200,300',
                        'allowEmpty' => true]));
                        
        //tamaño de cadenas
        $this->add("nombreCat",new StringLength(
                                [
                                    "max"            => 50,
                                    "min"            => 4,
                                    "messageMaximum" => "categoria no debe contener mas de 50 caracteres",
                                    "messageMinimum" => "categoria requiere mas de 4 caracteres",
                                    'allowEmpty' => true
                                ]
                            )
                );



    /**campos obligatorios */
        $this->add('nombreCat',new PresenceOf(['message' => 'El nombre de la categoria es requerido']));
        $this->add('codCat',new PresenceOf(['message' => 'El codigo de la categoria es requerido']));
    
    }

    //get all the messages through of the validations, into an array with  one error for each post value
    public function obtenerMensajes($post)
    {
        //update validation is allowed, only when codigos are different db vs request

/*        if(!$this->actualizar){
            $this->add('codCat', new UniquenessValidator([
                "model"=> new Categorias,
                "attribute" => "codigo",
                'message'=> 'El codigo de categoria ya existe'
                ]));
        }
        else if(Categorias::findFirst($this->idCategoria)->codigo!=$this->request->getPost('codCat'))
        {

            $this->add('codCat', new UniquenessValidator([
                "model"=> new Categorias,
                "attribute" => "codigo",
                'message'=> 'El codigo de categoria ya existe'
                ]));

        }
  */      //end adding validation

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