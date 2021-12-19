<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tarif - <?php echo $nama_pembayaran; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/pos') ?>">Pos Bayar</a></li>
                <li class="breadcrumb-item active"><?php echo $nama_pembayaran; ?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                <div class="card-header">
                    Tarif - <?php echo $nama_pembayaran; ?>
                </div>
                
                <form action="<?php echo base_url('admin/tarif/'.$id_pembayaran) ?>" method="get">
                <div class="card-header" style="background-color: #f9f9f9;">
                  <div class="row">
                    <div class="col-sm-1 mt-2 mb-2">
                      <label for="nama_alumni">Tahun Ajaran</label>
                    </div>
                    <div class="col-sm-3 mt-2 mb-2">
                        <input type="textinput-disabled" id="textinput-disabled"  value="<?php echo $tahun_ajaran; ?>" readonly class="form-control">
                    </div>
                      <div class="col-sm-4 mt-2 mb-2" >
                        <select class="form-control" required name="kelas">
                            <option value="">- Pilih Kelas -</option>
                            <?php foreach ($kelas as $x): ?>
                            <option value="<?php echo $x->id_kelas; ?>"><?php echo $x->nama_kelas; ?></option>
                            <?php endforeach; ?>
                          </select>
                      </div>

                      <div class="col-sm-4 mt-2 mb-2" >
                        <button type="submit" class="btn btn-info">Tampilkan</button>
                      </div>
                    </form>
                </div>

                </div>
                  <div class="card-body">
                      <div class="row">
                        <div class="col-sm-1 mt-2 mb-2">
                          <label for="nama_alumni">Aksi</label>
                        </div>
                        <div class="col">
                          <a href="<?php echo base_url('admin/settingTarif/'.$id_pembayaran); ?>" class="btn btn-success" type="button"><i class="fas fa-user-plus"></i> Tambah Data</a>
                          <a href="<?php echo base_url('admin/tarif/'.$id_pembayaran); ?>" class="btn btn-warning" type="button"><i class="fas fa-sync"></i> Reflesh</a>
                          <a href="<?php echo base_url('admin/pos') ?>" class="btn btn-default" type="button"><i class="fas fa-redo"></i> Kembali</a>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>

      </div>
    </section>
  </div>
<?= $this->endSection('content'); ?>