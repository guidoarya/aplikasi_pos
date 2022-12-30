<section class="content">
    <div class="row">

        <div class="col-md-4">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align: top; width: 30%">
                                <label for="item">Item Product</label>
                            </td>
                            <td>
                                <form action="<?= site_url('sale/add_cart') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group input-group">
                                        <input type="hidden" name="invoice" value="<?= $invoice ?>" required>
                                        <input readonly type="text" id="product_item" class="form-control" required>
                                        <input readonly type="hidden" name="barcode_item" id="barcode_item" class="form-control" required>
                                        <input readonly type="hidden" name="product_item" id="name_item" class="form-control" required>
                                        <input readonly type="hidden" name="price" id="price" class="form-control" required>
                                        <input readonly type="hidden" name="stock" id="stock" class="form-control" required>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="date">Qty</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input readonly type="hidden" id="qty" class="form-control" required>
                                    <input type="number" name="qty" value="1" min="1" id="" class="form-control" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-cart-plus"></i> Add
                                    </button>
                                </div>
                            </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align: top; width: 30%">
                                <label for="date">Date</label>
                            </td>
                            <td>
                                <form action="<?= site_url('sale/pay') ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="invoice" value="<?= $invoice ?>" required>
                                    <div class="form-group">
                                        <input type="date" name="date" value="<?= date('Y-m-d') ?>" id="" class="form-control" readonly>
                                    </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="date">Kasir</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="hidden" name="id_user" value="<?= $sess['id_user'] ?>">
                                    <input type="text" value="<?= $sess['name'] ?>" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="date">Customer</label>
                            </td>
                            <td>
                                <div>
                                    <select name="id_customer" class="form-control">
                                        <option value="">Umum</option>
                                        <?php foreach ($customer as $customers) { ?>
                                            <option value="<?= $customers->id_customer ?>"><?= $customers->name_customer ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>



        <div class="col-md-4">
            <div class="box box-widget">
                <div class="box-body">
                    <div align="right">
                        <h4>Invoice <b> <span id="invoice"><?= $invoice ?></span></b></h4>
                        <h1><b><span id="grand_total2" style="font-size: 50pt;">Rp. <?= number_format(($sub_total), 0, ',', '.') ?></span></b></h1>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="box box-widget">
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Barcode Item</th>
                                <th>Product Item</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($cart) {
                                $no = 1;
                                foreach ($cart as $carts) {
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $carts->barcode_item ?></td>
                                        <td><?= $carts->product_item ?></td>
                                        <td>Rp. <?= number_format(($carts->price), 0, ',', '.') ?></td>
                                        <td><?= $carts->qty ?></td>
                                        <td>Rp. <?= number_format(($carts->total), 0, ',', '.') ?></td>
                                        <td class="text-center">
                                            <a href="<?= site_url() ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Update</a>
                                            <a href="<?= site_url('sale/del_cart/' . $carts->barcode_item) ?>" id="btn-delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada item</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align: top; width: 30%">
                                <label for="date">Sub Total</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input readonly type="number" name="sub_total" value="<?= $sub_total ?>" id="sub_total" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="date">Voucher</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select name="name_vocher" class="form-control">
                                        <option value="">None</option>
                                        <?php foreach ($voucher as $vouchers) { ?>
                                            <option value="<?= $vouchers->id_voucher ?>"><?= $vouchers->name_voucher ?> / <?= $vouchers->discount ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="date">Grand Total</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input readonly type="number" name="" value="0" id="grand_total" class="form-control">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align: top; width: 30%">
                                <label for="date">Cash</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="cash" name="cash" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="date">Change</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input readonly type="number" name="change" id="change" class="form-control">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="date">Note</label>
                            </td>
                            <td>
                                <div>
                                    <textarea name="note" rows="3" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div>
                <a href="<?= site_url('sale/del_sale') ?>" id="btn-delete" class="btn btn-warning btn-sm btn-flat"><i class="fa fa-refresh"></i> Cancel</a>
                <!-- <a href="<?= site_url('sale/del_cart/' . $carts->barcode_item) ?>" id="btn-delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a> -->
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-success btn-lg btn-flat" disabled id="btnPay"><i class="fa fa-send"></i> Submit Payment</button>
                </form>
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
                                    <button class="btn btn-info btn-xs" id="select" data-id="<?= $items->id_item ?>" data-barcode="<?= $items->barcode_item ?>" data-name="<?= $items->name_item ?>" data-price="<?= $items->price ?>" data-stock="<?= $items->stock ?>"><i class="fa fa-check"></i> Select</button>
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
            let price = $(this).data('price');
            let stock = $(this).data('stock');
            $('#id_item').val(id_item);
            $('#product_item').val(name_item + ' / Stock : ' + stock + ' [' + barcode_item + ']');
            $('#barcode_item').val(barcode_item);
            $('#name_item').val(name_item);
            $('#price').val(price);
            $('#stock').val(stock);
            $('#modal-item').modal('hide')
        })

        $("#cash").keyup(function() {
            count = $("#cash").val() - $("#sub_total").val()
            $("#change").val(count)

            var btnPay = $("#btnPay")

            if (count >= 0) {
                btnPay.removeAttr("disabled")
            } else {
                btnPay.attr("disabled", "disabled")
            }
        })
    })
</script>