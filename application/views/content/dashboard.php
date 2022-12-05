<!-- Main content -->
<section class="content">

  <!-- Info boxes -->
  <div class="row">
    <a href="<?= site_url('items') ?>">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-th"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">ITEM</span>
            <span class="info-box-number"><?= $citem ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
    </a>
    <!-- /.col -->
    <a href="<?= site_url('suppliers') ?>">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-truck"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">SUPLIERS</span>
            <span class="info-box-number"><?= $csupplier ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
    </a>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <a href="<?= site_url('customers') ?>">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">CUSTOMERS</span>
            <span class="info-box-number"><?= $ccustomer ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
    </a>
    <!-- /.col -->
    <a href="<?= site_url('manage_users') ?>">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-user-plus"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">USERS</span>
            <span class="info-box-number"><?= $cuser ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
    </a>
    <!-- /.col -->
  </div>
  <!-- /.row -->

</section>
<!-- /.content -->