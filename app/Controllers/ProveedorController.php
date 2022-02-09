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

use \Com\Daw2\Helpers\Mensaje;
/**
 * Description of TestController
 *
 * @author rafa
 */
class ProveedorController extends \Com\Daw2\Core\BaseController{
   
    /**
     * Sin emulado obtenemos que los números se reciben como float
     */
    public function index(?Mensaje $msg = NULL)
    {                                 
        $_vars = array('titulo' => 'Proveedores',
                      'breadcumb' => array(
                        'Inicio' => array('url' => '#', 'active' => false),
                        'Proveedores' => array('url' => '#','active' => true)),
                       'msg' => $msg,
                      'Título' => 'Proveedores',
                      'js' => array('plugins/datatables/jquery.dataTables.min.js', 'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js', 'assets/js/pages/categoria.index.js')
            );
        $model =  new \Com\Daw2\Models\ProveedorModel();    
        $_vars["data"] = $model->getAll();
        $this->view->showViews(array('templates/header.view.php', 'proveedor.index.php', 'templates/footer.view.php'), $_vars);      
    }   
}