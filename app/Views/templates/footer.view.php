</section>
    <!-- /.content -->
  </div>
  
<!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>DWES 2021</strong>    
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="assets/js/adminlte.js"></script>
<?php
if(isset($js) && is_array($js)){
    foreach($js as $jsFile){
        echo '<script src="'.$jsFile.'"></script>';
    }
}
?>
</body>
</html>
