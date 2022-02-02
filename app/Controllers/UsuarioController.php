<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

namespace Com\Daw2\Controllers;

use Com\Daw2\Models\UsuariosModel;

/**
 * Description of UsuarioController
 *
 * @author rgcenteno
 */
class UsuarioController extends \Com\Daw2\Core\BaseController{
    
    private static $tamPag = 25;
    
    private static $_ORDER_COLUMS = array('username', 'rol', 'salarioBruto', 'retencionIRPF');
    
    public function index(){
        $_vars = array('titulo' => 'Usuarios',
                      'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false),
                                           'Usuarios' => array('url' => '#', 'active' => false)),
                      'div_title' => 'Usuarios registrados',
                      'url' => $this->generateCleanUrl()
            );
        $usuariosModel = new UsuariosModel();
        //Validamos y mapeamos la petición int de la vista para que la entienda el modelo        
        
        if(isset($_GET['order']) && filter_var($_GET['order'], FILTER_VALIDATE_INT) && $_GET['order'] < count(self::$_ORDER_COLUMS)){
             $order = self::$_ORDER_COLUMS[$_GET['order']];             
             $orderInt = $_GET['order'];
        }
        else{
            $order = self::$_ORDER_COLUMS[0];
            $orderInt = 0;
        }
        
        //Validamos el sentido recibido por la vista
        if(isset($_GET['sentido']) && ($_GET['sentido'] === 'asc' || $_GET['sentido'] === 'desc')){
            $sentido = $_GET['sentido'];
        }
        else{
            $sentido = "ASC";
        } 
        
        //Seleccionamos la página a cargar
        if(isset($_GET['pag']) && filter_var($_GET['pag'], FILTER_VALIDATE_INT) && (int)$_GET['pag'] >= 1){
            $pag = (int)$_GET['pag'];
        }
        else{
            $pag = 1;
        }
        
        $_vars['order'] = $orderInt;
        $_vars['sentido'] = $sentido;
        $_filtros = $this->generateFilterArray($_GET);
        $_vars['data'] = $usuariosModel->getUsuariosByFilters($_filtros, $order, $sentido, $pag, self::$tamPag);
        $_vars['roles'] = $usuariosModel->getRoles();
        $_vars['pag'] = $pag;
        $total = $usuariosModel->getCountUsuariosByFilter($_filtros);
        
        $numPaginas = ceil($total / self::$tamPag);  
        $_vars['total'] = $total;
        $_vars['numPaginas'] = $numPaginas;
        
        $this->view->showViews(array('templates/header.view.php', 'usuarios.index.view.php', 'templates/footer.view.php'), $_vars);  
    }
    
    private function generateFilterArray(array $_filtros) : array{
        $_filters = [];
        if(!empty($_filtros['tipo'])){
            $_filters['rol'] = $_filtros['tipo'];
        }
        if(!empty($_filtros['username'])){
            $_filters['username'] = $_filtros['username'];
        }
        if(isset($_filtros['min']) && filter_var($_filtros['min'], FILTER_VALIDATE_FLOAT)){
            $_filters['min_salar'] = (float) $_filtros['min'];
        }
        if(isset($_filtros['max']) && filter_var($_filtros['max'], FILTER_VALIDATE_FLOAT)){
            $_filters['max_salar'] = (float) $_filtros['max'];
        }
        if(isset($_filtros['min_cotizacion']) && filter_var($_filtros['min_cotizacion'], FILTER_VALIDATE_INT)){
            $_filters['min_irpf'] = (int) $_filtros['min_cotizacion'];
        }
        if(isset($_filtros['max_cotizacion']) && filter_var($_filtros['max_cotizacion'], FILTER_VALIDATE_INT)){
            $_filters['max_irpf'] = (int) $_filtros['max_cotizacion'];
        }
        return $_filters;
    }
    
    private function generateCleanUrl() : string{
        $_vars = [];
        foreach($_GET as $key => $value){
            if($key !== 'order' && $key !== 'sentido'){
                $_vars[] = $key.'='.$value;
            }
        }
        $url = "./?" . implode("&", $_vars);
        return $url;
    }
    
}
