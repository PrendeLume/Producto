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
class CategoriaController extends \Com\Daw2\Core\BaseController{
   
    /**
     * Sin emulado obtenemos que los números se reciben como float
     */
    public function index(?Mensaje $msg = NULL)
    {                                 
        $_vars = array('titulo' => 'Categorías',
                      'breadcumb' => array(
                        'Inicio' => array('url' => '#', 'active' => false),
                        'Categorias' => array('url' => '#','active' => true)),
                       'msg' => $msg,
                      'Título' => 'Categorías',
                      'js' => array('plugins/datatables/jquery.dataTables.min.js', 'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js', 'assets/js/pages/categoria.index.js')
            );
        $model =  new \Com\Daw2\Models\CategoriaModel();      
        $_vars["data"] = $model->getAllCategorias();
        $this->view->showViews(array('templates/header.view.php', 'categoria.index.php', 'templates/footer.view.php'), $_vars);      
    }      
    
    public function insertCategoria(){
        if(isset($_GET['id_padre'])){
            $idPadre = filter_var($_GET['id_padre'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
            if(!is_null($idPadre) && $idPadre <= 0){
                $idPadre = NULL;
            }               
        }
        else{
            $idPadre = NULL;
        }
        if(!isset($_GET['nombre']) ||empty($_GET['nombre'])){            
            throw new \Exception("Se debe insertar el nombre de la categoría");
        }        
        else{
            $_vars = array('titulo' => 'Insertar categoría');
            $nombre = filter_var($_GET['nombre'], FILTER_SANITIZE_STRING);
            $_vars['nombre'] = $nombre;
            
            $model = new \Com\Daw2\Models\CategoriaModel();
            $_vars['id'] = $model->insertCategoria($nombre, $idPadre);            
            
            $this->view->showViews(array('templates/header.view.php', 'categoria.insert.view.php', 'templates/footer.view.php'), $_vars);
        }        
        
    }    
    
    public function insertCategoriaObject(){
        if(isset($_GET['id_padre'])){
            $idPadre = filter_var($_GET['id_padre'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
            if(!is_null($idPadre) && $idPadre <= 0){
                $idPadre = NULL;
            }               
        }
        else{
            $idPadre = NULL;
        }
        if(!isset($_GET['nombre']) ||empty($_GET['nombre'])){            
            throw new \Exception("Se debe insertar el nombre de la categoría");
        }        
        else{
            $_vars = array('titulo' => 'Insertar categoría Object');
            $nombre = filter_var($_GET['nombre'], FILTER_SANITIZE_STRING);
            $_vars['nombre'] = $nombre;
            
            $model = new \Com\Daw2\Models\CategoriaModel();
            $categoria = new \Com\Daw2\Helpers\Categoria(NULL, is_null($idPadre) ? NULL : $model->loadCategoria($idPadre), $nombre);
                        
            $_vars['categoria'] = $model->insertCategoriaObject($categoria);            
            
            $this->view->showViews(array('templates/header.view.php', 'categoria.insert.view.php', 'templates/footer.view.php'), $_vars);
        }        
        
    }
    
    public function new(){
        $model = new \Com\Daw2\Models\CategoriaModel();
        if(!isset($_POST['action'])){
            $categoria = \Com\Daw2\Helpers\Categoria::getStdClass();
            $categoriasList = $model->getAllCategorias();
            //var_dump($categoriasList);
            $_vars = array(
                'titulo' => 'Alta categoría', 
                'categoria' => $categoria,
                'categoriaEdit' => $categoria,
                'idPadre' => !is_null($categoria->padre) ? $categoria->padre->id : NULL,
                'categoriasList' => $categoriasList,
                'breadcumb' => array(
                    'Inicio' => array('url' => '#', 'active' => false),
                    'Categoria' => array('url' => '?controller=categoria','active' => false),
                    'Nueva' => array('url' => '#', 'active' => true))
                );
            $this->view->showViews(array('templates/header.view.php', 'categoria.edit.view.php', 'templates/footer.view.php'), $_vars);
        }
        elseif($_POST['action'] == 'guardar'){
            $_errors = $this->checkForm($_POST, false);
            
            if(count($_errors) === 0){
                $padre = ($_POST['id_padre'] > 0) ? $model->loadCategoria($_POST['id_padre']) : NULL;
                $categoria = new \Com\Daw2\Helpers\Categoria(NULL, $padre, filter_var($_POST['nombre'], FILTER_SANITIZE_SPECIAL_CHARS));
                $categoria = $model->insertCategoriaObject($categoria);                 
                $this->index();
            }
            else{                                
                $std = $this->sanitizeForm($_POST);
                $categoriasList = $model->getAllCategorias();
                //var_dump($categoriasList);
                $_vars = array(
                    'titulo' => 'Alta categoría' , 
                    'categoria' => $std,
                    'categoriaEdit' => $std,
                    'errors' => $_errors,
                    'idPadre' => isset($std->id_padre) ? $std->id_padre : NULL,
                    'categoriasList' => $categoriasList,
                    'breadcumb' => array(
                        'Inicio' => array('url' => '#', 'active' => false),
                        'Categoria' => array('url' => '?controller=categoria','active' => false),
                        'Nueva' => array('url' => '#', 'active' => true))
                    );

                $this->view->showViews(array('templates/header.view.php', 'categoria.edit.view.php', 'templates/footer.view.php'), $_vars);
            }
        }
    }
    
    public function edit(){        
        $model = new \Com\Daw2\Models\CategoriaModel();
        if(isset($_GET['id_categoria'])){
            $idCategoria = filter_var($_GET['id_categoria'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
            if(!is_null($idCategoria)){                
                $categoria = $model->loadCategoria($idCategoria);
                $categoriasList = $model->getAllCategorias();
                //var_dump($categoriasList);
                $_vars = array(
                    'titulo' => 'Editar categoría: '.htmlentities($categoria->getFullName()) , 
                    'categoria' => $categoria,
                    'categoriaEdit' => $categoria,
                    'idPadre' => !is_null($categoria->padre) ? $categoria->padre->id : NULL,
                    'categoriasList' => $categoriasList,                    
                    'breadcumb' => array(
                        'Inicio' => array('url' => '#', 'active' => false),
                        'Categoria' => array('url' => '?controller=categoria','active' => false),
                        'Editar' => array('url' => '#', 'active' => true)),                    
                    );
                $this->view->showViews(array('templates/header.view.php', 'categoria.edit.view.php', 'templates/footer.view.php'), $_vars);
            }
            else{
                //Si la petición es incorrecta o han dado a cancelar, recargamos el listado
                $this->index(new Mensaje('danger', '400. Bad request', 'No se ha solicitado correctamente la categoría a editar'));
            }
        }
        elseif(isset($_POST['action']) && $_POST['action'] === 'guardar'){
            $_errors = $this->checkForm($_POST);
            
            if(count($_errors) === 0){
                $padre = ($_POST['id_padre'] > 0) ? $model->loadCategoria($_POST['id_padre']) : NULL;
                $categoria = new \Com\Daw2\Helpers\Categoria($_POST['id_categoria'], $padre, filter_var($_POST['nombre'], FILTER_SANITIZE_SPECIAL_CHARS));
                $model->updateCategoriaObject($categoria);                 
                $this->index(new Mensaje('success', 'Editada correctamente', 'Categoría: '.$categoria->getFullName().' editada correctamente'));
            }
            else{
                if(!isset($_errors['id_categoria'])){
                    $model = new \Com\Daw2\Models\CategoriaModel();
                    $categoria = $model->loadCategoria($_POST['id_categoria']);
                    $std = $this->sanitizeForm($_POST);
                    $categoriasList = $model->getAllCategorias();
                    //var_dump($categoriasList);
                    $_vars = array(
                        'titulo' => 'Editar categoría: '.htmlentities($categoria->getFullName()) , 
                        'categoria' => $categoria,
                        'categoriaEdit' => $std,
                        'errors' => $_errors,
                        'idPadre' => isset($std->id_padre) ? $std->id_padre : NULL,
                        'categoriasList' => $categoriasList,
                        'breadcumb' => array(
                            'Inicio' => array('url' => '#', 'active' => false),
                            'Categoria' => array('url' => '?controller=categoria','active' => false),
                            'Editar' => array('url' => '#', 'active' => true))
                        );
                    
                    $this->view->showViews(array('templates/header.view.php', 'categoria.edit.view.php', 'templates/footer.view.php'), $_vars);
                }
                else{
                    $this->new();
                }
                
            }
        }
        else{
            //Si la petición es incorrecta o han dado a cancelar, recargamos el listado
            $this->index();
        }
    }
    
    public function delete() : void{
        $model = new \Com\Daw2\Models\CategoriaModel();
        $id = filter_var($_GET['id_categoria'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if(!is_null($id)){
            try{
                if($model->deleteCategoria($id)){
                    $this->index(new Mensaje("success", "¡Eliminada!", "Categoría borrada con éxito"));
                }
                else{
                    $this->index(new Mensaje("warning", "Sin cambios", "No se ha borrado la categoría: $id"));
                }            
            }
            catch(\PDOException $ex){
                if(strpos($ex->getMessage(), '1451') !== false){
                    $this->index(new Mensaje("danger", "No permitido", "Antes de borrar una categoría debe editar o borrar todas las categorías hijas."));
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
    
    private function checkForm(array $_data, bool $isEditing = true) : array{
        $model = new \Com\Daw2\Models\CategoriaModel();
        $_errors = [];
        $idPadre = filter_var($_data['id_padre'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if(is_null($idPadre)){
            $_errors['id_padre'] = 'Ha insertado un valor inválido como categoría padre.';
        }
        else{
            if($idPadre > 0){
                $categoriaPadre = $model->loadCategoria($idPadre);
                if(is_null($categoriaPadre)){
                    $_errors['id_padre'] = 'El padre seleccionado no existe.';
                }
            }
        }
        if(empty(trim($_data['nombre']))){
            $_errors['nombre'] = 'Inserte un nombre de categoría';
        }
        $idCategoria = filter_var($_data['id_categoria'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if($isEditing){
            if(is_null($idCategoria)){
                $_errors['name'] = "Error en la petición, inténtelo de nuevo";
            }
            else{
                $categoria = $model->loadCategoria($idCategoria);
                if(is_null($categoria)){
                    $_errors['name'] = "Error en la petición, la categoría no existe";
                }
            }
            if($idPadre === $idCategoria){
                $_errors['id_padre'] = 'La categoría no puede ser padre de si misma.';
            }
        }    
        return $_errors;
    }
    
    private function sanitizeForm(array $_data) : \stdClass{
        $element = new \stdClass();
        foreach($_data as $key => $value){
            $element->$key = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        $element->id = $element->id_categoria;
        return $element;
    }
}
