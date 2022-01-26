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
    
    public function index(){
        $_vars = array('titulo' => 'Usuarios',
                      'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false),
                                           'Usuarios' => array('url' => '#', 'active' => false)),
                      'div_title' => 'Usuarios registrados',                      
            );
        $usuariosModel = new UsuariosModel();
        if(!isset($_GET['opcion'])){
            $_vars['data'] = $usuariosModel->getAllUsuarios();
        }
        else{
            if(!empty($_GET['tipo'])){
                $_vars['data'] = $usuariosModel->getUsuariosByRol($_GET['tipo']);
            }
            elseif(!empty($_GET['username'])){
                $_vars['data'] = $usuariosModel->getUsuariosByUsername($_GET['username']);
            }
            else{
                $_vars['data'] = $usuariosModel->getAllUsuarios();
            }
        }
        $_vars['roles'] = $usuariosModel->getRoles();
        $this->view->showViews(array('templates/header.view.php', 'usuarios.index.view.php', 'templates/footer.view.php'), $_vars);  
    }
    
}
