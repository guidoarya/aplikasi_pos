<!-- Main content -->
<section class="content">
    <div id="failed" data-flash="<?= $this->session->flashdata('failed') ?>"></div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add Users</h3>
            <div class="pull-right">
                <a href="<?= site_url('manage_users') ?>" class="btn btn-warning btn-sm">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?= site_url('manage_users/save') ?>" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Username *</label>
                                <input type="text" class="form-control" name="username" placeholder="Username is required">
                            </div>
                            <div class="form-group">
                                <label>Name *</label>
                                <input type="text" class="form-control" name="name" placeholder="Name is required">
                            </div>
                            <div class="form-group">
                                <label>Password *</label>
                                <input type="password" class="form-control" name="password" placeholder="Password is required">
                            </div>
                            <div class="form-group">
                                <label>Password Confirmation *</label>
                                <input type="password" class="form-control" name="password_" placeholder="Confirm Password is required">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control" height="10" placeholder="Address is optional"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Role *</label>
                                <select name="role" class="form-control">
                                    <option value="">-- Select a Role --</option>
                                    <option value="Kasir">Kasir</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Add Picture</label>
                                <input type="file" name="picture">

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