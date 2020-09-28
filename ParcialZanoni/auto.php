<?php

use \Firebase\JWT\JWT;
require_once __DIR__ .'/vendor/autoload.php';
include_once './archivos.php';
include_once './usuario.php';
include_once './estacionamiento.php';
//date_default_timezone_set("America/Argentina/Buenos_Aires"); 

class auto
{
    public $patente;
    public $fechaIngreso;
    public $tipoDeIngreso;
    public $email;

    public function __construct($patente,$fechaIngreso,$tipoDeIngreso,$email)
    {
        $this->patente=$patente;
        $this->fechaIngreso=$fechaIngreso;
        $this->tipoDeIngreso=$tipoDeIngreso;
        $this->email=$email;
    }

    public static function ingresarAuto($usuario,$patente,$fechaIngreso,$tipoDeIngreso,$email)
    {
        $retorno = false;
        $response = File::TraerJSON("users.json");
        $auto= new auto($patente,$fechaIngreso,$tipoDeIngreso,$email);

        if($response != false)
        {
            foreach ($response as $user) 
            {
                if(usuario::validarTipo($usuario, $user->$usuario))
                {   
                    $response= File::guardarJSON("autos.json",$auto);
                    $retorno=true;
                }else{
                    echo "Tipo de usuario no autorizado";
                }
            }
        }
        return $retorno;
        

    }
}




?>