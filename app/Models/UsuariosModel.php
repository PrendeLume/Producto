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
    
}

