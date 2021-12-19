<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelAdmin; $modelss = new ModelAdmin();?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan Data SPP Bulanan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Laporan Data SPP Bulanan</li>
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
                  Laporan Data SPP
                </div>
                <div class="card-header" style="background-color: #f9f9f9;">

                  <form action="<?php echo base_url('admin/lapspp') ?>" method="GET">
                    <label for="nama_kelas" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                    <div class="mb-3">
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

                    <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Pembayaran</label>
                    <div class="mb-3">
                    <?php if(isset($_GET['pembayaran'])){ ?>
                        <select class="form-control" aria-label="Default select example" required name="pembayaran" id="tahun">
                            <option value="">- Pilih Nama Pembayaran -</option>
                            <?php foreach ($pembayaran as $x): ?>
                            <?php if($_GET['pembayaran'] == $x->id_pembayaran){ ?>
                            <option selected value="<?php echo $x->id_pembayaran; ?>"><?php echo $x->nama_pembayaran; ?></option>
                            <?php }else{ ?>
                            <option value="<?php echo $x->id_pembayaran; ?>"><?php echo $x->nama_pembayaran; ?></option>
                            <?php } ?>
                            <?php endforeach; ?>
                        </select>
                    <?php }else{ ?>
                      <select class="form-control" aria-label="Default select example" required name="pembayaran" id="tahun">
                            <option value="">- Pilih Nama Pembayaran -</option>
                            <?php foreach ($pembayaran as $x): ?>
                            <option value="<?php echo $x->id_pembayaran; ?>"><?php echo $x->nama_pembayaran; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php } ?>
                    </div>

                    <label for="nama_kelas" class="col-sm-2 col-form-label">Kelas</label>
                    <div class="mb-3">
                    <select class="form-control" required name="kelas">
                        <option value="">- Pilih Kelas -</option>

                        <?php if(isset($_GET['kelas'])){ ?>
                        <?php foreach ($kelas as $x): ?>
                        <?php if($_GET['kelas'] == $x->id_kelas){ ?>
                        <option selected value="<?php echo $x->id_kelas; ?>"><?php echo $x->nama_kelas; ?></option>
                        <?php }else{ ?>
                        <option value="<?php echo $x->id_kelas; ?>"><?php echo $x->nama_kelas; ?></option>
                        <?php } ?>
                        <?php endforeach; ?>

                        <?php }else{ ?>
                        <?php foreach ($kelas as $x): ?>
                        <option value="<?php echo $x->id_kelas; ?>"><?php echo $x->nama_kelas; ?></option>
                        <?php endforeach; ?>
                        <?php } ?>

                    </select>
                    </div>

                    <label for="nama_kelas" class="col-sm-2 col-form-label">Dari Tanggal</label>
                    <div class="mb-3">
                        <input type="date" name="start" id="" class="form-control" required <?php if(isset($_GET['start'])): ?> value="<?php echo date('Y-m-d',strtotime($_GET['start'])) ?>" <?php endif; ?>>
                    </div>

                    <label for="nama_kelas" class="col-sm-2 col-form-label">Sampai Tanggal</label>
                    <div class="mb-3">
                        <input type="date" name="finish" id="" class="form-control" required <?php if(isset($_GET['finish'])){ ?> value="<?php echo date('Y-m-d',strtotime($_GET['finish'])) ?>" <?php }else{ ?> value="<?php echo date('Y-m-d') ?>" <?php } ?>>
                    </div>

                    <button type="submit" class="btn btn-info">Tampilkan</button>
                </form>

                </div>
                <?php  if(isset($_GET['kelas']) && isset($_GET['tahun']) && isset($_GET['pembayaran'])): ?>
                <div class="card-body">
                    <div class="table-responsive">
                    
                    <table class="table table-bordered table-striped" id="DataSpp">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">July</th>
                            <th scope="col">Agustus</th>
                            <th scope="col">September</th>
                            <th scope="col">Oktober</th>
                            <th scope="col">November</th>
                            <th scope="col">Desember</th>
                            <th scope="col">Januari</th>
                            <th scope="col">Februari</th>
                            <th scope="col">Maret</th>
                            <th scope="col">April</th>
                            <th scope="col">Mei</th>
                            <th scope="col">Juni</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; foreach ($data as $x): ?>
                          <tr>
                              <td><?php echo $i++; ?></td>
                              <td><?php echo $x->nama_siswa; ?></td>
                              <td <?php if($x->sta_jul == "Y" && $modelss->cekdatabulanan_rasio($_GET['start'], $_GET['finish'], $x->id_tagihan, "jul") == $x->tag_jul){ ?>style="color: green;"<?php }else{ ?>style="color: red;"<?php } ?>><?php echo "Rp. ".number_format($x->tag_jul ,2,',','.');?></td>
                              <td <?php if($x->sta_agu == "Y" && $modelss->cekdatabulanan_rasio($_GET['start'], $_GET['finish'], $x->id_tagihan, "agu") == $x->tag_agu){ ?>style="color: green;"<?php }else{ ?>style="color: red;"<?php } ?>><?php echo "Rp. ".number_format($x->tag_agu ,2,',','.'); ?></td>
                              <td <?php if($x->sta_sep == "Y" && $modelss->cekdatabulanan_rasio($_GET['start'], $_GET['finish'], $x->id_tagihan, "sep") == $x->tag_sep){ ?>style="color: green;"<?php }else{ ?>style="color: red;"<?php } ?>><?php echo "Rp. ".number_format($x->tag_sep ,2,',','.'); ?></td>
                              <td <?php if($x->sta_okt == "Y" && $modelss->cekdatabulanan_rasio($_GET['start'], $_GET['finish'], $x->id_tagihan, "okt") == $x->tag_okt){ ?>style="color: green;"<?php }else{ ?>style="color: red;"<?php } ?>><?php echo "Rp. ".number_format($x->tag_okt ,2,',','.'); ?></td>
                              <td <?php if($x->sta_nov == "Y" && $modelss->cekdatabulanan_rasio($_GET['start'], $_GET['finish'], $x->id_tagihan, "nov") == $x->tag_nov){ ?>style="color: green;"<?php }else{ ?>style="color: red;"<?php } ?>><?php echo "Rp. ".number_format($x->tag_nov ,2,',','.');?></td>
                              <td <?php if($x->sta_des == "Y" && $modelss->cekdatabulanan_rasio($_GET['start'], $_GET['finish'], $x->id_tagihan, "des") == $x->tag_des){ ?>style="color: green;"<?php }else{ ?>style="color: red;"<?php } ?>><?php echo "Rp. ".number_format($x->tag_des ,2,',','.'); ?></td>
                              <td <?php if($x->sta_jan == "Y" && $modelss->cekdatabulanan_rasio($_GET['start'], $_GET['finish'], $x->id_tagihan, "jan") == $x->tag_jan){ ?>style="color: green;"<?php }else{ ?>style="color: red;"<?php } ?>><?php echo "Rp. ".number_format($x->tag_jan ,2,',','.'); ?></td>
                              <td <?php if($x->sta_feb == "Y" && $modelss->cekdatabulanan_rasio($_GET['start'], $_GET['finish'], $x->id_tagihan, "feb") == $x->tag_feb){ ?>style="color: green;"<?php }else{ ?>style="color: red;"<?php } ?>><?php echo "Rp. ".number_format($x->tag_feb ,2,',','.'); ?></td>
                              <td <?php if($x->sta_mar == "Y" && $modelss->cekdatabulanan_rasio($_GET['start'], $_GET['finish'], $x->id_tagihan, "mar") == $x->tag_mar){ ?>style="color: green;"<?php }else{ ?>style="color: red;"<?php } ?>><?php echo "Rp. ".number_format($x->tag_mar ,2,',','.'); ?></td>
                              <td <?php if($x->sta_apr == "Y" && $modelss->cekdatabulanan_rasio($_GET['start'], $_GET['finish'], $x->id_tagihan, "apr") == $x->tag_apr){ ?>style="color: green;"<?php }else{ ?>style="color: red;"<?php } ?>><?php echo "Rp. ".number_format($x->tag_apr ,2,',','.'); ?></td>
                              <td <?php if($x->sta_mei == "Y" && $modelss->cekdatabulanan_rasio($_GET['start'], $_GET['finish'], $x->id_tagihan, "mei") == $x->tag_mei){ ?>style="color: green;"<?php }else{ ?>style="color: red;"<?php } ?>><?php echo "Rp. ".number_format($x->tag_mei ,2,',','.'); ?></td>
                              <td <?php if($x->sta_jun == "Y" && $modelss->cekdatabulanan_rasio($_GET['start'], $_GET['finish'], $x->id_tagihan, "jun") == $x->tag_jun){ ?>style="color: green;"<?php }else{ ?>style="color: red;"<?php } ?>><?php echo "Rp. ".number_format($x->tag_jun ,2,',','.'); ?></td>
                          </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                <?php endif; ?>
                <div class="card-footer">
                <small>*) Warna Merah Belum Bayar, Warna Hijau Sudah Bayar</small>
                <?php if(isset($_GET['kelas'])): ?><a style="float:right" class="btn btn-primary" target="__BLANK" href="<?php echo base_url('export/exportbulanan_kelas?kelas='.$_GET['kelas'].'&tahun='.$_GET['tahun'].'&pembayaran='.$_GET['pembayaran'].'&start='.$_GET['start'].'&finish='.$_GET['finish'].'&type=pdf') ?>" role="button">Export Ke PDF</a>  <a style="float:right; margin-right:5px;" class="btn btn-success" href="<?php echo base_url('export/exportbulanan_kelas?kelas='.$_GET['kelas'].'&tahun='.$_GET['tahun'].'&pembayaran='.$_GET['pembayaran'].'&start='.$_GET['start'].'&finish='.$_GET['finish'].'&type=excel') ?>" role="button">Export Ke Excle</a><?php endif; ?>
                </div>
                </div>
            </div>
        </div>

      </div>
    </section>
  </div>

<script>
    $('#DataSpp').DataTable({
      responsive : true
    });
</script>
<?= $this->endSection('content'); ?>