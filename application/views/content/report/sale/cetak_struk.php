<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice <?= $sales['invoice_sale'] ?></title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <style>
      .item {
        font-size: 12px;
      }
    </style>
  </head>
  <body>
    <div class="containter-fluid">
      <div class="row mt-3">
        <div class="col-md-4">
          <center><h5>SaitechStore</h5></center>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <center><p>Jl. Didi Prawirakusumah</p></center>
          <center style="margin-top: -20px">
            ----------------------------------------------------
          </center>          
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <center><?= $sales['created_at'] ?></center>
          <div class="row" style="margin-top: -20px;">
            <div class="col ml-3">
              <br>
              <?= $sales['invoice_sale'] ?><br>
              Kasir : <?= $sales['name'] ?><br>
              Customer : <?= $sales['name_customer'] == '' ? 'Umum' : $sales['name_customer'] ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <center>
            ----------------------------------------------------
          </center>          
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="row item">
            <div class="col ml-3">
              <br>
              <?php
                  foreach ($cart as $carts) {
              ?>
                <?= $carts->product_item ?><br>
              <?php } ?>
            </div>
            <div class="col">
              <b>Harga x[qty]</b><br>
              <?php
                  foreach ($cart as $carts) {
              ?>
                <?= number_format(($carts->price), 0, ',', '.') ?> x[<?= $carts->qty ?>]<br>
              <?php } ?>
            </div>
            <div class="col">
              <b>Sub Total</b><br>
              <?php
                  foreach ($cart as $carts) {
              ?>
                <?= number_format(($carts->total), 0, ',', '.') ?><br>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <center>
            ----------------------------------------------------
          </center>          
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="row">
            <div class="col ml-3">
            </div>
            <div class="col">
              Grand Total<br>
              Cash<br>
              Change
            </div>
            <div class="col">
              <?= number_format(($sales['grand_total']), 0, ',', '.') ?><br>
              <?= number_format(($sales['cash']), 0, ',', '.') ?><br>
              <?= number_format(($sales['remaining']), 0, ',', '.') ?>
            </div>            
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <center>
            ----------------------------------------------------
          </center>          
        </div>
      </div>
      <div class="row mt-1">
        <div class="col-md-4">
          <center><h6>---- Terimakasih ----</h6></center>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4" style="margin-top: -10px;">
          <center><p>Sudah berbelanja di store kami :)</p></center>
        </div>
      </div>
    </div>
  </body>
</html>
