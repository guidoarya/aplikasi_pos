<!-- Main content -->
<section class="content">
  <div id="succs" data-flash="<?= $this->session->flashdata('success') ?>"></div>
  <div id="failed" data-flash="<?= $this->session->flashdata('failed') ?>"></div>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Users</h3>
      <div class="pull-right">
        <a href="<?= site_url('manage_users/add') ?>" class="btn btn-primary btn-sm">
          <i class="fa fa-user-plus"></i> Create
        </a>
      </div>
    </div>
    <div class="box-body" style="overflow: scroll;">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th style="width: 100px;">Picture</th>
            <th>Name</th>
            <th>Username</th>
            <th>Address</th>
            <th>Status Active</th>
            <th>Role Access</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($user as $users) { ?>
            <tr>
              <td style="width: 10px"><?= $no++ ?></td>
              <td><img src="<?= base_url() ?>assets/media/img_user/<?= $users->picture ?>" alt="" width="70px" height="70px" class="img-rounded"></td>
              <td><?= $users->name ?></td>
              <td><?= $users->username ?></td>
              <td><?= $users->address ?></td>
              <?php if ($users->role == 'Admin') { ?>
                <td><span class="badge bg-green"><?= $users->status_active ?></span></td>
              <?php } else { ?>
                <td>
                  <?php if ($users->status_active == 'Active') { ?>
                    <a href="<?= site_url('manage_users/non_active_account/' . $users->id_user) ?>" alt="non aktifkan"><span class="badge bg-green"><?= $users->status_active ?></span></a>
                  <?php } else { ?>
                    <a href="<?= site_url('manage_users/active_account/' . $users->id_user) ?>" alt="aktifkan"><span class="badge bg-red"><?= $users->status_active ?></span></a>
                  <?php } ?>
                </td>
              <?php } ?>
              <td><span class="label label-default"><?= $users->role ?></span></td>
              <td>
                <a href="<?= site_url('manage_users/edit/' . $users->id_user) ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Update</a>
                <?php if ($users->role != 'Admin') { ?>
                  <a href="<?= site_url('manage_users/delete/' . $users->id_user) ?>" id="btn-delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                <?php } ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

</section>
<!-- /.content -->