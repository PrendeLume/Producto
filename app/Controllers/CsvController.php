<?php
namespace Com\Daw2\Controllers;

class CsvController extends \Com\Daw2\Core\BaseController
{
   
   public function index() : void
   {                                 
        $_vars = array('titulo' => 'Datos población Pontevedra',
                      'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
                      'csv_div_titulo' => 'Por año y sexo',
                      'js' => array('plugins/datatables/jquery.dataTables.min.js', 'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js', 'assets/js/pages/csv.view.js')
            );
                  
        $csvModel = new \Com\Daw2\Models\CSVModel(\Com\Daw2\Core\Config::getInstance()->get('DATA_FOLDER').'poblacion_pontevedra.csv');
        $_vars["data"] = $csvModel->getPoblacionPontevedra();        
        $this->view->showViews(array('templates/header.view.php', 'csv.view.php', 'templates/footer.view.php'), $_vars);      
   }
   
   public function pontevedra2020() : void
   {                                 
        $_vars = array('titulo' => 'Población Pontevedra 2020',
                      'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
                      'csv_div_titulo' => 'Datos del fichero',
                      'columnasMostrar' => array(0, 3),
                      'js' => array('plugins/datatables/jquery.dataTables.min.js', 'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js', 'assets/js/pages/csv.view.js')
            );
                  
        $csvModel = new \Com\Daw2\Models\CSVModel(\Com\Daw2\Core\Config::getInstance()->get('DATA_FOLDER').'poblacion_pontevedra_2020_totales.csv');
        $_vars["data"] = $csvModel->getPoblacionPontevedra();        
        $this->view->showViews(array('templates/header.view.php', 'csv_personalizado.view.php', 'templates/footer.view.php'), $_vars);      
   }
   
   public function ejercicio01() : void{
       $_vars = array('titulo' => 'Histórico población Pontevedra',
                      'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
                      'csv_div_titulo' => 'Datos del CSV',
                      'js' => array('plugins/datatables/jquery.dataTables.min.js', 'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js', 'assets/js/pages/csv.view.js')
            );
                  
        $csvModel = new \Com\Daw2\Models\CSVModel(\Com\Daw2\Core\Config::getInstance()->get('DATA_FOLDER').'poblacion_pontevedra2.csv');
        $_vars["data"] = $csvModel->getPoblacionPontevedra(); 
        if(count($_vars['data']) > 1){ //La primera fila son los nombres de columna
            $filaMax = $_vars["data"][0];
            $filaMin = $_vars["data"][0];
        }
        else{
            $filaMax = NULL;
            $filaMin = NULL;
        }
        foreach($_vars["data"] as $fila){
            if($filaMin[3] > $fila[3] && is_numeric($fila[3])){
                $filaMin = $fila;
            }
            elseif($filaMax[3] < $fila[3] && is_numeric($fila[3])){
                $filaMax = $fila;
            }
        }
        $_vars["filaMax"] = $filaMax;
        $_vars["filaMin"] = $filaMin;
        $this->view->showViews(array('templates/header.view.php', 'csv.footer.view.php', 'templates/footer.view.php'), $_vars);   
   }
   
   public function ejercicio02() : void{
       $_vars = array('titulo' => 'Población España grupos edad',
                      'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
                      'csv_div_titulo' => 'Datos del CSV',
                      'js' => array('plugins/datatables/jquery.dataTables.min.js', 'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js', 'assets/js/pages/csv.view.js')
            );
                  
        $csvModel = new \Com\Daw2\Models\CSVModel(\Com\Daw2\Core\Config::getInstance()->get('DATA_FOLDER').'poblacion_grupos_edad.csv');
        $_vars["data"] = $csvModel->getPoblacionPontevedra();        
        $this->view->showViews(array('templates/header.view.php', 'csv.view.php', 'templates/footer.view.php'), $_vars); 
   }
   
   public function ejercicio03(){
       $_vars = array('titulo' => 'Histórico población Pontevedra',
                      'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
                      'csv_div_titulo' => 'Datos del CSV',
                        'columnasMostrar' => array(0, 3),
                      'js' => array('plugins/datatables/jquery.dataTables.min.js', 'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js', 'assets/js/pages/csv.view.js')
            );
                  
        $csvModel = new \Com\Daw2\Models\CSVModel(\Com\Daw2\Core\Config::getInstance()->get('DATA_FOLDER').'poblacion_pontevedra_2020_totales.csv');
        $_vars["data"] = $csvModel->getPoblacionPontevedra(); 
        if(count($_vars['data']) > 1 ){ //La primera fila son los nombres de columna
            $filaMax = $_vars["data"][1];
            $filaMin = $_vars["data"][1];
        }
        else{
            $filaMax = NULL;
            $filaMin = NULL;
        }     
        foreach($_vars["data"] as $fila){
            if($filaMin[3] > $fila[3] && is_numeric($fila[3])){
                $filaMin = $fila;
            }
            elseif($filaMax[3] < $fila[3] && is_numeric($fila[3])){
                $filaMax = $fila;
            }
        }        
        $_vars["filaMax"] = $filaMax;
        $_vars["filaMin"] = $filaMin;
        $this->view->showViews(array('templates/header.view.php', 'csv.footer.personalizado.view.php', 'templates/footer.view.php'), $_vars);   
   }
   
}