<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-filter"></i> Filtros</h6>                                    
            </div>
            <form action="/" method="get">
                <input type="hidden" name="controller" value="<?php echo $_GET['controller']; ?>" />
                <input type="hidden" name="action" value="<?php echo isset($_GET['action']) ? $_GET['action'] : ''; ?>" />
                <div class="card-body"> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tipo</label>
                                <select class="form-control" name="tipo">
                                  <option value="">Seleccione un tipo</option>
                                  <?php
                                  foreach($roles as $row){
                                  ?>
                                    <option value="<?php echo $row['rol']; ?>" <?php echo $row['rol'] === $_GET['tipo'] ? 'selected' : ''; ?>><?php echo ucfirst($row['rol']); ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario" value="<?php echo isset($_GET['username']) ? filter_var($_GET['username'], FILTER_SANITIZE_SPECIAL_CHARS) : ''; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">                        
                    <a href="./?controller=Usuario" class="btn btn-danger float-right " value="reset">Resetear</a>
                    <button type="submit" name="opcion" class="btn btn-primary mr-3 float-right" value="filtrar"><i class="fas fa-search"></i> Filtrar</button>
                </div>
            </form>
        </div>
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $div_title; ?></h6>                                    
            </div>
            <div class="card-body">  
                <table id="usuariosTable" class="table table-bordered table-striped  dataTable">                    
                    <thead>
                        <tr>
                            <th>Nombre de usuario</th>
                            <th>Tipo</th>
                            <th>Salario</th>
                            <th>Cotización</th>
                            <th>Salario Neto</th>
                        </tr>
                    </thead>
                    <tbody>                                                
                            <?php 
                            foreach($data as $usuario){
                                ?>
                            <tr>
                                <td><?php echo $usuario->getUsername(); ?></td>
                                <td><?php echo $usuario->getRol(); ?></td>
                                <td><?php echo number_format($usuario->getSalarioBruto(), 2, ',', '.'); ?></td>
                                <td><?php echo $usuario->getRetencionIRPF(); ?>%</td>
                                <td><?php echo number_format($usuario->getSalarioNeto(), 2, ',', '.'); ?></td>
                            </tr>  
                                <?php
                            }
                            ?>                                   
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</div>
<!--<script src="./vendor/jquery/jquery.min.js"></script>-->
