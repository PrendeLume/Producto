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
use \Com\Daw2\Helpers\Utils;

/**
 * Description of UsuarioSistemaController
 *
 * @author rgcenteno
 */
class UsuarioSistemaController extends \Com\Daw2\Core\BaseController{
    
    public function index(?Mensaje $msg = NULL)
    {  
        if(Utils::contains($_SESSION['usuario']['permisos']['UsuarioSistema'], 'r')){
            $_vars = array('titulo' => 'Usuarios sistema',
                          'breadcumb' => array(
                            'Inicio' => array('url' => '#', 'active' => false),
                            'Usuarios sistema' => array('url' => '#','active' => true)),
                           'msg' => $msg,
                          'js' => array('plugins/datatables/jquery.dataTables.min.js', 'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js', 'assets/js/datatable.loader.js')
                );
            $model =  new \Com\Daw2\Models\UsuarioSistemaModel();      
            $_vars["data"] = $model->getAllUsuarioSistema();
            $this->view->showViews(array('templates/header.view.php', 'usuariosistema.index.php', 'templates/footer.view.php'), $_vars);      
        }
        else{
            header("location: index.php");
        }
    }      
    
    public function new(){   
        if(strpos($_SESSION['usuario']['permisos']['UsuarioSistema'], 'w') !== false){
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
                    $usuariosModel = new \Com\Daw2\Models\UsuarioSistemaModel();
                    $exito = $usuariosModel->insertUsuarioSistema($_POST['email'], $_POST['nombre'], $_POST['id_rol'], $_POST['password']);
                    if($exito){
                        header('location: ./?controller=usuarioSistema');
                    }
                    else{
                        $_vars['errors'] = array('nombre' => 'Error indeterminado al guardar');
                        $_vars['sanitized'] = $this->sanitizeInput($_POST);
                        $_vars['roles'] = $usuariosModel->getAllRols();
                        $this->view->showViews(array('templates/header.view.php', 'usuariosistema.edit.view.php', 'templates/footer.view.php'), $_vars); 
                    }
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
        else{
            header("location: ./");
        }
    }
    
    public function edit(){
        echo 'Pendiente de hacer';
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
        
        if(!preg_match("/^[A-Za-z0-9]{3,}$/", $_data['nombre'])){
            $_errors['nombre'] = 'El nombre debe tener al menos 3 caracteres. Sólo se permiten letras y numeros';
        }
        
        if(strlen($_data['password']) < 8){
            $_errors['password'] = 'El password debe tener al menos 8 caracteres';            
        }
        else if(!preg_match("/[a-zA-Z]/", $_data['password']) || !preg_match("/[0-9]/", $_data['password'])){
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
    
    public function login(){
        if(isset($_SESSION['usuario'])){
            header('location: ./');
            die;
        }
        elseif(!isset($_POST['login'])){
            $this->view->showViews(array('login.view.php'), []);      
        }
        else{
            $_errors = $this->checkErrorsLogin($_POST);
            if(count($_errors) == 0){
                $usuariosModel = new \Com\Daw2\Models\UsuarioSistemaModel();
                $_usuario = $usuariosModel->login($_POST['email'], $_POST['password']);
                if(is_null($_usuario)){
                    //Error
                    $_errors['email'] = 'Datos de acceso incorrectos';
                    $this->view->showViews(array('login.view.php'), ['errors' => $_errors, 'email' => htmlspecialchars($_POST['email'])]);      
                }
                else{
                    //Caso de éxito
                    $_SESSION['usuario'] = $_usuario;   
                    header('location: ./index.php');
                    die;
                }
            }
            else{
                $_errors['email'] = 'Inserte un email';
                $this->view->showViews(array('login.view.php'), ['errors' => $_errors, 'email' => htmlspecialchars($_POST['email'])]);
            }
        }
  
    }
    
    public function logout(){
        session_destroy();
        header('location: ./index.php');
    }
    
    private function checkErrorsLogin(array $_data) : array{
        $_errors = [];
        if(!filter_var($_data['email'], FILTER_VALIDATE_EMAIL)){
            $_errors['email'] = 'Inserte un email válido';
        }
        return $_errors;
    }
}
