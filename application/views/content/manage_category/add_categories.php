<!-- Main content -->
<section class="content">
    <div id="failed" data-flash="<?= $this->session->flashdata('failed') ?>"></div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add <?= $title ?></h3>
            <div class="pull-right">
                <a href="<?= site_url('customers') ?>" class="btn btn-warning btn-sm">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?= site_url('categories/save') ?>" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Name Category *</label>
                                <input type="text" class="form-control" name="name_category" placeholder="Name Category is required" required>
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