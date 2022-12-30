<!-- Main content -->
<section class="content">
  <div id="succs" data-flash="<?= $this->session->flashdata('success') ?>"></div>
  <div id="failed" data-flash="<?= $this->session->flashdata('failed') ?>"></div>

  <div class="box">
    <div class="box-header">
      <h3 class="box-title">List <?= $title ?></h3>
      <div class="pull-right">
        <a href="<?= site_url('items/add') ?>" class="btn btn-primary btn-sm">
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
            <th>Name Item</th>
            <th>Unit</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- <?php $no = 1;
          foreach ($item as $items) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $items->barcode_item ?> <br><a href="<?= site_url('items/barcode_generate/'.$items->id_item) ?>" class="btn btn-xs btn-default">Generate Barcode</a></td>
              <td><?= $items->name_item ?></td>
              <td><?= $items->name_unit ?></td>
              <td><?= $items->name_category ?></td>
              <td>Rp. <?= number_format(($items->price),0,',','.') ?>,-</td>
              <td><?= $items->stock ?></td>
              <td>
                <a href="<?= site_url('items/edit/'.$items->id_item) ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Update</a>
                <a href="<?= site_url('items/delete/' . $items->id_item) ?>" id="btn-delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
              </td>
            </tr>
          <?php } ?> -->
        </tbody>
      </table>
    </div>
  </div>

</section>
<!-- /.content -->

<script>
    $(document).ready(function() {
        $('#example1').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('items/get_ajax') ?>",
                "type": "POST"
            },
            "columnDefs": [
                {
                    "targets": [5, 6],
                    "className": 'text-right'
                },
                {
                    "targets": [-1],
                    "className": 'text-center'
                },
                {
                    "targets": [3, -1],
                    "orderable": false
                }
            ]
        })
    })
</script>