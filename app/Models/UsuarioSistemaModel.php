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
    
    public function getUsuarioSistemaByEmailNotUser(string $email, int $idUsuario) : array{
        $stmt = $this->db->prepare("SELECT * FROM usuario_sistema WHERE email = ? AND id_usuario != ?");
        $stmt->execute([$email, $idUsuario]);
        return $stmt->fetchAll();
    }
    
    public function getUsuarioSistemaById(int $id) : array{
        $stmt = $this->db->prepare("SELECT * FROM usuario_sistema WHERE id_usuario = ?");
        $stmt->execute([$id]);
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
    
    public function updateUsuarioSistema(int $idUsuario, string $email, string $nombre, int $idRol, string $password = '') : bool{
        if(empty($password)){
            $sql = "UPDATE usuario_sistema SET id_rol=:id_rol, email=:email, nombre=:nombre WHERE id_usuario=:id_usuario";
            $stmt = $this->db->prepare($sql);
            $res = $stmt->execute([
                'id_rol' => $idRol,
                'email' => $email,
                'nombre' => $nombre,
                'id_usuario' => $idUsuario
            ]);
            return $res;
        }
        else{
            $sql = "UPDATE usuario_sistema SET id_rol=:id_rol, email=:email, nombre=:nombre, pass=:pass WHERE id_usuario=:id_usuario";
            $stmt = $this->db->prepare($sql);
            $res = $stmt->execute([
                'id_rol' => $idRol,
                'email' => $email,
                'nombre' => $nombre,
                'id_usuario' => $idUsuario,
                'pass' => password_hash($password, PASSWORD_DEFAULT)
            ]);
            return $res;
        }
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
    
    public function getAllUsuarioSistema() : array{
        $stmt = $this->db->query("SELECT * FROM usuario_sistema JOIN rol ON usuario_sistema.id_rol = rol.id_rol ORDER BY nombre");
        return $stmt->fetchAll();
    }
    
    private function getPermisos(int $idRol) : array{
        if($idRol === 1){
            return array(
                'UsuarioSistema' => 'rwd',
                'Categoria' => 'rwd',
                'Producto' => 'rwd',
                'Proveedor' => 'rwd',
                'Usuario' => 'rwd'
            );
        }
        elseif($idRol === 2){
            return array(
                'UsuarioSistema' => '',
                'Categoria' => 'rwd',
                'Producto' => 'rwd',
                'Proveedor' => 'rwd',
                'Usuario' => 'rwd'  
            );
        }
        elseif($idRol === 3){
            return array(
                'UsuarioSistema' => '',
                'Categoria' => '',
                'Producto' => 'rwd',
                'Proveedor' => 'rwd',
                'Usuario' => 'rwd'  
            );
        }
        else{
            return [];
        }
    }
}
