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
                        Datos proveedor <?php
                                        if (isset($productoOriginal)) {
                                            echo $productoOriginal['codigo'] . ' - ' . $productoOriginal['nombre'];
                                        }
                                        ?>
                    </h3>
                </div>
                <form action="./?controller=Producto&action=edit" method="post">
                    <input type="hidden" name="old_codigo" value="<?php if (isset($productoOriginal)) {
                                                                        echo $productoOriginal['codigo'];
                                                                    } ?>" />
                    <input type="hidden" name="controller" value="<?php echo $_GET['controller']; ?>" />
                    <input type="hidden" name="action" value="<?php echo isset($_GET['action']) ? $_GET['action'] : ''; ?>" />
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Proveedor</label>
                                    <select class="form-control select2bs4" name="proveedor" data-placeholder="Seleccione un tipo">

                                        <?php
                                        foreach ($proveedores as $row) {
                                         
                                            ?>
                                                <option value="<?php echo $row['cif']; ?>" <?php echo isset($data)&&($row['cif'] == $data['proveedor'])? 'selected': '';?>><?php echo ucfirst($row['cif']); ?></option>
                                                
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <p class="text-danger"><small><?php echo isset($errors['proveedor']) ? $errors['proveedor'] : '' ?></small></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Categorias</label>
                                    <?php var_dump($categorias[0]['id_categoria']);?>
                                    <select class="form-control select2bs4" name="categoria" data-placeholder="Seleccione un tipo">

                                        <?php
                                        foreach ($categorias as $row) {
                                            
                                            ?>
                                            <option value="<?php echo $row['id_categoria']; ?>"  <?php echo (isset($data['categoria'])&&($row['id_categoria'] == $data['categoria'])) || (isset($data['id_categoria'])&&($row['id_categoria'] == $data['id_categoria']))? 'selected': '';?> ><?php echo ucfirst($row['nombre_categoria']); ?></option>
                                            
                                        <?php
                                            
                                        }
                                        ?>
                                    </select>
                                    <p class="text-danger"><small><?php echo isset($errors['categoria']) ? $errors['categoria'] : '' ?></small></p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="codigo">Codigo</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="OPP1234567" value="<?php echo isset($data['codigo']) ? filter_var($data['codigo'], FILTER_SANITIZE_SPECIAL_CHARS) : ''; ?>" />
                                    <p class="text-danger"><small><?php echo isset($errors['codigo']) ? $errors['codigo'] : '' ?></small></p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de producto" value="<?php echo filter_var($data['nombre'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                    <p class="text-danger"><small><?php echo isset($errors['nombre']) ? $errors['nombre'] : '' ?></small></p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="descripcion">Descirpcion</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" value="<?php echo filter_var($data['descripcion'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                    <p class="text-danger"><small><?php echo isset($errors['descripcion']) ? $errors['descripcion'] : '' ?></small></p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="coste">Coste</label>
                                    <input type="text" class="form-control" id="coste" name="coste" placeholder="coste" value="<?php echo filter_var($data['coste'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                    <p class="text-danger"><small><?php echo isset($errors['coste']) ? $errors['coste'] : '' ?></small></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="margen">Margen</label>
                                    <input type="text" class="form-control" id="margen" name="margen" placeholder="margen" value="<?php echo filter_var($data['margen'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                    <p class="text-danger"><small><?php echo isset($errors['margen']) ? $errors['margen'] : '' ?></small></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="text" class="form-control" id="stock" name="stock" placeholder="stock" value="<?php echo filter_var($data['stock'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                    <p class="text-danger"><small><?php echo isset($errors['stock']) ? $errors['stock'] : '' ?></small></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="iva">IVA</label>
                                    <input type="text" class="form-control" id="iva" name="iva" placeholder="iva" readonly value="<?php echo filter_var($data['iva'], FILTER_SANITIZE_SPECIAL_CHARS); ?>" />
                                    <p class="text-danger"><small><?php echo isset($errors['iva']) ? $errors['iva'] : '' ?></small></p>
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