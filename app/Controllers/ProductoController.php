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
 * Description of TestController
 *
 * @author rafa
 */
class ProductoController extends \Com\Daw2\Core\BaseController{
   
    private static $_PAISES_VALIDOS = array('España', 'Portugal', 'Francia');
    /**
     * Sin emulado obtenemos que los números se reciben como float
     */
    public function index(?Mensaje $msg = NULL)
    {   
        if(Utils::contains($_SESSION['usuario']['permisos']['Proveedor'], 'r')){
            $_vars = array('titulo' => 'Productos',
                          'breadcumb' => array(
                            'Inicio' => array('url' => '#', 'active' => false),
                            'Producto' => array('url' => '#','active' => true)),
                           'msg' => $msg,
                          'Título' => 'Productos',
                          'js' => array('plugins/datatables/jquery.dataTables.min.js', 'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js', 'assets/js/pages/categoria.index.js')
                );
            $model =  new \Com\Daw2\Models\ProductoModel();    
            $_vars["data"] = $model->getAll();
            $_vars["categorias"] = $model->getCategorias();
            $this->view->showViews(array('templates/header.view.php', 'producto.view.php', 'templates/footer.view.php'), $_vars);   
            
            //Filtro
            
        }
        else{
            header("location: ./");
        }
    }   
    
    public function new(){
        if(Utils::contains($_SESSION['usuario']['permisos']['Proveedor'], 'w')){
            if(isset($_POST['action'])){
                $_errors = $this->checkForm($_POST);
                $saneado = $this->sanitizeForm($_POST);
                if(count($_errors) > 0){
                    $_vars = array(
                              'breadcumb' => array(
                                'Inicio' => array('url' => '#', 'active' => false),
                                'Proveedores' => array('url' => './?controller=proveedor','active' => false),
                                'Insertar' => array('url' => '#','active' => true)),
                              'titulo' => 'Alta proveedor',
                                'paises' => self::$_PAISES_VALIDOS,
                              'errors' => $_errors,
                              'edited' => (object) $saneado
                    );
                    $this->view->showViews(array('templates/header.view.php', 'proveedor.edit.view.php', 'templates/footer.view.php'), $_vars);      
                }
                else{
                    $model = new \Com\Daw2\Models\ProveedorModel();
                    $proveedor = new \Com\Daw2\Helpers\Proveedor($_POST['cif'], $saneado['codigo'], $saneado['nombre'], $saneado['direccion'], $_POST['website'], $_POST['pais'], $_POST['email']);
                    $proveedor->telefono = $_POST['telefono'];
                    if($model->insertProveedor($proveedor)){
                        $msj = new Mensaje('success', 'Éxito', 'El proveedor ha sido guardado con éxito');
                        $this->index();
                    }
                    else{
                        $_vars = array('titulo' => 'Insertar proveedor',
                              'breadcumb' => array(
                                'Inicio' => array('url' => '#', 'active' => false),
                                'Proveedores' => array('url' => './?controller=proveedor','active' => false),
                                'Insertar' => array('url' => '#','active' => true)),
                              'Título' => 'Alta proveedor',
                                'paises' => self::$_PAISES_VALIDOS,
                              'edited' => (object) $saneado,
                            'errors' => array('cif' => 'Hubo un error indeterminado al guardar')
                        );
                        $this->view->showViews(array('templates/header.view.php', 'proveedor.edit.view.php', 'templates/footer.view.php'), $_vars); 
                    }
                }
            }
            else{
                $_vars = array('titulo' => 'Insertar proveedor',
                              'breadcumb' => array(
                                'Inicio' => array('url' => '#', 'active' => false),
                                'Proveedores' => array('url' => './?controller=proveedor','active' => false),
                                'Insertar' => array('url' => '#','active' => true)),
                              'Título' => 'Alta proveedor',
                              'paises' => self::$_PAISES_VALIDOS,
                              'edited' => \Com\Daw2\Helpers\Proveedor::getStdClass()
                    );
                $this->view->showViews(array('templates/header.view.php', 'proveedor.edit.view.php', 'templates/footer.view.php'), $_vars);      
            }
        }
        else{
            header("location: ./");
        }
    }
    
