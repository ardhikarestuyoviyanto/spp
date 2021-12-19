<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Rekapitulasi Pembayaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Rekapitulasi Pembayaran</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <?php use App\Models\ModelAdmin; $modelss = new ModelAdmin();?>
    <section class="content">
      <div class="container-fluid">
          <div class="card">
                <div class="card-header bg-primary">
                  Rekapitulasi Penerimaan SPP
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                  <a href="<?php echo base_url('admin/rekapdetail') ?>" type="button" style="float: right;" class="byn btn-success btn-sm active">Rekap Detail</a>

                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('export/export_rekap_bulanan') ?>" method="GET" target="__BLANK">
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

                      <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Pembayaran</label>
                      <div class="mb-3">
                      <?php if(isset($_GET['pembayaran'])){ ?>
                          <select class="form-control" aria-label="Default select example" required name="pembayaran" id="tahun">
                              <option value="">- Pilih Nama Pembayaran -</option>
                              <?php foreach ($pembayaran_bulanan as $x): ?>
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
                              <?php foreach ($pembayaran_bulanan as $x): ?>
                              <option value="<?php echo $x->id_pembayaran; ?>"><?php echo $x->nama_pembayaran; ?></option>
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

                      <button type="submit" class="btn btn-primary">Cetak</button>
                  </form>
                  </div>

                </div>
          </div>


          <div class="card">
            <div class="card-header bg-info">
              Rekapitulasi Pembayaran Lain - Lain
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">

              <form target="__BLANK" action="<?php echo base_url('export/export_rekap_bebas') ?>" method="GET">
              <input type="hidden" name="rekap" value="true">
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
                        <?php foreach ($pembayaran_bebas as $x): ?>
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
                        <?php foreach ($pembayaran_bebas as $x): ?>
                        <option value="<?php echo $x->id_pembayaran; ?>"><?php echo $x->nama_pembayaran; ?></option>
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

                <button type="submit" class="btn btn-info">Cetak</button>
              </form>

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