


<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
  Expandir
  ProductoModel.php
  10 KB
  Primero controller, segundo model
  Ahora las views:
  <?php

  /*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
  Expandir
  producto.index.php
  12 KB
  <?php
  /*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
  Expandir
  producto.edit.view.php
  10 KB
  ﻿
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

<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cubes mr-1"></i>
                        Datos proveedor <?php if (isset($productoOriginal)) {
    echo $productoOriginal['codigo'] . ' - ' . $productoOriginal['nombre'];
} ?>
                    </h3>                
                </div>
                <form action="./?controller=Producto" method="get">
                    <input type="hidden" name="controller" value="<?php echo $_GET['controller']; ?>" />
                    <input type="hidden" name="action" value="<?php echo isset($_GET['action']) ? $_GET['action'] : ''; ?>" />
                    <div class="card-body"> 
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Proveedor</label>
                                    <select class="form-control select2bs4" name="tipoProveedor[]" multiple="multiple" data-placeholder="Seleccione un tipo">                                    
                                        <?php
                                        foreach ($data as $row) {
                                            ?>
                                            <option value="<?php echo $row['proveedor']; ?>" <?php echo isset($_GET['tipoProveedor']) && in_array($row['proveedor'], $_GET['tipoProveedor']) ? 'selected' : ''; ?>><?php echo ucfirst($row['proveedor']); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Categorias</label>
                                    <select class="form-control select2bs4" name="tipoCategoria[]" multiple="multiple" data-placeholder="Seleccione un tipo">                                    

                                        <option value="<?php echo $data[0]['nombre_categoria']; ?>" <?php echo isset($_GET['tipoCategoria']) && in_array($data[0]['nombre_categoria'], $_GET['tipoCategoria']) ? 'selected' : ''; ?>><?php echo ucfirst($data[0]['nombre_categoria']); ?></option>
                                        <?php
                                        foreach ($categorias as $row) {
                                            if($row['nombre_categoria'] == $data[0]['nombre_categoria']){
                                                
                                            }else{
                                            ?>
                                        
                                        <option value="<?php echo $row['nombre_categoria']; ?>" <?php echo isset($_GET['tipoCategoria']) && in_array($row['nombre_categoria'], $_GET['tipoCategoria']) ? 'selected' : ''; ?>><?php echo ucfirst($row['nombre_categoria']); ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="codigo">Codigo</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo" value="<?php echo isset($_GET['codigo']) ? filter_var($_GET['codigo'], FILTER_SANITIZE_SPECIAL_CHARS) : ''; ?>" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de producto" value="<?php echo filter_var($data[0]['nombre'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="descripcion">Descirpcion</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" value="<?php echo filter_var($data[0]['descripcion'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="coste">Coste</label>
                                    <input type="text" class="form-control" id="coste" name="coste" placeholder="coste" value="<?php echo filter_var($data[0]['coste'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="margen">Margen</label>
                                    <input type="text" class="form-control" id="margen" name="margen" placeholder="margen" value="<?php echo filter_var($data[0]['margen'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="text" class="form-control" id="stock" name="stock" placeholder="stock" value="<?php echo filter_var($data[0]['stock'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="iva">IVA</label>
                                    <input type="text" class="form-control" id="iva" name="iva" placeholder="iva" readonly value="<?php echo filter_var($data[0]['iva'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">  
                        <a href="./?controller=Producto" class="btn btn-danger float-left " value="reset">Resetear</a>                      
                        <button type="submit" name="gardar" class="btn btn-primary ml-3 float-left" value="filtrar"><i class="fas fa-search"></i> Gardar</button>

                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>
