<?php
namespace Com\Daw2\Controllers;

class InicioController extends \Com\Daw2\Core\BaseController
{
   
   public function index ()
   {                                 
        $_vars = array('titulo' => 'Panel de control',
                      'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)));
        $this->view->showViews(array('templates/header.view.php', 'inicio.view.php', 'templates/footer.view.php'), $_vars);      
   }
}
?>