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

/**
 * Description of UsuarioSistemaController
 *
 * @author rgcenteno
 */
class UsuarioSistemaController extends \Com\Daw2\Core\BaseController{
    
    public function new(){
        $_vars = [
            'breadcumb' => array(
                        'Inicio' => array('url' => '#', 'active' => false),
                        'UsuariosSistema' => array('url' => './?controller=UsuarioSistema','active' => false),
                        'Insertar' => array('url' => '#','active' => true)),
                      'titulo' => 'Alta proveedor',
        ];
        if(!isset($_POST['submit'])){            
            $usuariosModel = new \Com\Daw2\Models\UsuarioSistemaModel();
            $_vars['roles'] = $usuariosModel->getAllRols();
            $this->view->showViews(array('templates/header.view.php', 'usuariosistema.edit.view.php', 'templates/footer.view.php'), $_vars);      
        }
        else{
            $_errors = $this->checkErrors($_POST);
            if(empty($_errors)){
                //Guardamos
            }
            else{
                $usuariosModel = new \Com\Daw2\Models\UsuarioSistemaModel();
                $_vars['errors'] = $_errors;
                $_vars['sanitized'] = $this->sanitizeInput($_POST);
                $_vars['roles'] = $usuariosModel->getAllRols();
                $this->view->showViews(array('templates/header.view.php', 'usuariosistema.edit.view.php', 'templates/footer.view.php'), $_vars);      
            }
        }
    }
    
    private function checkErrors(array $_data) : array{
        $_errors = [];
        $usuariosModel = new \Com\Daw2\Models\UsuarioSistemaModel();
        if(!filter_var($_data['email'], FILTER_VALIDATE_EMAIL)){
            $_errors['email'] = 'Inserte un email válido';
        }
        elseif(!empty($usuariosModel->getUsuarioSistemaByEmail($_data['email']))){
            $_errors['email'] = 'El usuario ya existe en la base de datos';
        }
        
        if(strlen(trim($_data['nombre'])) < 3){
            $_errors['nombre'] = 'El nombre debe tener al menos 3 caracteres visibles';
        }
        
        if(strlen($_data['password']) < 8){
            $_errors['password'] = 'El password debe tener al menos 8 caracteres';
        }
        else if(!preg_match(["/[a-zA-Z]/"], $_data['password']) || !preg_match(["/[0-9]/"], $_data['password'])){
            $_errors['password'] = 'El password debe tener al menos una letra y un número';
        }
        elseif($_data['password'] != $_data['password2']){
            $_errors['password'] = 'Las contraseñas no coinciden';
        }
        
        if(!$usuariosModel->checkIdRolExists($_data['id_rol'])){
            $_errors['id_rol'] = 'El rol seleccionado no existe';
        }
        return $_errors;
    }
    
    private function sanitizeInput(array $_data) : array{
        return filter_var_array($_data, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}
