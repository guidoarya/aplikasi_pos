<!-- Main content -->
<section class="content">
    <div id="failed" data-flash="<?= $this->session->flashdata('failed') ?>"></div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit Supplier</h3>
            <div class="pull-right">
                <a href="<?= site_url('suppliers') ?>" class="btn btn-warning btn-sm">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?= site_url('suppliers/update') ?>" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <input type="hidden" name="id_supplier" value="<?= $supplier['id_supplier']?>" >
                            <div class="form-group">
                                <label>Name Supplier *</label>
                                <input type="text" class="form-control" name="name_supplier" value="<?= $supplier['name_supplier'] ?>" placeholder="Name Supplier is required" required>
                            </div>
                            <div class="form-group">
                                <label>Phone *</label>
                                <input type="number" class="form-control" name="phone" value="<?= $supplier['phone'] ?>" placeholder="Phone is required" required minlength="0">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control" height="10" placeholder="Address is required" required><?= $supplier['address'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" height="10" placeholder="Description is optional"><?= $supplier['description'] ?></textarea>
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