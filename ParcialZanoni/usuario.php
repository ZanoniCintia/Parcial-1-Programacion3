<?php
use \Firebase\JWT\JWT;
require_once __DIR__ .'/vendor/autoload.php';
include_once './archivos.php';

class usuario
{

    public $mail;
    public $tipoUser;
    public $clave;

    public function __construct($mail,$tipoUser,$clave)
    {
        $this->mail=$mail;
        $this->tipoUser=$tipoUser;
        $this->clave=$clave;
    }

    public static function RegistrarUsuario($mail,$tipoUser,$clave)
    {
        $return=false;
        $newUser = new usuario($mail,$tipoUser,$clave);
        
        if (File::GuardarJSON("users.json",$newUser))
        {   
            
            $return=true;
        }
        return $return;
    }

    public static function validarMail($mail, $mailNew)
    {
        $return = false;
         if ($mail==$mailNew)
         {
             
            $return = true;
         }
        return $return;
    }

    public static function Login($mail,$tipoUser,$clave)
    {
        $return=false;
        $response = File::TraerJSON("users.json");

        if ($response!=false)
        {
            $key = "primerparcial";
            foreach ($response as $user)
            {
                if (usuario::validarUsuario($mail,$tipoUser,$clave , $user->mail,$user->$tipoUser, $user->clave))
                    {
                        $payload = array(
                            "email" => $mail,
                            "tipo" => $tipoUser
                        );
                        $return=true;
                    break;
                    }
            }
            if ($return)
            {
                $return = JWT::encode($payload, $key);
                
            }    
        }
        return $return;
    }

    public static function validarUsuario($mail, $mailNew, $tipoUser,$tipoUserNew,$clave,$claveNew)
    {
        $return = false;
         if ($mail==$mailNew && $tipoUser==$tipoUserNew && $clave==$claveNew)
         {
             
            $return = true;
         }
        return $return;
    }


}






?>