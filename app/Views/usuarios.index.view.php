<div class="row">
    <div class="col-12">
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