    public function edit(){
        if(isset($_POST['action'])){
            if(Utils::contains($_SESSION['usuario']['permisos']['Proveedor'], 'w')){
                $_errors = $this->checkForm($_POST);
                $sanitizado = $this->sanitizeForm($_POST);
                if(count($_errors) > 0){
                    $model = new \Com\Daw2\Models\ProveedorModel();
                    $proveedor = $model->loadProveedor($_POST['old_cif']);
                    $_vars = array('titulo' => 'Edición de proveedor',
                              'breadcumb' => array(
                                'Inicio' => array('url' => '#', 'active' => false),
                                'Proveedores' => array('url' => './?controller=proveedor','active' => false),
                                'Edición' => array('url' => '#','active' => true)),
                              'Título' => 'Editar proveedor',
                                'paises' => self::$_PAISES_VALIDOS,
                              'errors' => $_errors,
                              'edited' => (object) $sanitizado,
                              'proveedorOriginal' => $proveedor
                    );
                    $this->view->showViews(array('templates/header.view.php', 'proveedor.edit.view.php', 'templates/footer.view.php'), $_vars);      
                }
                else{
                    $model = $model = new \Com\Daw2\Models\ProveedorModel();
                    $proveedor = new \Com\Daw2\Helpers\Proveedor($_POST['cif'], $sanitizado['codigo'], $sanitizado['nombre'], $sanitizado['direccion'], $_POST['website'], $_POST['pais'], $_POST['email']);
                    $proveedor->telefono = $_POST['telefono'];
                    if($model->editProveedor($proveedor, $_POST['old_cif'])){
                        $msj = new Mensaje('success', 'Éxito', 'El proveedor ha sido guardado con éxito');
                        $this->index($msj);
                    }
                    else{
                        $proveedor = $model->loadProveedor($_POST['old_cif']);
                        $_vars = array('titulo' => 'Edición de proveedor',
                              'breadcumb' => array(
                                'Inicio' => array('url' => '#', 'active' => false),
                                'Proveedores' => array('url' => './?controller=proveedor','active' => false),
                                'Edición' => array('url' => '#','active' => true)),
                              'Título' => 'Editar proveedor',
                                'paises' => self::$_PAISES_VALIDOS,
                              'errors' => $_errors,
                              'edited' => (object) $sanitizado,
                              'proveedorOriginal' => $proveedor
                                );
                        $this->view->showViews(array('templates/header.view.php', 'proveedor.edit.view.php', 'templates/footer.view.php'), $_vars); 
                    }
                }
            }
            else{
                header("location: ./");
            }
        }
        elseif(isset($_GET['cif'])){
            if(Utils::contains($_SESSION['usuario']['permisos']['Proveedor'], 'r')){
                $model = new \Com\Daw2\Models\ProveedorModel();
                $proveedor = $model->loadProveedor($_GET['cif']);
                if(!is_null($proveedor)){                
                    $_vars = array('titulo' => 'Edición de proveedor',
                                      'breadcumb' => array(
                                        'Inicio' => array('url' => '#', 'active' => false),
                                        'Proveedores' => array('url' => './?controller=proveedor','active' => false),
                                        'Edición' => array('url' => '#','active' => true)),
                                      'Título' => 'Editar proveedor',
                                      'paises' => self::$_PAISES_VALIDOS,
                                      'edited' => $proveedor,
                                      'proveedorOriginal' => $proveedor
                            );
                    $this->view->showViews(array('templates/header.view.php', 'proveedor.edit.view.php', 'templates/footer.view.php'), $_vars);    
                }
            }
            else{
                header("location: ./");
            }
        }
    }
    
    public function delete(){
        if(Utils::contains($_SESSION['usuario']['permisos']['Proveedor'], 'd')){
            $model = new \Com\Daw2\Models\ProveedorModel();
            $cif = filter_var($_GET['cif'], FILTER_SANITIZE_STRING);
            if(!empty($cif)){
                try{
                    if($model->delete($cif)){
                        $this->index(new Mensaje("success", "¡Eliminada!", "Proveedor borrada con éxito"));
                    }
                    else{
                        $this->index(new Mensaje("warning", "Sin cambios", "No se ha borrado el proveedor: $cif"));
                    }            
                }
                catch(\PDOException $ex){
                    if(strpos($ex->getMessage(), '1451') !== false){
                        $this->index(new Mensaje("danger", "No permitido", "Antes de borrar un proveedor debe editar o borrar todos sus productos."));
                    }
                    else{
                        $this->index(new Mensaje("danger", "No permitido", "PDOException: ".$ex->getMessage()));
                    }
                }
            }
            else{
                $this->index(new Mensaje("warning", "Petición incorrecta", "No se ha facilitado la categoría a borrar"));
            }
        }
        else{
            header("location: ./");
        }
    }
    
