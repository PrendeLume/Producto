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
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $csv_div_titulo; ?></h6>                                    
            </div>
            <div class="card-body">  
                <table id="csvTable" class="table table-bordered table-striped  dataTable">
                    <?php 
                    $first = true;
                    foreach($data as $fila){
                        if($first){
                            ?>
                    <thead>
                        <tr>
                        <?php 
                        foreach($fila as $columna){
                            ?>
                            <th><?php echo $columna; ?></th>
                            <?php
                        }
                        $first = false;
                        ?>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                        }
                        else{
                            ?>
                        <tr>
                            <?php 
                            foreach($fila as $columna){
                                ?>
                                <td><?php echo (is_numeric($columna)) ? number_format($columna, 0, ",", ".") : $columna; ?></td>
                                <?php
                            }
                            ?>
                        </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                    <?php
                    if(isset($filaMax) && isset($filaMin)){
                    ?>                        
                    <tfoot>
                        <tr>
                            <td><strong><?php echo $filaMin[0]; ?></strong></td>
                            <td><?php echo $filaMin[2]; ?></td>
                            <td><strong>MIN</strong></td>
                            <td><?php echo number_format($filaMin[3], 0, ",", "."); ?></td>
                        </tr>
                        <tr>
                            <td><strong><?php echo $filaMax[0]; ?></strong></td>
                            <td><?php echo $filaMax[2]; ?></td>
                            <td><strong>MAX</strong></td>
                            <td><?php echo number_format($filaMax[3], 0, ",", "."); ?></td>
                        </tr>
                    </tfoot>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div> 
</div>
<!--<script src="./vendor/jquery/jquery.min.js"></script>-->

