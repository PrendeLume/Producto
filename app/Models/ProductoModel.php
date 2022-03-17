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
    
    public function getAll() : array{
        $_res = array();
        $stmt = $this->db->prepare("SELECT * FROM producto JOIN categoria ON producto.id_categoria = categoria.id_categoria");
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
    public function getAllFilter(array $_filtros) : array{
        $query = "SELECT * FROM  producto JOIN categoria ON producto.id_categoria = categoria.id_categoria WHERE 1 = 1";

        if(!empty($_filtros['codigo'])){
            $query.= " AND codigo LIKE". "'%".$_filtros['codigo']."%'";
        }
        if(isset($_filtros['tipoProveedor']) && is_array($_filtros['tipoProveedor'])){
            for ($i=0; $i < count($_filtros['tipoProveedor']); $i++) { 
                
                $query.= " AND proveedor = "."'".$_filtros['tipoProveedor'][$i]."'";
            }
        }
        if(isset($_filtros['tipoCategoria']) && is_array($_filtros['tipoCategoria'])){
            for ($i=0; $i < count($_filtros['tipoCategoria']); $i++) { 
                
                $query.= " AND nombre_categoria = "."'".$_filtros['tipoCategoria'][$i]."'";
            }
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $_categorias = $stmt->fetchAll();
        return $_categorias;
    }
    public function loadProveedor(string $cif) : ?Proveedor{
        $stmt = $this->db->prepare("SELECT * FROM proveedor WHERE cif = ?");
        $stmt->execute([$cif]);
        if($row = $stmt->fetch()){
           return $this->rowToProveedor($row);
        }        
        return null;
    }
    
    public function insertProveedor(Proveedor $p) : bool{
        $stmt = $this->db->prepare("INSERT INTO proveedor (cif, codigo, nombre, direccion, website, pais, email, telefono) VALUES(:cif, :codigo, :nombre, :direccion, :website, :pais, :email, :telefono)");
        $resultado = $stmt->execute([
                'cif' => $p->cif,
                'codigo'=> $p->codigo,
                'nombre' => $p->nombre,
                'direccion' => $p->direccion,
                'website' => $p->website,
                'pais' => $p->pais,
                'email' => $p->email,
                'telefono' => $p->telefono
        ]);
        return $resultado;
    }
    
    public function editProveedor(Proveedor $p, string $oldCif) : bool{
        $stmt = $this->db->prepare("UPDATE proveedor SET cif=:cif, codigo=:codigo, nombre=:nombre, direccion=:direccion, website=:website, pais=:pais, email=:email, telefono=:telefono WHERE cif=:old_cif");
        $resultado = $stmt->execute([
                'cif' => $p->cif,
                'codigo'=> $p->codigo,
                'nombre' => $p->nombre,
                'direccion' => $p->direccion,
                'website' => $p->website,
                'pais' => $p->pais,
                'email' => $p->email,
                'telefono' => $p->telefono,
                'old_cif' => $oldCif
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