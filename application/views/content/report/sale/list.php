<!-- Main content -->
<section class="content">
    <div id="succs" data-flash="<?= $this->session->flashdata('success') ?>"></div>
    <div id="failed" data-flash="<?= $this->session->flashdata('failed') ?>"></div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List <?= $title ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <!-- <th>Qty</th> -->
                        <th>Payment</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($sale as $sales) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $sales->invoice_sale ?></td>
                            <td><?= $sales->name_customer == '' ? 'Umum' : $sales->name_customer ?></td>
                            <!-- <td class="text-right"><?= $sales->qty ?></td> -->
                            <td>Rp. <?= number_format(($sales->grand_total), 0, ',', '.') ?>,-</td>
                            <td class="text-center"><?= indonesian_date(($sales->date), 'd F Y') ?></td>
                            <td class="text-center">
                                <a href="<?= site_url('reports/detail_sale/' . $sales->invoice_sale) ?>" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Detail</a>
                                <a target="_bank" href="<?= site_url('reports/print/' . $sales->invoice_sale) ?>" class="btn btn-sm btn-danger"><i class="fa fa-print"></i> Print</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>