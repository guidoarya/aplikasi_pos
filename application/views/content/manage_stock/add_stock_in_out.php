<!-- Main content -->
<section class="content">
    <div id="failed" data-flash="<?= $this->session->flashdata('failed') ?>"></div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add <?= $title ?></h3>
            <div class="pull-right">
                <a href="<?= site_url($title == 'Stock in' ? 'stock-in' : 'stock-out') ?>" class="btn btn-warning btn-sm">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?= site_url('stock/processSave') ?>" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <input type="hidden" name="type" value="<?= $title == 'Stock in' ? 'in' : 'out' ?>">

                            <div class="form-group">
                                <label>Date *</label>
                                <input type="date" class="form-control" name="date" value="<?= date('Y-m-d') ?>" required>
                            </div>

                            <div>
                                <label>Barcode *</label>
                            </div>

                            <div class="form-group input-group">
                                <input type="hidden" name="id_item" id="id_item">
                                <input readonly type="text" name="barcode_item" id="barcode_item" class="form-control" required>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item"><i class="fa fa-search"></i></button>
                                </span>
                            </div>

                            <div class="form-group">
                                <label>Name Item *</label>
                                <input readonly type="text" class="form-control" name="name_item" id="name_item">
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>Unit Item</label>
                                        <input readonly type="text" name="name_unit" id="name_unit" class="form-control" value="-">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Initial Stock</label>
                                        <input readonly type="text" name="stock" id="stock" class="form-control" value="-">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label><?= $title == 'Stock in' ? 'Detail' : 'Info' ?> *</label>
                                <input type="text" name="detail" class="form-control" placeholder="Ex: Tambahan / Etc / dll" required>
                            </div>

                            <?php if($title == 'Stock in') { ?>

                            <div class="form-group">
                                <label>Supplier</label>
                                <select name="id_supplier" class="form-control">
                                    <option value="">-- Select Supplier --</option>
                                    <option value="">Umum</option>
                                    <?php foreach ($supplier as $suppliers) { ?>
                                        <option value="<?= $suppliers->id_supplier ?>"><?= $suppliers->name_supplier ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <?php } ?>

                            <div class="form-group">
                                <label>Qty *</label>
                                <input type="number" class="form-control" name="qty" min="1" required>
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

<div class="modal fade" id="modal-item">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Select Item Product</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Barcode</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th width="70px">Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($item as $items) { ?>
                            <tr>
                                <td><?= $items->barcode_item ?></td>
                                <td><?= $items->name_item ?></td>
                                <td><?= $items->name_unit ?></td>
                                <td class="text-right">Rp. <?= number_format(($items->price), 0, ',', '.') ?></td>
                                <td class="text-right"><?= $items->stock ?></td>
                                <td class="text-right">
                                    <button class="btn btn-info btn-xs" id="select" data-id="<?= $items->id_item ?>" data-barcode="<?= $items->barcode_item ?>" data-name="<?= $items->name_item ?>" data-unit="<?= $items->name_unit ?>" data-stock="<?= $items->stock ?>"><i class="fa fa-check"></i> Select</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            let id_item = $(this).data('id');
            let barcode_item = $(this).data('barcode');
            let name_item = $(this).data('name');
            let name_unit = $(this).data('unit');
            let stock = $(this).data('stock');
            $('#id_item').val(id_item);
            $('#barcode_item').val(barcode_item);
            $('#name_item').val(name_item);
            $('#name_unit').val(name_unit);
            $('#stock').val(stock);
            $('#modal-item').modal('hide')
        })
    })
</script>