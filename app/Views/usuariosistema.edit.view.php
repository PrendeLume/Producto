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
                        Datos usuario sistema
                    </h3>                
                </div>
                <form action="./?controller=usuarioSistema&action=<?php echo $_GET['action']; ?>" method="post">
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="id_usuario" value="" />
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo isset($sanitized['nombre']) ? $sanitized['nombre'] : ''; ?>" placeholder="Nombre de usuario" />
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
                                    <label for="email">Email:</label>
                                    <input type="text" name="email" id="email" class="form-control" value="<?php echo isset($sanitized['email']) ? $sanitized['email'] : ''; ?>" placeholder="user@domain.org" />
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
                                    <label>Rol: </label>
                                    <select class="form-control" name="id_rol" id="id_rol">
                                        <option value="0"><i>Ninguna</i></option>
                                        <?php
                                        foreach ($roles as $rol) {
                                            $selected = (isset($sanitized['id_rol']) && $rol['id_rol'] == $sanitized['id_rol']) ? 'selected' : '';
                                            echo '<option value="' . $rol['id_rol'] . '" '.$selected.'>' . $rol['rol'] . ' - ' . $rol['descripcion_es'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <?php
                                    if(isset($errors['id_rol'])){
                                    ?>
                                    <p class="text-danger"><small><?php echo $errors['id_rol']; ?></small></p>
                                    <?php
                                    }
                                    ?>
                                </div>   
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" id="password" class="form-control" value="" placeholder="*********" />
                                    <?php
                                    if(isset($errors['password'])){
                                    ?>
                                    <p class="text-danger"><small><?php echo $errors['password']; ?></small></p>
                                    <?php
                                    }
                                    ?>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password2">Reescriba el password:</label>
                                    <input type="password" name="password2" id="password2" class="form-control" value="" placeholder="*********" />
                                    <?php
                                    if(isset($errors['password2'])){
                                    ?>
                                    <p class="text-danger"><small><?php echo $errors['password2']; ?></small></p>
                                    <?php
                                    }
                                    ?>
                                </div> 
                            </div>

                        </div></div>
                    <div class="card-footer">
                        
                        <a href="./?controller=usuarioSistema" class="btn btn-danger float-right " value="cancelar">Cancelar</a>
                        <button type="submit" name="submit" class="btn btn-primary mr-3 float-right" value="guardar">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



