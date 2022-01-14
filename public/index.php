<?php
//Importamos el autoloader generado por composer
require '../vendor/autoload.php';
//Cargamos la configuración de nuestro proyecto
require '../config.php';

try
{
   //Llamamos al método main del frontController
   Com\Daw2\Core\FrontController::main();
}
catch (Exception $e)
{
    if($config->get('DEBUG')){
        throw $e;
    }
    else{
        echo $e->getMessage();
    }
   
}