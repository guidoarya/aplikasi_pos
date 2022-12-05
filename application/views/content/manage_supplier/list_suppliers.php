<!-- Main content -->
<section class="content">
  <div id="succs" data-flash="<?= $this->session->flashdata('success') ?>"></div>
  <div id="failed" data-flash="<?= $this->session->flashdata('failed') ?>"></div>

  <div class="box">
    <div class="box-header">
      <h3 class="box-title">List Data Suppliers</h3>
      <div class="pull-right">
        <a href="<?= site_url('suppliers/add') ?>" class="btn btn-primary btn-sm">
          <i class="fa fa-user-plus"></i> Create
        </a>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th width="10px">No</th>
            <th>Name Supplier</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($supplier as $suppliers) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $suppliers->name_supplier ?></td>
              <td><?= $suppliers->phone ?></td>
              <td><?= $suppliers->address ?></td>
              <td><?= $suppliers->description ?></td>
              <td>
                <a href="<?= site_url('suppliers/edit/'.$suppliers->id_supplier) ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Update</a>
                <a href="<?= site_url('suppliers/delete/' . $suppliers->id_supplier) ?>" id="btn-delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

</section>
<!-- /.content -->