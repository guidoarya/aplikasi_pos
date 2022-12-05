</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0
  </div>
  <strong>Copyright &copy; 2019 <a href="#">SaiTech</a>.</strong>
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?= base_url() ?>assets/code_template/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url() ?>assets/code_template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url() ?>assets/code_template/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/code_template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url() ?>assets/code_template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url() ?>assets/code_template/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/code_template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>assets/code_template/dist/js/demo.js"></script>
<!-- sweetalert2 -->
<script src="<?= base_url() ?>assets/sweetalert/sweetalert2.min.js"></script>

<script>
  // response success create, update and delete
  var succs = $('#succs').data('flash')
  if (succs) {
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: succs,
      showConfirmButton: false,
      timer: 1500
    })
  }

  // response error create, update and delete
  var failed = $('#failed').data('flash')
  if (failed) {
    Swal.fire({
      position: 'top-end',
      icon: 'error',
      title: failed,
      showConfirmButton: false,
      timer: 1500
    })
  }

  // validation delete
  $(document).on('click', '#btn-delete', function(e) {
    e.preventDefault()
    var link = $(this).attr('href')

    Swal.fire({
      title: 'Are you sure bro?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = link
      }
    })
  })
</script>

<script>
  $(document).ready(function() {
    $('.sidebar-menu').tree()
  })
</script>
<script>
  $(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    })
  })
</script>
</body>

</html>