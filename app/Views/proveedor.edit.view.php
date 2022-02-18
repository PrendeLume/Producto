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
                        Datos proveedor <?php if(isset($proveedorOriginal)) { echo $proveedorOriginal->cif . ' - '. $proveedorOriginal->nombre;  } ?>
                    </h3>                
                </div>
                <form action="./?controller=<?php echo $_GET['controller'];?>&action=<?php echo $_GET['action']; ?>" method="post">
                    <input type="hidden" name="old_cif" value="<?php echo isset($proveedorOriginal) ? $proveedorOriginal->cif : ''; ?>" />
                    <div class="card-body">
                        <div class="row">                            
                            <!-- select -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cif">CIF:</label>
                                    <input type="text" name="cif" id="cif" class="form-control" value="<?php echo $edited->cif; ?>"  maxlength="9" />
                                    <?php
                                    if(isset($errors['cif'])){
                                    ?>
                                    <p class="text-danger"><small><?php echo $errors['cif']; ?></small></p>
                                    <?php
                                    }
                                    ?>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigo">Código:</label>
                                    <input type="text" name="codigo" id="codigo" class="form-control" value="<?php echo $edited->codigo; ?>"  maxlength="10" />
                                    <?php
                                    if(isset($errors['codigo'])){
                                    ?>
                                    <p class="text-danger"><small><?php echo $errors['codigo']; ?></small></p>
                                    <?php
                                    }
                                    ?>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $edited->nombre; ?>"  maxlength="255"/>
                                    <?php
                                    if(isset($errors['nombre'])){
                                    ?>
                                    <p class="text-danger"><small><?php echo $errors['nombre']; ?></small></p>
                                    <?php
                                    }
                                    ?>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direccion">Dirección:</label>
                                    <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $edited->direccion; ?>"  maxlength="255"/>
                                    <?php
                                    if(isset($errors['direccion'])){
                                    ?>
                                    <p class="text-danger"><small><?php echo $errors['direccion']; ?></small></p>
                                    <?php
                                    }
                                    ?>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website">Website:</label>
                                    <input type="text" name="website" id="website" class="form-control" value="<?php echo $edited->website; ?>"  maxlength="255" />
                                    <?php
                                    if(isset($errors['website'])){
                                    ?>
                                    <p class="text-danger"><small><?php echo $errors['website']; ?></small></p>
                                    <?php
                                    }
                                    ?>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>País: </label>
                                    <select class="form-control" name="pais" id="pais">
                                        <option value="0"><i>Ninguna</i></option>
                                        <?php 
                                        foreach($paises as $pais){
                                            ?>
                                            <option value="<?php echo $pais; ?>" <?php echo ($edited->pais === $pais) ? 'selected' : ''; ?>><?php echo $pais; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                    if(isset($errors['pais'])){
                                    ?>
                                    <p class="text-danger"><small><?php echo $errors['pais']; ?></small></p>
                                    <?php
                                    }
                                    ?>
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="text" name="email" id="email" class="form-control" value="<?php echo $edited->email; ?>"  maxlength="255" />
                                    <?php
                                    if(isset($errors['email'])){
                                    ?>
                                    <p class="text-danger"><small><?php echo $errors['email']; ?></small></p>
                                    <?php
                                    }
                                    ?>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $edited->telefono; ?>" maxlength="12"/>
                                    <?php
                                    if(isset($errors['telefono'])){
                                    ?>
                                    <p class="text-danger"><small><?php echo $errors['telefono']; ?></small></p>
                                    <?php
                                    }
                                    ?>
                                </div> 
                            </div>
                        </div></div>
                    <div class="card-footer">  
                        <a href="./?controller=<?php echo $_GET['controller']; ?>" name="action" class="btn btn-danger float-right " value="cancelar">Cancelar</a>
                        <button type="submit" name="action" class="btn btn-primary mr-3 float-right" value="guardar">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



