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
class ProductoController extends \Com\Daw2\Core\BaseController
{


    private static $tamPag = 100;

    private static $_ORDER_COLUMS = array('codigo', 'nombre', 'proveedor', 'nombre_categoria', 'stock');
    /**
     * Sin emulado obtenemos que los números se reciben como float
     */
    public function index(?Mensaje $msg = NULL)
    {
        if (Utils::contains($_SESSION['usuario']['permisos']['Producto'], 'r')) {
            $_vars = array(
                'titulo' => 'Productos',
                'breadcumb' => array(
                    'Inicio' => array('url' => '#', 'active' => false),
                    'Producto' => array('url' => '#', 'active' => true)
                ),
                'msg' => $msg,
                'Título' => 'Productos',
                'url' => $this->generateCleanUrl(),
                'urlPagina' => $this->generateCleanUrlPaginador()
                //'js' => array('plugins/datatables/jquery.dataTables.min.js', 'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js', 'assets/js/pages/categoria.index.js')
            );
            $model = new \Com\Daw2\Models\ProductoModel();
            $_vars["categorias"] = $model->getCategorias();
            if (isset($_GET['action'])) {
                $_GET['action'] = 'index';
            }
            $_vars["proveedores"] = $model->getProveedor();

            if (isset($_GET['order']) && filter_var($_GET['order'], FILTER_VALIDATE_INT) && $_GET['order'] < count(self::$_ORDER_COLUMS)) {
                $order = self::$_ORDER_COLUMS[$_GET['order']];
                $orderInt = $_GET['order'];
            } else {
                $order = self::$_ORDER_COLUMS[0];
                $orderInt = 0;
            }

            //Validamos el sentido recibido por la vista
            if (isset($_GET['sentido']) && ($_GET['sentido'] === 'asc' || $_GET['sentido'] === 'desc')) {
                $sentido = $_GET['sentido'];
            } else {
                $sentido = "ASC";
            }

            //Seleccionamos la página a cargar
            if (isset($_GET['pag']) && filter_var($_GET['pag'], FILTER_VALIDATE_INT) && (int)$_GET['pag'] >= 1) {
                $pag = (int)$_GET['pag'];
            } else {
                $pag = 1;
            }

            $_vars['order'] = $orderInt;
            $_vars['sentido'] = $sentido;
            $_vars['pag'] = $pag;

            $total = $model->getCountUsuariosByFilter($_GET);
            $_vars["data"] = $model->getAllFilter($_GET, $order, $sentido, $pag, self::$tamPag);
            $numPaginas = ceil($total / self::$tamPag);
            $_vars['total'] = $total;
            $_vars['numPaginas'] = $numPaginas;

            $this->view->showViews(array('templates/header.view.php', 'producto.view.php', 'templates/footer.view.php'), $_vars);
        } else {
            header("location: ./");
        }
    }

    public function new()
    {
        if (Utils::contains($_SESSION['usuario']['permisos']['Producto'], 'w')) {

            $model = new \Com\Daw2\Models\ProductoModel();
            if (isset($_POST['gardar'])) {
                $_errors = $this->checkForm($_POST);

                $sanitizado = $this->sanitizeForm($_POST);
                if (count($_errors) > 0) {
                    $_vars = array(
                        'breadcumb' => array(
                            'Inicio' => array('url' => '#', 'active' => false),
                            'Producto' => array('url' => './?controller=producto', 'active' => false),
                            'Insertar' => array('url' => '#', 'active' => true)
                        ),
                        'titulo' => 'Alta producto',
                        'errors' => $_errors,
                        'data' => $sanitizado
                    );

                    $_vars["proveedores"] = $model->getProveedor();

                    $_vars["categorias"] = $model->getCategorias();
                    $this->view->showViews(array('templates/header.view.php', 'producto.insert.view.php', 'templates/footer.view.php'), $_vars);
                } else {
                    $model = new \Com\Daw2\Models\ProductoModel();
                    $producto = array('codigo' => $_POST['codigo'], 'nombre' => $sanitizado['nombre'], 'descripcion' => $sanitizado['descripcion'], 'coste' => $sanitizado['coste'], 'margen' => $_POST['margen'], 'stock' => $_POST['stock'], 'iva' => $_POST['iva'], 'tipoProveedor' => $sanitizado['proveedor'], 'tipoCategoria' => $sanitizado['categoria']);

                    if ($model->insertProducto($producto)) {
                        $msj = new Mensaje('success', 'Éxito', 'El producto ha sido guardado con éxito');
                        $this->index($msj);
                    } else {
                        $_vars = array(
                            'titulo' => 'Insertar producto',
                            'breadcumb' => array(
                                'Inicio' => array('url' => '#', 'active' => false),
                                'Producto' => array('url' => './?controller=producto', 'active' => false),
                                'Insertar' => array('url' => '#', 'active' => true)
                            ),
                            'Título' => 'Alta producto',
                            'data' => $sanitizado,
                            'errors' => array('codigo' => 'Hubo un error indeterminado al guardar')
                        );

                        $_vars["proveedores"] = $model->getProveedor();

                        $_vars["categorias"] = $model->getCategorias();
                        $this->view->showViews(array('templates/header.view.php', 'producto.insert.view.php', 'templates/footer.view.php'), $_vars);
                    }
                }
            } else {
                $_vars = array(
                    'titulo' => 'Insertar producto',
                    'breadcumb' => array(
                        'Inicio' => array('url' => '#', 'active' => false),
                        'Producto' => array('url' => './?controller=producto', 'active' => false),
                        'Insertar' => array('url' => '#', 'active' => true)
                    ),
                    'Título' => 'Alta producto',
                );

                $_vars["proveedores"] = $model->getProveedor();

                $_vars["categorias"] = $model->getCategorias();
                $this->view->showViews(array('templates/header.view.php', 'producto.insert.view.php', 'templates/footer.view.php'), $_vars);
            }
        } else {
            header("location: ./");
        }
    }

