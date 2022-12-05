<!-- Main content -->
<section class="content">
    <div id="failed" data-flash="<?= $this->session->flashdata('failed') ?>"></div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add <?= $title ?></h3>
            <div class="pull-right">
                <a href="<?= site_url('items') ?>" class="btn btn-warning btn-sm">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?= site_url('items/save') ?>" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Barcode Item *</label>
                                <input type="text" class="form-control" name="barcode_item" placeholder="Barcode is required" required>
                            </div>
                            <div class="form-group">
                                <label>Name Item *</label>
                                <input type="text" class="form-control" name="name_item" placeholder="Name Items is required" required>
                            </div>
                            <div class="form-group">
                                <label>Unit *</label>
                                <select name="id_unit" class="form-control" required>
                                    <option value="">-- Select Unit --</option>
                                    <?php foreach ($unit as $units) { ?>
                                        <option value="<?= $units->id_unit ?>"><?= $units->name_unit ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Category *</label>
                                <select name="id_category" class="form-control" required>
                                    <option value="">-- Select Category --</option>
                                    <?php foreach ($category as $categorys) { ?>
                                        <option value="<?= $categorys->id_category ?>"><?= $categorys->name_category ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Price *</label>
                                <input type="text" class="form-control" name="price" placeholder="Price is required" required>
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