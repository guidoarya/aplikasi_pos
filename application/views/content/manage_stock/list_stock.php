<!-- Main content -->
<section class="content">
    <div id="succs" data-flash="<?= $this->session->flashdata('success') ?>"></div>
    <div id="failed" data-flash="<?= $this->session->flashdata('failed') ?>"></div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List <?= $title ?></h3>
            <div class="pull-right">
                <?php if($title == 'Stock in') { ?>
                <a href="<?= site_url('stock-in/add') ?>" class="btn btn-primary btn-sm">
                <?php } elseif($title == 'Stock out') { ?>
                <a href="<?= site_url('stock-out/add') ?>" class="btn btn-primary btn-sm">
                <?php } ?>
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
                        <th>Barcode Item</th>
                        <th>Product Item</th>
                        <?php if($title == 'Stock in') { ?>
                        <th>Supplier</th>
                        <?php } ?>
                        <th>Qty</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($stock as $stocks) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $stocks->barcode_item ?></td>
                            <td><?= $stocks->name_item ?></td>
                            <?php if($title == 'Stock in') { ?>
                            <td><?= $stocks->name_supplier == '' ? 'Umum' : $stocks->name_supplier ?></td>
                            <?php } ?>
                            <td class="text-right"><?= $stocks->qty ?></td>
                            <td class="text-center"><?= indonesian_date(($stocks->date),'d F Y') ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-detail<?= $stocks->id_stock ?>"><i class="fa fa-eye"></i> Detail</button>
                                <a href="<?= site_url('stock/delete/' . $stocks->id_stock . '/'. $stocks->id_item . '/' . ($title == 'Stock in' ? 'in' : 'out')) ?>" id="btn-delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>

<?php foreach ($stock as $stocks) { ?>
<div class="modal fade" id="modal-detail<?= $stocks->id_stock ?>">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Stock <?= $title == 'Stock in' ? 'in' : 'out' ?> Detail</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th>Barcode</th>
                            <td><?= $stocks->barcode_item ?></td>
                        </tr>                        
                        <tr>
                            <th>Product Item</th>
                            <td><?= $stocks->name_item ?></td>
                        </tr>                        
                        <tr>
                            <th>Detail</th>
                            <td><?= $stocks->detail ?></td>
                        </tr>
                        <?php if($title == 'Stock in') { ?>                        
                        <tr>
                            <th>Name Supplier</th>
                            <td><?= $stocks->name_supplier == '' ? 'Umum' : $stocks->name_supplier ?></td>
                        </tr>                        
                        <?php } ?>
                        <tr>
                            <th>Qty</th>
                            <td><?= $stocks->qty ?></td>
                        </tr>                        
                        <tr>
                            <th>Date</th>
                            <td><?= indonesian_date(($stocks->date),'d F Y') ?></td>
                        </tr>                        
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php } ?>