    public function edit()
    {
        if (isset($_POST['gardar'])) {

            if (Utils::contains($_SESSION['usuario']['permisos']['Producto'], 'w')) {
                $_errors = $this->checkForm($_POST);
                $sanitizado = $this->sanitizeForm($_POST);
                $model = new \Com\Daw2\Models\ProductoModel();
                if (count($_errors) > 0) {

                    $old_producto = $model->cargarProducto($_POST['old_codigo']);
                    $_vars = array(
                        'titulo' => 'Edición de producto',
                        'breadcumb' => array(
                            'Inicio' => array('url' => '#', 'active' => false),
                            'Producto' => array('url' => './?controller=producto', 'active' => false),
                            'Edición' => array('url' => '#', 'active' => true)
                        ),
                        'Título' => 'Editar producto',
                        'errors' => $_errors,
                        'data' => $sanitizado,
                        'productoOriginal' => $old_producto
                    );
                    $_vars["proveedores"] = $model->getProveedor();

                    $_vars["categorias"] = $model->getCategorias();
                    $producto = $model->cargarProducto($_POST['old_codigo']);
                    $this->view->showViews(array('templates/header.view.php', 'producto.edit.view.php', 'templates/footer.view.php'), $_vars);
                } else {
                    $producto = array('codigo' => $_POST['codigo'], 'nombre' => $sanitizado['nombre'], 'descripcion' => $sanitizado['descripcion'], 'coste' => $sanitizado['coste'], 'margen' => $_POST['margen'], 'stock' => $_POST['stock'], 'iva' => $_POST['iva'], 'tipoProveedor' => $sanitizado['proveedor'], 'tipoCategoria' => $sanitizado['categoria']);

                    $old_producto = $model->cargarProducto($_POST['old_codigo']);
                    if ($model->editProducto($producto, $_POST['old_codigo'])) {
                        $msj = new Mensaje('success', 'Éxito', 'El producto ha sido guardado con éxito');
                        $this->index($msj);
                    } else {
                        $producto = $model->cargarProducto($_POST['old_codigo']);
                        $_vars = array(
                            'titulo' => 'Edición de producto',
                            'breadcumb' => array(
                                'Inicio' => array('url' => '#', 'active' => false),
                                'Producto' => array('url' => './?controller=producto', 'active' => false),
                                'Edición' => array('url' => '#', 'active' => true)
                            ),
                            'Título' => 'Editar producto',
                            'errors' => $_errors,
                            'data' => $sanitizado,
                            'productoOriginal' => $old_producto
                        );

                        $_vars["proveedores"] = $model->getProveedor();

                        $_vars["categorias"] = $model->getCategorias();
                        $this->view->showViews(array('templates/header.view.php', 'producto.edit.view.php', 'templates/footer.view.php'), $_vars);
                    }
                }
            } else {
                header("location: ./");
            }
        } elseif (isset($_GET['codigo'])) {
            if (Utils::contains($_SESSION['usuario']['permisos']['Producto'], 'r')) {
                $model = new \Com\Daw2\Models\ProductoModel();
                $producto = $model->cargarProducto($_GET['codigo']);
                if (!empty($producto)) {
                    $_vars = array(
                        'titulo' => 'Edición de producto',
                        'breadcumb' => array(
                            'Inicio' => array('url' => '#', 'active' => false),
                            'Productos' => array('url' => './?controller=producto', 'active' => false),
                            'Edición' => array('url' => '#', 'active' => true)
                        ),
                        'Título' => 'Editar producto',
                        'data' => $producto,
                        'productoOriginal' => $producto
                    );
                    $_vars["proveedores"] = $model->getProveedor();

                    $_vars["categorias"] = $model->getCategorias();
                    $this->view->showViews(array('templates/header.view.php', 'producto.edit.view.php', 'templates/footer.view.php'), $_vars);
                }
            } else {
                header("location: ./");
            }
        }
    }

