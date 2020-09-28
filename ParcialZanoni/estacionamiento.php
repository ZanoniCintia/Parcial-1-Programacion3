<?php
use \Firebase\JWT\JWT;
require_once __DIR__ .'/vendor/autoload.php';
include_once './archivos.php';
include_once './usuario.php';

class estacionamiento
{   
    public $precioHora;
    public $precioEstadia;
    public $precioMensual;

    public function __construct($precioHora,$precioEstadia,$precioMensual)
    {
        $this->precioHora=$precioHora;
        $this->precioEstadia=$precioEstadia;
        $this->precioMensual=$precioMensual;
    }

    public static function validar($tipo,$tipoUserNew)
    {
        $return = false;
         if ($tipo==$tipoUserNew )
         {
             
            $return = true;
         }
        return $return;
    }

    public static function cargarPrecio($tipoUser,$precioHora,$precioEstadia,$precioMensual)
    {
        $retorno = false;
        $response = File::TraerJSON("users.json");
        $precio= new estacionamiento($precioHora,$precioMensual,$precioEstadia);
        
        if($response != false)
        {
            foreach ($response as $user) 
            {
                if(usuario::validarTipo($tipoUser, $user->$tipoUser))
                {   
                    $response= File::guardarJSON("precios.json",$precio);
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