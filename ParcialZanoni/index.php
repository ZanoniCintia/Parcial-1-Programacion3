<?php

use \Firebase\JWT\JWT;
require_once __DIR__ .'/vendor/autoload.php';
include_once './archivos.php';
include_once './usuario.php';
include_once './respuesta.php';
include_once './estacionamiento.php';
include_once './auto.php';

$path = $_SERVER['PATH_INFO'];
$metodo = $_SERVER['REQUEST_METHOD'];

$respuesta = new Respuesta;
$respuesta->data='';

switch($metodo)
{
    case 'POST':
        switch($path)
        {
            case '/usuario':
                if (isset($_POST['email']) && isset($_POST['tipo']) && isset($_POST['clave'])&& $_POST['mail']!="" && $_POST['tipo'] && $_POST['clave']!="")
                {
                    if (usuario::RegistrarUsuario($_POST['email'],$_POST['tipo'],$_POST['clave']))
                    {
                        $respuesta->data = 'Registro valido';
                       
                    }
                }else
                {
                    $respuesta->data= 'Faltan datos';
                    
                   
                }
                echo json_encode($respuesta);
            break;
            case '/login':
                if (isset($_POST['email']) && isset($_POST['tipo']) && isset($_POST['clave'])  && $_POST['email']!="" && $_POST['tipo']="" && $_POST['clave']!="")
                {   
                    
                    $respuesta->data = usuario::Login($_POST['email'],$_POST['tipo'],$_POST['clave']);
                   
                }
                else
                {
                    $respuesta->data = 'Faltan datos';
                    $respuesta->status = 'fail';
                }
                
                echo json_encode($respuesta);
            break;
            case '/precio':
               
                $respuesta->data = estacionamiento::cargarPrecio($_POST['tipo'],$_POST['hora'],$_POST['mes'],$_POST['estadia']);
                
                echo json_encode($respuesta);
            break;
            case '/ingreso':
             
                $respuesta->data= auto::ingresarAuto($_POST['usuario'],$_POST['patente'],$_POST['fechaIngreso'],$_POST['tipoIngreso'],$_POST['email']);
                echo json_encode($respuesta);
            break;
           
        }    
    break;


    case 'GET':
        switch($path)
        {   
            
            case '/retiro':
                //no me alcanzo el tiempo
             
            break;
            case '/ingreso':
               
            break;
            case '/importe/:tipo':
              
            break;
            case '/importe':
            break;
        }
    break;
}

?>

