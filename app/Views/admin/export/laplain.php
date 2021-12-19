<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan Pembayaran Lain - Lain</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Laporan Pembayaran Lain - Lain</li>
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
                  Laporan Pembayaran Lain - Lain
                </div>
                <div class="card-header" style="background-color: #f9f9f9;">

                <div class="row">
                      <div class="col-sm-3 mt-2 mb-2">
                      <form action="<?php echo base_url('admin/laplain') ?>" method="GET">
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

                      <div class="col-sm-3 mt-2 mb-2">
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

                      <div class="col-sm-3 mt-2 mb-2">
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
                      <div class="col-sm-1 mt-2 mb-2">
                        <button type="submit" class="btn btn-info">Tampilkan</button>
                      </div>
                    </form>
                  </div>

                </div>
                <?php  if(isset($_GET['kelas']) && isset($_GET['tahun']) && isset($_GET['pembayaran'])): ?>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Total Tagihan</th>
                            <th scope="col">Total Bayar</th>
                            <th scope="col">Tunggakan</th>
                            <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; $i=1; foreach ($data as $x): ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $x->nis; ?></td>
                                    <td><?php echo $x->nama_siswa; ?></td>
                                    <td><?php echo "Rp. ".number_format($x->total_tagihan ,2,',','.'); ?></td>
                                    <td><?php echo "Rp. ".number_format($modelss->getDetailPembayaranBebas($x->id_tagihan) ,2,',','.'); ?></td>
                                    <td><?php echo "Rp. ".number_format($x->total_tagihan - $modelss->getDetailPembayaranBebas($x->id_tagihan) ,2,',','.'); ?></td>
                                    <?php if($x->total_tagihan == $modelss->getDetailPembayaranBebas($x->id_tagihan)){ ?>
                                    <td>Lunas</td>
                                    <?php }else{ ?>
                                    <td>Belum Lunas</td>
                                    <?php } ?>
                                </tr>
                            <?php $total = $total + $x->total_tagihan; endforeach; ?>
                            <tr>
                                <td colspan="3" class="text-bold">Total : </td>
                                <td><?php echo "Rp. ".number_format($total ,2,',','.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <?php endif; ?>
                <div class="card-footer">
                <?php if(isset($_GET['kelas'])): ?><a style="float:right" class="btn btn-primary" target="__BLANK" href="<?php echo base_url('export/export_laplain?kelas='.$_GET['kelas'].'&tahun='.$_GET['tahun'].'&pembayaran='.$_GET['pembayaran'].'&type=pdf') ?>" role="button">Export Ke PDF</a>  <a style="float:right; margin-right:5px;" class="btn btn-success" href="<?php echo base_url('export/export_laplain?kelas='.$_GET['kelas'].'&tahun='.$_GET['tahun'].'&pembayaran='.$_GET['pembayaran'].'&type=excle') ?>" role="button">Export Ke Excle</a><?php endif; ?>
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