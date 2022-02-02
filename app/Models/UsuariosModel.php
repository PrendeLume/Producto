<?php

namespace Com\Daw2\Models;
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
use \PDO;

class UsuariosModel extends \Com\Daw2\Core\BaseModel{
        
    
    
    public function getAllUsuarios() : array{
        $query = $this->db->query("Select * FROM usuario");        
        $query->setFetchMode(PDO::FETCH_CLASS, '\Com\Daw2\Helpers\Usuario');
        return $query->fetchAll();
    }
    
    public function getRoles() : array{
        $query = $this->db->query("SELECT DISTINCT rol FROM usuario ORDER BY rol");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        return $query->fetchAll();
    }
    
    public function getUsuariosByRol(string $rol) : array{
        $query = $this->db->prepare("SELECT * FROM usuario WHERE rol = ?");
        $query->execute([$rol]);
        $query->setFetchMode(PDO::FETCH_CLASS, '\Com\Daw2\Helpers\Usuario');
        return $query->fetchAll();
    }
    
    public function getUsuariosByUsername(string $username) : array{
        $query = $this->db->prepare("SELECT * FROM usuario WHERE username LIKE ?");
        $query->execute(["%$username%"]);
        $query->setFetchMode(PDO::FETCH_CLASS, '\Com\Daw2\Helpers\Usuario');
        return $query->fetchAll();
    }
    
    public function getUsuarioBySalarioBruto(?float $min, ?float $max) : array{
        if(isset($min) && isset($max)){
            $query = $this->db->prepare("SELECT * FROM usuario WHERE salarioBruto >= ? AND salarioBruto <= ?");
            $query->execute([$min, $max]);
        }
        elseif(isset($min)){
            $query = $this->db->prepare("SELECT * FROM usuario WHERE salarioBruto >= ? ");
            $query->execute([$min]);
        }
        else{
            $query = $this->db->prepare("SELECT * FROM usuario WHERE salarioBruto <= ?");
            $query->execute([$max]);
        }
        $query->setFetchMode(PDO::FETCH_CLASS, '\Com\Daw2\Helpers\Usuario');
        return $query->fetchAll();
    }
    
    public function getUsuarioByIRPF(?int $min, ?int $max) : array{
        if(isset($min) && isset($max)){
            $query = $this->db->prepare("SELECT * FROM usuario WHERE retencionIRPF >= ? AND retencionIRPF <= ?");
            $query->execute([$min, $max]);
        }
        elseif(isset($min)){
            $query = $this->db->prepare("SELECT * FROM usuario WHERE retencionIRPF >= ? ");
            $query->execute([$min]);
        }
        else{
            $query = $this->db->prepare("SELECT * FROM usuario WHERE retencionIRPF <= ?");
            $query->execute([$max]);
        }
        $query->setFetchMode(PDO::FETCH_CLASS, '\Com\Daw2\Helpers\Usuario');
        return $query->fetchAll();
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
    
    public function getCountUsuariosByFilter(array $_filtros) : int{
        $query = "SELECT COUNT(*) AS total FROM usuario WHERE (1=1)";
        $_where = $this->generateWhereByFilter($_filtros);
        $_params = $_where['params'];
        $query .= $_where['where'];        
        $statement = $this->db->prepare($query);
        $statement->execute($_params);
        return $statement->fetchColumn();
    }
    
    private function generateWhereByFilter(array $_filtros) : array{
        $query = "";
        $_params = [];
        if(isset($_filtros['rol'])){
            $query .= " AND rol = :rol";
            $_params['rol'] = $_filtros['rol'];
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
    
}

