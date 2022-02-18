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
class ProveedorModel extends \Com\Daw2\Core\BaseModel{
    
    public function getAll() : array{
        $_res = array();
        $stmt = $this->db->prepare("SELECT * FROM proveedor");
        $stmt->execute();
        $_proveedores = $stmt->fetchAll();
        foreach($_proveedores as $p){
            $actual = $this->rowToProveedor($p);
            $_res[] = $actual;                        
        }
        return $_res;
    }
    
    private function rowToProveedor(array $row) : Proveedor{
        $proveedor = new Proveedor($row['cif'], $row['codigo'], $row['nombre'], $row['direccion'], $row['website'], $row['pais'], $row['email']);
        if(isset($row['telefono'])){
            $proveedor->telefono = $row['telefono'];
        }
        return $proveedor;
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
    
}