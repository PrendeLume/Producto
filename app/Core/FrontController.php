<?php

namespace Com\Daw2\Core;

class FrontController {

    static function main() {
        $config = Config::getInstance();

        //Con el objetivo de no repetir nombre de clases
        //  nuestros controladores terminaran todos en Controller.
        //Por ej, la clase controladora Libros, será LibrosController
        //Formamos el nombre del Controlador o en su defecto
        // tomamos que es el de Libros_Controller        
        if (!empty($_GET['controller'])) {
            $controllerName = ucwords($_GET['controller']);
        } else {
            $controllerName = $config->get('DEFAULT_CONTROLLER');
        }
        //Creamos la ruta completa al controlador
        $controller = $config->get('CONTROLLERS_NAMESPACE').$controllerName."Controller";
        //Lo mismo sucede con las acciones, si no hay accion
        //  tomamos index como accion
        $action = $config->get('DEFAULT_ACTION');
        if (!empty($_GET['action'])) {
            $action = $_GET['action'];
        }
        
        if(!class_exists($controller)){
            throw new \Exception('No existe la clase: ' . $config->get('CONTROLLERS_NAMESPACE').$controller);
        }
        
        if (!is_callable(array($controller, $action))) {
            throw new \Exception($controller . '->' . $action . ' no existe');
        }

        //Si todo esta bien, creamos una instancia del controlador
        //  y llamamos a la accion
        $controller = new $controller();
        $controller->$action();
    }

}
