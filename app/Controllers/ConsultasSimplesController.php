<?php

namespace Com\Daw2\Controllers;
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

class ConsultasSimplesController extends \Com\Daw2\Core\BaseController{    
    private $pdo;
    
    public function __construct(){
        $dsn = "mysql:host=localhost;dbname=demoUD4;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, 'admin', 'daw2pass', $options);
    }
    
    public function ejercicio01(){
        $_res = $this->pdo->query("SELECT * FROM usuario")->fetchAll();
        foreach($_res as $row){
            echo $row['username'].'<br />';
        }
    }
    
    public function ejercicio02(){
        $_res = $this->pdo->query("SELECT * FROM usuario ORDER BY salarioBruto DESC")->fetchAll();
        foreach($_res as $row){
            echo $row['username'].":".$row['salarioBruto'].'<br />';
        }
    }
    
    public function ejercicio03(){
        $_res = $this->pdo->query("SELECT * FROM usuario WHERE rol='standard'")->fetchAll();
        foreach($_res as $row){
            echo $row['username'].'<br />';
        }
    }
    
    public function ejercicio04(){
        $_res = $this->pdo->query("SELECT * FROM usuario WHERE username LIKE 'Carlos%'")->fetchAll();
        foreach($_res as $row){
            echo $row['username'].'<br />';
        }
    }
    
}