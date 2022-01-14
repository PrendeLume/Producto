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
            <?php
            if(isset($exito) && $exito){
            ?>
            <div class="alert alert-success">Registro guardado con éxito</div>
            <?php
            }
            elseif(isset($exito)){
                ?>
            <div class="alert alert-danger">Error indeterminado al guardar.</div>
            <?php
            }
            ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cubes mr-1"></i>
                        Datos categoría
                    </h3>                
                </div>
                <form action="./?controller=csv&action=<?php echo $_GET['action']; ?>" method="post">
                    <div class="card-body">
                        <div class="row">                            
                            <!-- select -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Municipio:</label>
                                    <input type="text" name="municipio" id="municipio" class="form-control" value="<?php echo isset($sanitized['municipio']) ? $sanitized['municipio'] : ""; ?>" />
                                    <?php
                                    if(isset($errors['municipio'])){
                                    ?>
                                    <p class="text-danger"><small><?php echo $errors['municipio']; ?></small></p>
                                    <?php
                                    }
                                    ?>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Población:</label>
                                    <input type="text" name="poblacion" id="poblacion" class="form-control" value="<?php echo isset($sanitized['poblacion']) ? $sanitized['poblacion'] : ""; ?>" />
                                    <?php
                                    if(isset($errors['poblacion'])){
                                    ?>
                                    <p class="text-danger"><small><?php echo $errors['poblacion']; ?></small></p>
                                    <?php
                                    }
                                    ?>
                                </div> 
                            </div>

                        </div></div>
                    <div class="card-footer">
                        
                        <button type="submit" name="action" class="btn btn-danger float-right " value="cancelar">Cancelar</button>
                        <button type="submit" name="action" class="btn btn-primary mr-3 float-right" value="guardar">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



