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

/**
 * Description of UsuarioSistemaModel
 *
 * @author rgcenteno
 */
class UsuarioSistemaModel extends \Com\Daw2\Core\BaseModel{
    
    public function getAllRols() : array{
        $stmt = $this->db->query("SELECT * FROM rol");
        return $stmt->fetchAll();
    }
    
    public function checkIdRolExists(int $idRol) : bool{
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM rol WHERE id_rol = ?");
        $stmt->execute([$idRol]);
        return $stmt->fetch()['total'] > 0;        
    }
    
    public function getUsuarioSistemaByEmail(string $email) : array{
        $stmt = $this->db->prepare("SELECT * FROM usuario_sistema WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchAll();
    }
    
    public function insertUsuarioSistema(string $email, string $nombre, int $idRol, string $password) : bool{
        $stmt = $this->db->prepare("INSERT INTO usuario_sistema (id_rol, email, pass, nombre, idioma, baja) VALUES(:id_rol, :email, :pass, :nombre, :idioma, :baja)");
        $res = $stmt->execute([
            'id_rol' => $idRol,
            'email' => $email,
            'nombre' => $nombre,
            'pass' => password_hash($password, PASSWORD_DEFAULT),
            'idioma' => 'es',
            'baja' => 0
        ]);
        return $res;
    }
    
    public function login(string $email, string $password) : ?array{
        $_usuario = $this->getUsuarioSistemaByEmail($email)[0];
        if(!empty($_usuario)){
            if(password_verify($password, $_usuario['pass'])){
                $_usuario['permisos'] = $this->getPermisos($_usuario['id_rol']);
                return $_usuario;
            }
            else{
                return NULL;
            }
        }
        else{
            return NULL;
        }
    }
    
    private function getPermisos(int $idRol) : array{
        if($idRol === 1){
            return array(
                'UsuarioSistema' => 'rwd',
                'Categoria' => 'rwd',
                'Proveedor' => 'rwd',
                'Usuario' => 'rwd'
            );
        }
        elseif($idRol === 2){
            return array(
                'UsuarioSistema' => '',
                'Categoria' => 'rwd',
                'Proveedor' => 'rwd',
                'Usuario' => 'rwd'  
            );
        }
        elseif($idRol === 3){
            return array(
                'UsuarioSistema' => '',
                'Categoria' => '',
                'Proveedor' => 'rwd',
                'Usuario' => 'rwd'  
            );
        }
        else{
            return [];
        }
    }
}
