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
        if (!is_null($msg)) {
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
            <div class="card-header">
                <?php
                if (\Com\Daw2\Helpers\Utils::contains($_SESSION['usuario']['permisos']['Proveedor'], 'w')) {
                ?>
                    <a href="./?controller=producto&action=new" class="btn btn-outline-primary float-right">Nuevo producto</a>
                <?php
                }
                ?>
            </div>
            <form action="./?controller=producto&action=" method="get">
                <input type="hidden" name="controller" value="<?php echo $_GET['controller']; ?>" />
                <input type="hidden" name="action" value="<?php echo isset($_GET['action']) ? $_GET['action'] : ''; ?>" />
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Proveedores</label>
                                <select class="form-control select2bs4" name="proveedor[]" multiple="multiple" data-placeholder="Seleccione un tipo">
                                    <?php
                                    foreach ($proveedores as $row) {
                                    ?>
                                        <option value="<?php echo $row['cif']; ?>" <?php echo isset($_GET['proveedor']) && in_array($row['cif'], $_GET['proveedor'])  ? 'selected' : ''; ?>><?php echo ucfirst($row['cif']); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Categorias</label>
                                <select class="form-control select2bs4" name="categoria[]" multiple="multiple" data-placeholder="Seleccione un tipo">
                                    <?php
                                    foreach ($categorias as $row) {
                                    ?>
                                        <option value="<?php echo $row['nombre_categoria']; ?>" <?php echo isset($_GET['categoria']) && in_array($row['nombre_categoria'], $_GET['categoria'])  ? 'selected' : ''; ?>><?php echo ucfirst($row['nombre_categoria']); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="codigo">codigo</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Nombre de usuario" value="<?php echo isset($_GET['codigo']) ? filter_var($_GET['codigo'], FILTER_SANITIZE_SPECIAL_CHARS) : ''; ?>" />
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <a href="./?controller=Producto" class="btn btn-danger float-left " value="reset">Resetear</a>
                    <button type="submit" name="filtrar" class="btn btn-primary ml-3 float-left" value="filtrar"><i class="fas fa-search"></i> Filtrar</button>

                </div>
            </form>
            <div class="card-body">
                <?php if (count($data) > 0) { ?>
                    <table id="categoriaTable" class="table table-bordered table-striped  dataTable">
                        <thead>
                            <tr>
                                <th><a href="<?php echo $url . ($order == 0 && $sentido != 'desc' ? '&sentido=desc' : ''); ?>&order=0">Código</a> <?php if ($order == 0) { ?><i class="fas fa-sort-alpha-down<?php echo ($sentido === 'desc') ? '-alt' : ''; ?>"></i><?php } ?></th>
                                <th><a href="<?php echo $url . ($order == 1 && $sentido != 'desc' ? '&sentido=desc' : ''); ?>&order=1">Nombre</a> <?php if ($order == 1) { ?><i class="fas fa-sort-alpha-down<?php echo ($sentido === 'desc') ? '-alt' : ''; ?>"></i><?php } ?></th>
                                <th><a href="<?php echo $url . ($order == 2 && $sentido != 'desc' ? '&sentido=desc' : ''); ?>&order=2">Proveedor</a> <?php if ($order == 2) { ?><i class="fas fa-sort-alpha-down<?php echo ($sentido === 'desc') ? '-alt' : ''; ?>"></i><?php } ?></th>
                                <th><a href="<?php echo $url . ($order == 3 && $sentido != 'desc' ? '&sentido=desc' : ''); ?>&order=3">Categoria</a> <?php if ($order == 3) { ?><i class="fas fa-sort-alpha-down<?php echo ($sentido === 'desc') ? '-alt' : ''; ?>"></i><?php } ?></th>
                                <th><a href="<?php echo $url . ($order == 4 && $sentido != 'desc' ? '&sentido=desc' : ''); ?>&order=4">stock</a> <?php if ($order == 4) { ?><i class="fas fa-sort-alpha-down<?php echo ($sentido === 'desc') ? '-alt' : ''; ?>"></i><?php } ?></th>
                                <th>PVP</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            for ($i = 0; $i < count($data); $i++) {
                            ?>
                                <tr id="row-<?php echo $data[$i]['codigo']; ?>">
                                    <td><?php echo $data[$i]['codigo'];  ?></td>
                                    <td><?php echo $data[$i]['nombre'];  ?></td>
                                    <td><?php echo $data[$i]['proveedor'];  ?></td>
                                    <td><?php echo $data[$i]['nombre_categoria'];  ?></td>
                                    <td><?php echo $data[$i]['stock'];  ?></td>
                                    <td><?php echo $data[$i]['coste'] * $data[$i]['margen'] * (1 + $data[$i]['iva'] / 100);  ?></td>
                                    <td align="center"><a class="btn btn-clock btn-outline-primary" href="./?controller=producto&action=edit&codigo=<?php echo $data[$i]['codigo'];  ?>"><i class="fas fa-edit"></i></a>
                                        <?php
                                        if (\Com\Daw2\Helpers\Utils::contains($_SESSION['usuario']['permisos']['Proveedor'], 'd')) {
                                        ?>
                                            <a class="btn btn-clock btn-outline-danger" href="./?controller=producto&action=delete&codigo_del=<?php echo $data[$i]['codigo'];  ?>"><i class="fas fa-trash"></i></a>
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
                    <div class="col-12 mt-3">
                        <nav aria-label="Paginador">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo $urlPagina.'&pag=1';?>"><i class="fas fa-angle-double-left"></i></a>
                                </li>
                                <?php
                                if($pag == 1){
                                    $inicial = 1;
                                }
                                elseif($pag == $numPaginas){
                                    $inicial = $numPaginas - 2;
                                    if($inicial < 1){
                                        $inicial = 1;
                                    }
                                }
                                else{
                                    $inicial = $pag -1;
                                }
                                $final = $inicial + 2;
                                if($final > $numPaginas){
                                    $final = $numPaginas;
                                }
                                for($i = $inicial; $i <= ($final); $i++){
                                    ?>
                                    <li class="page-item <?php echo ($i == $pag) ? 'active' : ''; ?>"><a class="page-link" href="<?php echo $urlPagina.'&pag='.$i;?>"><?php echo $i; ?></a></li>
                                <?php
                                }
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo $urlPagina.'&pag='.$numPaginas;?>"><i class="fas fa-angle-double-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                <?php
                } else {
                ?>
                    <div class="callout callout-info">
                        <h5>Sin Proveedores</h5>
                        <p>No existen proveedores dados de alta que cumplan los requisitos. Pulse aquí para <a href="?controller=producto&action=new">crear un nuevo producto.</a></p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!--<script src="./vendor/jquery/jquery.min.js"></script>-->