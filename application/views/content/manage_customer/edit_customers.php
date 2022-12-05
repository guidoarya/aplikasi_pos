<!-- Main content -->
<section class="content">
    <div id="failed" data-flash="<?= $this->session->flashdata('failed') ?>"></div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit Customers</h3>
            <div class="pull-right">
                <a href="<?= site_url('customers') ?>" class="btn btn-warning btn-sm">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?= site_url('customers/update') ?>" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <input type="hidden" name="id_customer" value="<?= $customer['id_customer']?>" >
                            <div class="form-group">
                                <label>Name Customer *</label>
                                <input type="text" class="form-control" name="name_customer" value="<?= $customer['name_customer'] ?>" placeholder="Name customer is required" required>
                            </div>
                            <div class="form-group">
                                <label>Gender *</label>
                                <select name="gender" class="form-control" required>
                                    <option value="<?= ($customer['gender'] == 'L' ? 'L' : 'P') ?>"><?= ($customer['gender'] == 'L' ? 'Laki - Laki' : 'Perempuan') ?></option>
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Phone *</label>
                                <input type="number" class="form-control" name="phone" value="<?= $customer['phone'] ?>" placeholder="Phone is required" required minlength="0">
                            </div>
                            <div class="form-group">
                                <label>Address *</label>
                                <textarea name="address" class="form-control" height="10" placeholder="Address is required" required><?= $customer['address'] ?></textarea>
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