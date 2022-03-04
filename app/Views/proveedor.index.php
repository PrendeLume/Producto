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
                if(\Com\Daw2\Helpers\Utils::contains($_SESSION['usuario']['permisos']['Proveedor'], 'w')){
                ?>
                <a href="./?controller=proveedor&action=new" class="btn btn-outline-primary float-right">Nuevo proveedor</a>                              
                <?php
                }
                ?>
            </div>
            <div class="card-body"> 
                <?php if(count($data) > 0) { ?>
                <table id="categoriaTable" class="table table-bordered table-striped  dataTable">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Website</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach($data as $proveedor){
                        ?>
                        <tr id="row-<?php echo $proveedor->cif; ?>">
                            <td><?php echo $proveedor->codigo; ?></td>
                            <td><?php echo $proveedor->nombre; ?></td>
                            <td><a href="<?php echo $proveedor->website; ?>" target="_blank"><?php echo $proveedor->website; ?></a></td>
                            <td><a href="mailto:<?php echo $proveedor->email; ?>"><?php echo $proveedor->email; ?></a></td>
                            <td align="center"><a class="btn btn-clock btn-outline-primary" href="./?controller=proveedor&action=edit&cif=<?php echo $proveedor->cif; ?>"><i class="fas fa-edit"></i></a> 
                                <?php
                                if(\Com\Daw2\Helpers\Utils::contains($_SESSION['usuario']['permisos']['Proveedor'], 'd')){
                                ?>
                                <a class="btn btn-clock btn-outline-danger" href="./?controller=proveedor&action=delete&cif=<?php echo $proveedor->cif; ?>"><i class="fas fa-trash"></i></a>
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
                      <h5>Sin Proveedores</h5>
                      <p>No existen proveedores dados de alta que cumplan los requisitos. Pulse aquí para <a href="?controller=proveedor&action=new">crear un nuevo proveedor.</a></p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div> 
</div>
<!--<script src="./vendor/jquery/jquery.min.js"></script>-->
