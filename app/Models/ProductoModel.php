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
    public function getUsuariosByFilters(array $_filtros, string $order = '', string $sentido = '', $pag = 1, $tamPag = 10) : array{
        $orderBy = " ORDER BY ".$order. " ".$sentido;
        
        $query = "SELECT * FROM usuario WHERE (1=1)";
        
        $_where = $this->generateWhereByFilter($_filtros);
        $_params = $_where['params'];
        $query .= $_where['where']; 
        
        $query .= $orderBy;
        $pagina = ($pag - 1) * $tamPag;
        $paginacion = " LIMIT $pagina, $tamPag";
        $query .= $paginacion;
        $statement = $this->db->prepare($query);
        $statement->execute($_params);
        $statement->setFetchMode(PDO::FETCH_CLASS, '\Com\Daw2\Helpers\Usuario');
        return $statement->fetchAll();
    }
    private function generateWhereByFilter(array $_filtros) : array{
        $query = "";
        $_params = [];
        if(isset($_filtros['rol'])){
            $query .= " AND (";
            for($i = 0; $i < count($_filtros['rol']); $i++){
                if($i == 0){
                    $query .= "rol = :rol$i";                    
                }
                else{
                    $query .= " OR rol = :rol$i";                    
                }
                $_params["rol$i"] = $_filtros['rol'][$i];
            }
            $query .= ")";
        }
        if(isset($_filtros['username'])){
            $query .= " AND username LIKE :username";
            $_params['username'] = "%".$_filtros['username']."%";
        }
        if(isset($_filtros['min_salar'])){
            $query .= " AND salarioBruto >= :min_salar";
            $_params['min_salar'] = $_filtros['min_salar'];
        }
        if(isset($_filtros['max_salar'])){
            $query .= " AND salarioBruto <= :max_salar";
            $_params['max_salar'] = $_filtros['max_salar'];
        }
        if(isset($_filtros['min_irpf'])){
            $query .= " AND retencionIRPF >= :min_irpf";
            $_params['min_irpf'] = $_filtros['min_irpf'];
        }
        if(isset($_filtros['max_irpf'])){
            $query .= " AND retencionIRPF <= :max_irpf";
            $_params['max_irpf'] = $_filtros['max_irpf'];
        }
        return array(
            'where' => $query,
            'params' => $_params
        );
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
    
    public function delete(string $cif) : bool{
        $stmt = $this->db->prepare("DELETE FROM proveedor WHERE cif = ?");
        if($stmt->execute([$cif])){
            return $stmt->rowCount() > 0;
        }
        else{
            return false;
        }
    }
    
}