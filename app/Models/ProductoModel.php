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
namespace Com\Daw2\Models;

use \PDO;
use Com\Daw2\Helpers\Proveedor;
/**
 * Diferentes test sobre la base de datos
 *
 * @author Rafael González Centeno
 */
class ProductoModel extends \Com\Daw2\Core\BaseModel{
    
    public function getProveedor() : array{
        $_res = array();
        $stmt = $this->db->prepare("SELECT * FROM proveedor");
        $stmt->execute();
        $_proveedores = $stmt->fetchAll();
        return $_proveedores;
    }
    public function getCategorias() : array{
        $_res = array();
        $stmt = $this->db->prepare("SELECT * FROM  categoria");
        $stmt->execute();
        $_categorias = $stmt->fetchAll();
        return $_categorias;
    }
    public function getCountUsuariosByFilter(array $_filtros) : int{
        $query = "SELECT COUNT(*) AS total FROM producto WHERE (1=1)";
        $_where = $this->getAllFilter($_filtros);    
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchColumn();
    }
    public function getAllFilter(array $_filtros ,  string $order = 'codigo', string $sentido = 'DESC', $pag = 1, $tamPag = 100) : array{
        $query = "SELECT * FROM  producto JOIN categoria ON producto.id_categoria = categoria.id_categoria WHERE 1 = 1";

        if(!empty($_filtros['codigo'])){
            $query.= " AND codigo LIKE". "'%".$_filtros['codigo']."%'";
        }
        if(isset($_filtros['proveedor']) && is_array($_filtros['proveedor'])){
            $query.=" AND (";
            for ($i=0; $i < count($_filtros['proveedor']); $i++) { 
                if($i == 0){
                    $query.= "proveedor = "."'".$_filtros['proveedor'][$i]."'";
                }else{
                    $query.= " OR proveedor = "."'".$_filtros['proveedor'][$i]."'";
                }
                
            }
            $query.=" )";
        }
        if(isset($_filtros['categoria']) && is_array($_filtros['categoria'])){
            $query.=" AND (";
            for ($i=0; $i < count($_filtros['categoria']); $i++) { 
                if($i == 0){
                    $query.= "nombre_categoria = "."'".$_filtros['categoria'][$i]."'";
                }else{
                    $query.= " OR nombre_categoria = "."'".$_filtros['categoria'][$i]."'";
                }
                
            }
            $query.=" )";
        }
        $ordenacion = " ORDER BY ". $order." ". $sentido;
        $query.= $ordenacion;
        
        $pagina = ($pag - 1) * $tamPag;
        $paginacion= " LIMIT $pagina, ". $tamPag. " ";
        $query .= $paginacion;
        var_dump($query);
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $_categorias = $stmt->fetchAll();
        return $_categorias;
    }
    public function cargarProducto(string $codigo){
        $stmt = $this->db->prepare("SELECT * FROM producto WHERE codigo = ?");
        $stmt->execute([$codigo]);
        return $stmt->fetch();        
    }
    
    public function insertProducto(array $p) : bool{
        $stmt = $this->db->prepare("INSERT INTO producto (codigo, nombre, descripcion, proveedor, coste, margen,stock, iva, id_categoria) VALUES(:codigo, :nombre, :descripcion, :proveedor, :coste, :margen, :stock, :iva, :id_categoria)");
        $resultado = $stmt->execute([
                'codigo' => $p['codigo'],
                'nombre'=> $p['nombre'],
                'descripcion' => $p['descripcion'],
                'proveedor' => $p['tipoProveedor'],
                'coste' => $p['coste'],
                'margen' => $p['margen'],
                'stock' => $p['stock'],
                'iva' => $p['iva'],
                'id_categoria' => $p['tipoCategoria']
        ]);
        return $resultado;
    }
    
    public function editProducto(array $p, string $oldCodigo) : bool{
        $stmt = $this->db->prepare("UPDATE producto SET codigo=:codigo, nombre=:nombre, descripcion=:descripcion, proveedor=:proveedor, coste=:coste, margen=:margen, stock=:stock, iva=:iva, id_categoria=:id_categoria WHERE codigo=:old_codigo");
       
        $resultado = $stmt->execute([
                'codigo' => $p['codigo'],
                'nombre'=> $p['nombre'],
                'descripcion' => $p['descripcion'],
                'proveedor' => $p['tipoProveedor'],
                'coste' => $p['coste'],
                'margen' => $p['margen'],
                'stock' => $p['stock'],
                'iva' => $p['iva'],
                'id_categoria' => $p['tipoCategoria'],
                'old_codigo' => $oldCodigo
        ]);
        return $resultado;
    }
    
    public function delete(string $codigo) : bool{
        $stmt = $this->db->prepare("DELETE FROM producto WHERE codigo = ?");
        if($stmt->execute([$codigo])){
            return $stmt->rowCount() > 0;
        }
        else{
            return false;
        }
    }
    
}