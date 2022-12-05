<!-- Main content -->
<section class="content">
  <div id="succs" data-flash="<?= $this->session->flashdata('success') ?>"></div>
  <div id="failed" data-flash="<?= $this->session->flashdata('failed') ?>"></div>

  <div class="box">
    <div class="box-header">
      <h3 class="box-title">List Data Customer</h3>
      <div class="pull-right">
        <a href="<?= site_url('customers/add') ?>" class="btn btn-primary btn-sm">
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
            <th>Name Customer</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($customer as $customers) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $customers->name_customer ?></td>
              <td><?= ($customers->gender == 'P' ? 'Perempuan' : 'Laki - Laki') ?></td>
              <td><?= $customers->phone ?></td>
              <td><?= $customers->address ?></td>
              <td>
                <a href="<?= site_url('customers/edit/'.$customers->id_customer) ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Update</a>
                <a href="<?= site_url('customers/delete/' . $customers->id_customer) ?>" id="btn-delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

</section>
<!-- /.content -->