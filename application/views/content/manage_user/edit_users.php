<!-- Main content -->
<section class="content">
    <div id="failed" data-flash="<?= $this->session->flashdata('failed') ?>"></div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit Users</h3>
            <div class="pull-right">
                <a href="<?= site_url('manage_users') ?>" class="btn btn-warning btn-sm">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?= site_url('manage_users/update') ?>" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                            <div class="form-group">
                                <label>Username *</label>
                                <input type="text" <?= ($user['role'] == 'Admin' ? 'disabled' : '') ?> class="form-control" name="username" value="<?= $user['username'] ?>" placeholder="Username is required" required>
                            </div>
                            <div class="form-group">
                                <label>Name *</label>
                                <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>" placeholder="Name is required" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label><small> (empty if not replaced)</small>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password Confirmation</label>
                                <input type="password" name="password_" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control" height="10" placeholder="Address is optional"><?= $user['address'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Role *</label>
                                <select name="role" <?= ($user['role'] == 'Admin' ? 'disabled' : '') ?> class="form-control" required>
                                    <option value="<?= $user['role'] ?>"><?= $user['role'] ?></option>
                                    <!-- <option value="Admin">Admin</option> -->
                                    <!-- <option value="Kasir">Kasir</option> -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Change Picture</label>
                                <input type="file" name="picture" id="exampleInputFile">
                                <p class="help-block">Max Size 10mb</p>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success mr"><i class="fa fa-send"></i> Save</button>
                            <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>