    public function delete()
    {
        if (Utils::contains($_SESSION['usuario']['permisos']['Producto'], 'd')) {
            $model = new \Com\Daw2\Models\ProductoModel();
            $codigo = filter_var($_GET['codigo_del'], FILTER_SANITIZE_STRING);
            if (!empty($codigo)) {
                try {

                    if ($model->delete($codigo)) {
                        $this->index(new Mensaje("success", "¡Eliminada!", "Producto borrada con éxito"));

                        header("location: ./?controller=producto&action=index");
                        die;
                    } else {
                        $this->index(new Mensaje("warning", "Sin cambios", "No se ha borrado el producto: $codigo"));
                    }
                } catch (\PDOException $ex) {
                    if (strpos($ex->getMessage(), '1451') !== false) {
                        $this->index(new Mensaje("danger", "No permitido", "Antes de borrar un proveedor debe editar o borrar todos sus productos."));
                    } else {
                        $this->index(new Mensaje("danger", "No permitido", "PDOException: " . $ex->getMessage()));
                    }
                }
            } else {
                $this->index(new Mensaje("warning", "Petición incorrecta", "No se ha facilitado la codigo a borrar"));
            }
        } else {
            header("location: ./");
        }
    }

    private function checkForm(array $_data): array
    {
        $_errors = array();

        $checkCodigo = self::checkCodigo($_data['codigo']);
        if (!is_null($checkCodigo)) {
            $_errors['codigo'] = $checkCodigo;
        } else if (isset($_data['old_codigo'])) {
            if (empty($_data['old_codigo'])) {
                $model = new \Com\Daw2\Models\ProductoModel();
                $ProductoAux = $model->cargarProducto($_data['codigo']);
                if (empty($ProductoAux['codigo'])) {
                    $_errors['codigo'] = "Ya existe un producto con ese codigo";
                }
            } else {
                if ($_data['old_codigo'] !== $_data['codigo']) {
                    $model = new \Com\Daw2\Models\ProductoModel();
                    $ProductoAux = $model->cargarProducto($_data['codigo']);
                    if (!empty($ProductoAux['codigo'])) {
                        $_errors['codigo'] = "Ya existe un producto con ese codigo";
                    }
                }
            }
        }


        $_campos = array(
            'nombre' => 255,
            'descripcion' => 255,
            'coste' => 10000,
            'margen' => 255,
            'stock' => 10000
        );

        foreach ($_campos as $key => $value) {
            if (strlen($_data[$key]) > $value) {
                $_errors[$key] = "El tamaño máximo permito es $value";
            } elseif (empty($_data[$key])) {
                $_errors[$key] = "Inserte un texto";
            }
        }

        $model = new \Com\Daw2\Models\ProductoModel();

        $proveedor = $model->getProveedor();
        $existe = false;
        foreach ($proveedor as $row) {
            if ($_data['proveedor'] == $row['cif']) {
                $existe = true;
            }
        }
        if (!$existe) {
            $_errors['proveedor'] = 'Debe insertar un proveedor existente';
        }
        $categorias = $model->getCategorias();
        $existe = false;
        foreach ($categorias as $row) {
            if ($_data['categoria'] == $row['id_categoria']) {
                $existe = true;
            }
        }
        if (!$existe) {
            $_errors['categorias'] = 'Debe insertar una categoria existente';
        }
        if (!filter_var($_data['coste'], FILTER_VALIDATE_FLOAT)) {
            $_errors['coste'] = 'Debe ser un decimal';
        }
        if (!filter_var($_data['margen'], FILTER_VALIDATE_FLOAT)) {
            $_errors['margen'] = 'Debe ser un decimal';
        }
        if (!filter_var($_data['stock'], FILTER_VALIDATE_INT)) {
            $_errors['stock'] = 'Debe ser un entero';
        }
        if (!filter_var($_data['iva'], FILTER_VALIDATE_INT)) {
            $_errors['iva'] = 'Debe ser un entero';
        }

        return $_errors;
    }

    private static function checkCodigo(string $codigo): ?string
    {
        if (strlen($codigo) != 10) {
            return "La longitud del codigo debe ser de 10 caracteres";
        } elseif (!preg_match("/^[A-S]{3}[0-9]{7}$/", $codigo)) {
            return "Formato del codigo: 'OPP1234567'. Recibido: " . $codigo;
        }
        return NULL;
    }

    private static function sanitizeForm(array $_data): array
    {
        return filter_var_array($_data, FILTER_SANITIZE_SPECIAL_CHARS);
    }



    private function generateCleanUrl(): string
    {
        $_vars = [];
        foreach ($_GET as $key => $value) {
            if ($key !== 'order' && $key !== 'sentido') {
                if (is_array($value)) {
                    $_vars[] = $key . '=' . urlencode(json_encode($value));
                } else {
                    $_vars[] = $key . '=' . urlencode($value);
                }
            }
        }
        $url = "./?" . implode("&", $_vars);
        return $url;
    }

    private function generateCleanUrlPaginador(): string
    {
        $_vars = [];
        foreach ($_GET as $key => $value) {
            if ($key != 'pag') {
                if (is_array($value)) {
                    $_vars[] = $key . '=' . urlencode(json_encode($value));
                } else {
                    $_vars[] = $key . '=' . urlencode($value);
                }
            }
        }
        $url = "./?" . implode("&", $_vars);
        return $url;
    }
}