    private function checkForm(array $_data) : array{
        $_errors = array();
        
        $checkCif = self::checkCif($_data['cif']);
        if(!is_null($checkCif)){
            $_errors['cif'] = $checkCif;
        }
        else{
            if(empty($_data['old_cif'])){
                $model = new \Com\Daw2\Models\ProveedorModel();
                $proveedorAux = $model->loadProveedor($_data['cif']);
                if(!is_null($proveedorAux)){
                    $_errors['cif'] = "Ya existe un proveedor con ese cif";
                }
            }
            else{
                if($_data['old_cif'] !== $_data['cif']){
                    $model = new \Com\Daw2\Models\ProveedorModel();
                    $proveedorAux = $model->loadProveedor($_data['cif']);
                    if(!is_null($proveedorAux)){
                        $_errors['cif'] = "Ya existe un proveedor con ese cif";
                    }
                }
            }
        }
        
        
        $_campos = array(
            'codigo' => 10,
            'nombre' => 255,
            'direccion' => 255,
            'website' => 255,
            'email' => 255,
            'telefono' => 255
        );
        
        foreach($_campos as $key => $value){
            if(strlen($_data[$key]) > $value){
                $_errors[$key] = "El tamaño máximo permito es $value";
            }
            elseif(empty($_data[$key])){
                $_errors[$key] = "Inserte un texto";
            }
        }
        
        /*if(strlen($_data['codigo']) > 10){
            $_errors['codigo'] = "El tamaño máximo del código es 10.";
        }
        elseif(empty($_data['codigo'])){
            $_errors['codigo'] = "Inserte un código";
        }
        
        if(strlen($_data['nombre']) > 255){
            $_errors['nombre'] = "El tamaño máximo del nombre es 10.";
        }
        elseif(empty($_data['nombre'])){
            $_errors['nombre'] = "Inserte un nombre";
        }
        
        if(strlen($_data['direccion']) > 255){
            $_errors['direccion'] = "El tamaño máximo de la dirección es 255.";
        }
        elseif(empty($_data['direccion'])){
            $_errors['direccion'] = "Inserte un nombre";
        }*/
        
        if(!filter_var($_data['website'], FILTER_VALIDATE_URL)){
            $_errors['website'] = 'Debe insertar una URL válida';
        }
        if(!filter_var($_data['email'], FILTER_VALIDATE_EMAIL)){
            $_errors['email'] = 'Debe insertar un email válido';
        }
        if(!preg_match("/^[0-9]{9,12}$/", $_data['telefono'])){
            $_errors['telefono'] = 'Inserte un teléfono de tamaño entre 9 y 12 dígitos';
        }
        if(!in_array($_data['pais'], self::$_PAISES_VALIDOS)){
            $_errors['pais'] = 'País no válido';
        }
        return $_errors;
    }
    
    private static function checkCif(string $cif) : ?string{
        if(strlen($cif) != 9){
            return "La longitud del CIF debe ser de 9 caracteres";
        }
        elseif(!preg_match("/[A-S][0-9]{7}[A-Z0-9]/", $cif)){
            return "Formato del CIF: 'OPPNNNNNC'. O: Tipo de Organización  ; P: Código provincia  ; N: Número correlativo por provincia ; C: Dígito o letra de control. Recibido: ". $cif;
        }
        elseif($cif[1] == "0" && $cif[2] == 0){
            return "El código de provincia 00 no es válido.";
        }
        else{
            if($cif[0] == "K" || $cif[0] == "P" || $cif[0] == "Q" || $cif[0] == "S"){
                if(!preg_match("/[A-Z]/", $cif[8])){
                    return "Código de control no válido. Se esperaba una letra.";
                }
                elseif($cif[0] == "K" || $cif[0] == "P" || $cif[0] == "Q" || $cif[0] == "S"){
                    if(!is_numeric($cif[8])){
                        return "Código de control no válido. Se esperaba un número.";
                    }
                }
            }
        }
        return NULL;
    }
    
    private static function sanitizeForm(array $_data) : array{
        return filter_var_array($_data, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}