<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Barcode Item : <?= $item['name_item'] ?></h3>
            <div class="pull-right">
                <a href="<?= site_url('items') ?>" class="btn btn-warning btn-sm">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    echo $gambar_barcode;
                    echo $item['barcode_item'];
                    ?>
                    <br><br>
                    <a href="<?= site_url('items/cetak_barcode/' . $item['barcode_item']) ?>" target="_blank" class="btn btn-xs btn-default">Print</a>
                </div>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">QR Item : <?= $item['name_item'] ?></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <img src="<?= site_url('items/qr/' . $item['barcode_item']) ?>" alt="">
                    <br><br>
                    <a href="<?= site_url('items/qr/' . $item['barcode_item']) ?>" target="_blank" class="btn btn-xs btn-default">Print</a>
                </div>
            </div>
        </div>
    </div>

</section>