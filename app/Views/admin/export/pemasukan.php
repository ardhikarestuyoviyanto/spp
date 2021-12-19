<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelAdmin; $modelss = new ModelAdmin();?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pemasukkan Keuangan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Pemasukkan Keuangan</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    Pemasukkan Keuangan
                </div>
                <div class="card-body">

                <form action="<?php echo base_url('export/export_pemasukan_pdf') ?>" method="GET">
                    

                    <label for="nama_kelas" class="col-sm-2 col-form-label">Dari Tanggal</label>
                    <div class="mb-3">
                        <input type="date" name="start" id="" class="form-control" required value="<?php if(isset($_GET['start'])){echo $_GET['start']; }else{  } ?>">
                    </div>

                    <label for="nama_kelas" class="col-sm-2 col-form-label">Sampai Tanggal</label>
                    <div class="mb-3">
                        <input type="date" name="finish" id="" class="form-control" required value="<?php if(isset($_GET['finish'])){echo $_GET['finish']; }else{ echo date('Y-m-d'); } ?>">
                    </div>

                    <label for="nama_kelas" class="col-sm-2 col-form-label">Tipe Export</label>
                    <div class="mb-3">
                    <select class="form-control" aria-label="Default select example" required name="type" id="type">
                        <option selected value="prev">- Lihat Dulu -</option>
                        <option value="pdf">- PDF -</option>
                        <option value="excel">- Excle -</option>
                    </select>
                    </div>
                </div>
                <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Lihat</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>

        <?php if(isset($_GET['start'])): ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    Preview Pemasukan Keuangan
                </div>
                <div class="card-body">

                <table width="100%">
                  <tbody>
                    <tr class="text-bold">
                    <td width="200px">Periode</td>
                    <td width="10px">:</td>
                    <td><?php echo date("d F Y", strtotime($_GET['start']))." s.d ".date("d F Y", strtotime($_GET['finish'])); ?></td>
                  </tr>
                </tbody>
                </table>
                <hr>
                <table class="table table-striped table-bordered" id="Data">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Kelas</th>
                          <th>Nama Siswa</th>
                          <th>Total Pembayaran</th>
                      </tr>
                  </thead>
                    <tbody>
                    <?php $i=1; $total = 0; foreach ($siswa as $x):  ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $x->nama_kelas; ?></td>
                        <td><?php echo $x->nama_siswa; ?></td>
                        <td><?php echo "Rp. ".number_format($modelss->getBayarBebas($x->nis, $_GET['start'], $_GET['finish']) + $modelss->getBayarBulanan($x->nis,  $_GET['start'], $_GET['finish']) ,2,',','.'); ?></td>
                    </tr>
                    <?php $total = $total + $modelss->getBayarBebas($x->nis,  $_GET['start'], $_GET['finish']) + $modelss->getBayarBulanan($x->nis,  $_GET['start'], $_GET['finish']); endforeach; ?>

                    </tbody>
                </table>


                </div>
                <div class="card-footer">
                  <table width="100%">
                    <tbody>
                      <tr class="text-bold text-red">
                      <td width="200px">Total Pemasukan</td>
                      <td width="10px">:</td>
                      <td><?php echo "Rp. ".number_format($total ,2,',','.'); ?></td>
                    </tr>
                  </tbody>
                  </table>

                  </div>
            </div>

        </div>
        <?php endif; ?>
      </div>
    </section>
  </div>
<script>
  $('#Data').DataTable();
</script>
<?= $this->endSection('content'); ?>