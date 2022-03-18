


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
                <form action="./?controller=Producto&action=edit" method="post">
                    <input type="hidden" name="old_codigo" value="<?php  if (isset($productoOriginal)) {echo $productoOriginal['codigo'];}?>"/>
                    <input type="hidden" name="controller" value="<?php echo $_GET['controller']; ?>" />
                    <input type="hidden" name="action" value="<?php echo isset($_GET['action']) ? $_GET['action'] : ''; ?>" />
                    <div class="card-body"> 
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Proveedor</label>
                                    <select class="form-control select2bs4" name="tipoProveedor[]" data-placeholder="Seleccione un tipo">                                    
                                        <option value="<?php echo $data['proveedor']; ?>" <?php echo isset($_GET['tipoProveedor']) && in_array($data['proveedor'], $_GET['tipoProveedor']) ? 'selected' : ''; ?>><?php echo ucfirst($data['proveedor']); ?></option>
                                            
                                        <?php
                                        foreach ($proveedores as $row) {
                                            if($row['cif'] == $data['cif']){
                                                
                                            }else{
                                            ?>
                                        
                                        <option value="<?php echo $row['cif']; ?>" <?php echo isset($_GET['tipoProveedor']) && in_array($row['cif'], $_GET['tipoProveedor']) ? 'selected' : ''; ?>><?php echo ucfirst($row['cif']); ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Categorias</label>
                                    <select class="form-control select2bs4" name="tipoCategoria[]" data-placeholder="Seleccione un tipo">                                    

                                        <option value="<?php echo $data['id_categoria']; ?>" <?php echo isset($_GET['tipoCategoria']) && in_array($data['nombre_categoria'], $_GET['tipoCategoria']) ? 'selected' : ''; ?>><?php echo ucfirst($data['nombre_categoria']); ?></option>
                                        <?php
                                        foreach ($categorias as $row) {
                                            if($row['nombre_categoria'] == $data['nombre_categoria']){
                                                
                                            }else{
                                            ?>
                                        
                                        <option value="<?php echo $row['id_categoria']; ?>" <?php echo isset($_GET['tipoCategoria']) && in_array($row['nombre_categoria'], $_GET['tipoCategoria']) ? 'selected' : ''; ?>><?php echo ucfirst($row['nombre_categoria']); ?></option>
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
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de producto" value="<?php echo filter_var($data['nombre'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="descripcion">Descirpcion</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" value="<?php echo filter_var($data['descripcion'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="coste">Coste</label>
                                    <input type="text" class="form-control" id="coste" name="coste" placeholder="coste" value="<?php echo filter_var($data['coste'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="margen">Margen</label>
                                    <input type="text" class="form-control" id="margen" name="margen" placeholder="margen" value="<?php echo filter_var($data['margen'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="text" class="form-control" id="stock" name="stock" placeholder="stock" value="<?php echo filter_var($data['stock'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="iva">IVA</label>
                                    <input type="text" class="form-control" id="iva" name="iva" placeholder="iva" readonly value="<?php echo filter_var($data['iva'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">  
                        <a href="./?controller=Producto" class="btn btn-danger float-left " value="reset">Resetear</a>                      
                        <button type="submit" name="gardar" class="btn btn-primary ml-3 float-left" value="gardar"><i class="fas fa-search"></i> Gardar</button>

                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>
