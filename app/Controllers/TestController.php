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
 * Description of TestController
 *
 * @author rafa
 */
class TestController extends \Com\Daw2\Core\BaseController{
   
    /**
     * Sin emulado obtenemos que los números se reciben como float
     */
    public function index()
    {                                 
        $_vars = array('titulo' => 'Test');
        $model = new \Com\Daw2\Models\TestModel();
        $_vars['usuarios'] = $model->getUsuariosClass();
        $this->view->showViews(array('templates/header.view.php', 'test.view.php', 'templates/footer.view.php'), $_vars);      
    }
   
    /**
     * Lo probamos en modo emulado y obtenemos que los números se reciben como string
     */
    public function testEmulated(){
        $options = array();
        $options[\PDO::ATTR_EMULATE_PREPARES] = true;
        $_vars = array('titulo' => 'Test Emulated');
        $model = new \Com\Daw2\Models\TestModel();
        $_vars['usuarios'] = $model->getUsuariosClass($options);
        $this->view->showViews(array('templates/header.view.php', 'test.view.php', 'templates/footer.view.php'), $_vars); 
    }
    
    public function testLimit(){
        $_vars = array('titulo' => 'Test Limit en execute');
        $model = new \Com\Daw2\Models\TestModel();
        $_vars['usuarios'] = $model->getUsuariosLimit(0, 5);
        $this->view->showViews(array('templates/header.view.php', 'test.view.php', 'templates/footer.view.php'), $_vars);
    }
    
    public function testLimitBind(){
        $_vars = array('titulo' => 'Test Limit Bind');
        $model = new \Com\Daw2\Models\TestModel();
        $_vars['usuarios'] = $model->getUsuariosLimitBind(0, 5);
        $this->view->showViews(array('templates/header.view.php', 'test.view.php', 'templates/footer.view.php'), $_vars);
    }
    
    public function testSearchActive(){
        if(isset($_GET['active'])){
            $aux = filter_var($_GET['active'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            if(!is_null($aux)){
                $active = $aux;
            }   
            else{
                $active = true;
            }            
        }
        else{
            $active = true;
        }
        $_vars = array('titulo' => 'Test Active: ' . ($active ? 'true' : 'false'));
        $model = new \Com\Daw2\Models\TestModel();
        $_vars['usuarios'] = $model->getUsuariosByActive($active);
        $this->view->showViews(array('templates/header.view.php', 'test.view.php', 'templates/footer.view.php'), $_vars);
    }
    
    public function testOrderBy(){
        if(isset($_GET['asc'])){
            $aux = filter_var($_GET['asc'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            if(!is_null($aux)){
                $asc = $aux;
            }   
            else{
                $asc = true;
            }            
        }
        else{
            $asc = true;
        }
        $order = isset($_GET['order']) ? $_GET['order'] : "";                    
        $_vars = array('titulo' => 'Test Order: ' . $order . ' ' . ( $asc ? 'ASC' : 'DESC'));
        $model = new \Com\Daw2\Models\TestModel();
        $_vars['usuarios'] = $model->getUsuarioOrderBy($order, $asc);
        $this->view->showViews(array('templates/header.view.php', 'test.view.php', 'templates/footer.view.php'), $_vars);
    }
    
    public function updateUsuarioSalar(){
        $username = 'Alexis_Jose_da_Silva_Pereira';
        $salar = rand(1000, 5000);
        $_vars = array('titulo' => 'Update salario usuario');
        $model = new \Com\Daw2\Models\TestModel();
        $_vars['usuariosUpdated'] = $model->updateSalarUsuario($username, $salar);
        $this->view->showViews(array('templates/header.view.php', 'test.update.view.php', 'templates/footer.view.php'), $_vars);
    }
    
    public function deleteUsuarios(){
        $username = 'Benjam__n';        
        $_vars = array('titulo' => 'Borrar usuarios con nombre like '.$username);
        $model = new \Com\Daw2\Models\TestModel();
        $_vars['usuariosUpdated'] = $model->deleteUsuariosByName($username);
        $this->view->showViews(array('templates/header.view.php', 'test.update.view.php', 'templates/footer.view.php'), $_vars);
    }
    
    public function rellenarAleatorio(){
        $_vars = array('titulo' => 'Test Limit Bind');
        $model = new \Com\Daw2\Models\TestModel();
        $_vars['usuarios'] = $model->rellenarAleatorio();
        $this->view->showViews(array('templates/header.view.php', 'test.view.php', 'templates/footer.view.php'), $_vars);
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
            
            $model = new \Com\Daw2\Models\TestModel();
            $_vars['id'] = $model->insertCategoria($nombre, $idPadre);            
            
            $this->view->showViews(array('templates/header.view.php', 'test.insert.view.php', 'templates/footer.view.php'), $_vars);
        }        
        
    }
    
    public function generateProveedores(){
        $cantidad = 99;
        $model = new \Com\Daw2\Models\ProveedorModel();
        for($i = 0; $i < $cantidad; $i++){
            $char = chr(65 + ($i % 10));
            echo $char;
            $charFinal = chr(65 + ($i % 26));
            $cif = $char .rand(1,9). str_pad(($i+1), 6, '0', STR_PAD_LEFT) . $charFinal;
            $codigo = "PROV".str_pad(($i+1), 6, '0', STR_PAD_LEFT);
            $proveedor = "PROVEEDOR ".str_pad(($i+1), 6, '0', STR_PAD_LEFT);
            $proveedor = new \Com\Daw2\Helpers\Proveedor($cif, $codigo, $proveedor, "Calle Test Num. ". random_int(1, 999), 'http://test.org', 'España', 'proveedor'.$i.'@test.org');
            $model->insertProveedorObject($proveedor);
        }
    }
    
    public function generateProductos(){
        $modelProveedores = new \Com\Daw2\Models\ProveedorModel();
        $_proveedores = $modelProveedores->getAll();
        $modelCategorias = new \Com\Daw2\Models\CategoriaModel();
        $_categorias = $modelCategorias->getAllCategorias();
        $productosModel = new \Com\Daw2\Models\ProductoModel();
        $cantidad = 1027;
        $_marcas = ['Apple', 'Nintendo', 'Sony', 'Xiaomi', 'Google', 'LG', 'Samsung', 'Microsoft', 'IBM', 'Hitachi', 'Dell', 'Oppo', 'HP', 'Acer', 'MSI', 'Asus'];
        $_modelos = ['Mega', 'S', 'X', 'High', 'Series X', 'Series S', 'Reno', 'Max', 'Lite'];
        $descripción = "Inserte una descripción";
        for($i = 0; $i < $cantidad; $i++){
            $coste = random_int(1, 500);
            $margen = (rand(1, 100) * 0.03) + 1;
            $stock = random_int(50, 300);
            $iva = 21;
            $indexMarca = random_int(0, count($_marcas)-1);
            $indexModelo = random_int(0, count($_modelos)-1);
            $codigoModelo = random_int(1, 99);
            $indexProveedor = random_int(0, count($_proveedores) - 1);
            $indexCategoria = random_int(0, count($_categorias) - 1);
            $nombre = $_marcas[$indexMarca]." - ".$_modelos[$indexModelo].$codigoModelo;
            $codigo = strtoupper(substr($_marcas[$indexMarca], 0, 3)). str_pad($i, 7, 0, STR_PAD_LEFT);
            $pr = new \Com\Daw2\Helpers\Producto($codigo, $nombre, $descripción, $_proveedores[$indexProveedor], $_categorias[$indexCategoria], $stock, $coste, $margen, $iva);
            $productosModel->insertProducto($pr);
        }
    }
}
