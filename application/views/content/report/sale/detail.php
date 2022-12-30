<section class="content">
    <div class="row">

        <div class="col-md-6">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align: top; width: 30%">
                                <label for="date">Date</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="date" value="<?= $sales['date'] ?>" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="date">Kasir</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" value="<?= $sales['name'] ?>" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="date">Customer</label>
                            </td>
                            <td>
                                <div>
                                    <input type="text" value="<?= $sales['name_customer'] == '' ? 'Umum' : $sales['name_customer'] ?>" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>



        <div class="col-md-6">
            <div class="box box-widget">
                <div class="box-body">
                    <div align="right">
                        <h4>Invoice <b> <span><?= $sales['invoice_sale'] ?></span></b></h4>
                        <h1><b><span style="font-size: 50pt;">Rp. <?= number_format(($sales['grand_total']), 0, ',', '.') ?></span></b></h1>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
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
                                    <input readonly type="number" value="<?= $sales['sub_total'] ?>" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="date">Voucher</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input readonly type="number" value="0" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="date">Grand Total</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input readonly type="number" value="<?= $sales['sub_total'] ?>" class="form-control">
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
                                    <input type="number" value="<?= $sales['cash'] ?>" readonly class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="date">Change</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input readonly type="number" value="<?= $sales['remaining'] ?>" readonly class="form-control">
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
                                    <textarea rows="3" class="form-control" readonly><?= $sales['note'] ?></textarea>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div>
                <a href="<?= site_url('reports/sale') ?>" class="btn btn-warning btn-sm btn-flat"><i class="fa fa-refresh"></i> Back</a>
            </div>
            <br>
            <div>
                <a target="_bank" href="<?= site_url('reports/print/' . $sales['invoice_sale']) ?>" class="btn btn-success btn-lg btn-flat"><i class="fa fa-print"></i> Print Transaction</a>
            </div>
        </div>

    </div>

</section>

