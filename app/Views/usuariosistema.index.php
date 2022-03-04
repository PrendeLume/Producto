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
?>
 <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<div class="row">
    <div class="col-12">
        <?php 
        if(!is_null($msg)){
        ?>
        <div class="alert alert-<?php echo $msg->getType(); ?> alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon <?php echo $msg->getIcon(); ?>"></i> <?php echo $msg->getTitle(); ?></h5>
          <?php echo $msg->getText(); ?>
        </div>
        <?php    
        }
        ?>
        <div class="card shadow mb-4">
            <div
                class="card-header">
                <?php
                if(\Com\Daw2\Helpers\Utils::contains($_SESSION['usuario']['permisos']['UsuarioSistema'], 'w')){
                ?>                
                <a href="./?controller=UsuarioSistema&action=new" class="btn btn-outline-primary float-right">Nuevo Usuario</a>                              
                <?php
                }
                ?>
            </div>
            <div class="card-body"> 
                <?php if(count($data) > 0) { ?>
                <table id="usuarioSistemaTable" class="table table-bordered table-striped  dataTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>E-mail</th>
                            <th>Rol</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach($data as $row){
                        ?>
                        <tr id="usuarioSistema-<?php echo $row['id_usuario']; ?>">
                            <td><?php echo  $row['nombre']; ?></td>
                            <td><?php echo  $row['email']; ?></td>
                            <td><?php echo  $row['rol'];; ?></td>
                            <td align="center"><a class="btn btn-clock btn-outline-primary" href="./?controller=usuarioSistema&action=edit&id_usuario=<?php echo $row['id_usuario']; ?>"><i class="fas fa-edit"></i></a> 
                                <?php 
                                if(\Com\Daw2\Helpers\Utils::contains($_SESSION['usuario']['permisos']['Categoria'], 'd')){
                                ?>
                                <a class="btn btn-clock btn-outline-danger" href="./?controller=usuarioSistema&action=delete&id_usuario=<?php echo $row['id_usuario']; ?>"><i class="fas fa-trash"></i></a>
                               <?php
                                }
                                ?>
                            </td>
                        </tr>
                            <?php
                        }                    
                    ?>
                    </tbody>
                </table>
                <?php
                }
                else{
                    ?>
                    <div class="callout callout-info">
                      <h5>Sin usuarios del sistema</h5>

                      <p>No existen usuarios del sistema dados de alta que cumplan los requisitos. Pulse aquí para <a href="?controller=usuarioSistema&action=new">crear un nuevo usuario.</a></p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div> 
</div>
<!--<script src="./vendor/jquery/jquery.min.js"></script>-->
