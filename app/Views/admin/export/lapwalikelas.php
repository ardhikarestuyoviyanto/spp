<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Rekap Pembayaran Wali Kelas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Rekap Pembayaran Wali Kelas</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <?php use App\Models\ModelAdmin; $modelss = new ModelAdmin();?>
    <section class="content">
      <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    Rekap Pembayaran Wali Kelas
                </div>
                <div class="card-body">

                <form action="<?php echo base_url('export/export_lap_wali_kelas') ?>" method="GET">
                    <label for="nama_kelas" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                    <div class="mb-3">
                    <input type="hidden" name="rekap" value="true">
                    <?php if(isset($_GET['tahun'])){ ?>
                        <select class="form-control" aria-label="Default select example" required name="tahun" id="tahun">
                            <option value="">- Pilih Tahun Ajaran -</option>
                            <?php foreach ($tahun_ajaran as $x): ?>
                            <?php if($_GET['tahun'] == $x->tahun_ajaran){ ?>
                            <option selected value="<?php echo $x->tahun_ajaran; ?>"><?php echo $x->tahun_ajaran; ?></option>
                            <?php }else{ ?>
                            <option value="<?php echo $x->tahun_ajaran; ?>"><?php echo $x->tahun_ajaran; ?></option>
                            <?php } ?>
                            <?php endforeach; ?>
                        </select>
                    <?php }else{ ?>
                        <select class="form-control" aria-label="Default select example" required name="tahun" id="tahun">
                            <option value="">- Pilih Tahun Ajaran -</option>
                            <?php foreach ($tahun_ajaran as $x): ?>
                            <option value="<?php echo $x->tahun_ajaran; ?>"><?php echo $x->tahun_ajaran; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php } ?>
                    </div>

                    <label for="nama_kelas" class="col-sm-2 col-form-label">Pilih Kelas</label>
                    <div class="mb-3">
                    <?php if(isset($_GET['kelas'])){ ?>
                        <select class="form-control" aria-label="Default select example" required name="kelas" id="kelas">
                            <option value="">- Pilih Kelas -</option>
                            <?php foreach ($kelas as $x): ?>
                            <?php if($_GET['kelas'] == $x->id_kelas){ ?>
                            <option selected value="<?php echo $x->id_kelas; ?>"><?php echo $x->nama_kelas; ?></option>
                            <?php }else{ ?>
                            <option value="<?php echo $x->id_kelas; ?>"><?php echo $x->nama_kelas; ?></option>
                            <?php } ?>
                            <?php endforeach; ?>
                        </select>
                    <?php }else{ ?>
                        <select class="form-control" aria-label="Default select example" required name="kelas" id="tahun">
                            <option value="">- Pilih Kelas -</option>
                            <?php foreach ($kelas as $x): ?>
                            <option value="<?php echo $x->id_kelas; ?>"><?php echo $x->nama_kelas; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php } ?>
                    </div>
                    

                    <label for="nama_kelas" class="col-sm-2 col-form-label">Dari Tanggal</label>
                    <div class="mb-3">
                        <input type="date" name="start" id="" class="form-control" required>
                    </div>

                    <label for="nama_kelas" class="col-sm-2 col-form-label">Sampai Tanggal</label>
                    <div class="mb-3">
                        <input type="date" name="finish" id="" class="form-control" required value="<?php echo date('Y-m-d') ?>">
                    </div>

                    <label for="nama_kelas" class="col-sm-2 col-form-label">Option</label>
                    <div class="mb-3">
                    <select class="form-control" aria-label="Default select example" required name="type" id="type">
                        <option value="show">- Lihat Dulu -</option>
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

        <?php if(isset($_GET['kelas'])): ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    Preview Tampilan
                </div>
                <div class="card-body">
                <table width="100%">
                  <tbody>
                      <tr class="text-bold">
                      <td>Tahun Ajaran</td>
                      <td>:</td>
                      <td><?php echo urldecode($_GET['tahun']) ?></td>
                    </tr>
                      <tr class="text-bold">
                      <td width="200px">Kelas</td>
                      <td width="10px">:</td>
                      <td><?php echo $namakelas; ?></td>
                    </tr>
                    <tr class="text-bold">
                      <td>Periode</td>
                      <td>:</td>
                      <td><?php echo date("d F Y", strtotime($_GET['start']))." s.d ".date("d F Y", strtotime($_GET['finish'])); ?></td>
                    </tr>
                  </tbody>
                </table>
                <br>
                  <table border="1" class="table table-bordered">
                      <tr>
                          <td rowspan="2" style="vertical-align : middle;text-align:center;">No</td>
                          <td rowspan="2" style="vertical-align : middle;text-align:center;">Nama Siswa</td>
                          <td colspan="<?php echo (count($bulanan) + count($bebas)) * 2; ?>" style="vertical-align : middle;text-align:center;">Jenis Pembayaran</td>  
                      </tr>
                      <tr>
                          <?php foreach ($bulanan as $x): ?>
                          <td style="vertical-align : middle;text-align:center;"><?php echo $x->nama_pembayaran; ?></td>
                          <td style="vertical-align : middle;text-align:center;"></td>
                          <?php endforeach; ?>
                          <?php foreach ($bebas as $x): ?>
                          <td style="vertical-align : middle;text-align:center;"><?php echo $x->nama_pembayaran; ?></td>
                          <?php endforeach; ?>
                          <td style="vertical-align : middle;text-align:center;">Total Tagihan</td>
                      </tr>
                      <?php $i=1; foreach ($siswa as $z): ?>
                      <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $z->nama_siswa; ?></td>
                          <?php $total_tagihan = 0; foreach ($bulanan as $x): ?>
                          <?php $res = $modelss->detailPembayaranBulanan($z->nis, $x->id_pembayaran, $_GET['start'], $_GET['finish']); ?>
                          <?php $total_tagihan = $total_tagihan + $res['total_tagihan'] ?>
                          <td><?php if($res['total_tagihan'] == 0 && $res['total_bayar'] == 0){echo "Rp. ".number_format(0 ,2,',','.'); }else if($res['total_tagihan'] == $res['total_bayar']){echo "Lunas"; }else{echo "Rp. ".number_format($res['total_tagihan'] - $res['total_bayar'] ,2,',','.');} ?></td>
                          <td><?php if($res['bulan_start'] != "Lunas"){echo $res['bulan_start']; } if($res['bulan_finish'] != "Lunas"){echo " - ".$res['bulan_finish']; }  ?></td>
                          <?php endforeach; ?>

                          <?php foreach ($bebas as $y): ?>
                          <?php $res = $modelss->detailPembayaranbebas($z->nis, $y->id_pembayaran, $_GET['start'], $_GET['finish']); ?>
                          <?php $total_tagihan = $total_tagihan + $res['total_tagihan'] ?>
                          <td><?php if($res['total_tagihan'] == 0 && $res['total_bayar'] == 0){echo "Rp. ".number_format(0 ,2,',','.'); }else if($res['total_tagihan'] == $res['total_bayar']){echo "Lunas"; }else{echo "Rp. ".number_format($res['total_tagihan'] - $res['total_bayar'] ,2,',','.');} ?></td>
                          <?php endforeach; ?>
                          <td><?php echo "Rp. ".number_format($total_tagihan ,2,',','.'); ?></td>
                      </tr>
                      <?php endforeach;  ?>


                  </table><br>
                  <small>*) Data diatas menunjukan jumlah tunggakan yang harus dibayar siswa.</small><br>
                  <small>*) Rp. 0, menunjukkan siswa tidak menerima tagihan.</small>
                </div>
            </div>
        </div>
      </div>
      <?php endif; ?>
    </section>
  </div>

<?= $this->endSection('content'); ?>