<?php
namespace Com\Daw2\Core;

abstract class BaseController {
    protected $view;

    function __construct() {
        $this->view = new View(get_class($this));
    }
    
    function getModel(string $model){
        $config = \Com\Daw2\Core\Config::getInstance();       
        $modelName = $config->get('MODELS_NAMESPACE').$model;
        return new $modelName();
    }
}