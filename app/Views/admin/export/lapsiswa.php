<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan Data Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Laporan Data Siswa</li>
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
                  Manajemen Data Siswa 
                </div>
                <div class="card-header" style="background-color: #f9f9f9;">

                <div class="row">
                      <div class="col-sm-3 mt-2 mb-2">
                      <form action="<?php echo base_url('admin/lapsiswa') ?>" method="GET">
                        <select class="form-control" required name="kelas">
                            <option value="">- Pilih Kelas -</option>

                            <?php if(isset($_GET['kelas'])){ ?>
                            <?php foreach ($kelas as $x): ?>
                            <?php if($_GET['kelas'] == $x->nama_kelas){ ?>
                            <option selected value="<?php echo $x->nama_kelas; ?>"><?php echo $x->nama_kelas; ?></option>
                            <?php }else{ ?>
                            <option value="<?php echo $x->nama_kelas; ?>"><?php echo $x->nama_kelas; ?></option>
                            <?php } ?>
                            <?php endforeach; ?>

                            <?php }else{ ?>
                            <?php foreach ($kelas as $x): ?>
                            <option value="<?php echo $x->nama_kelas; ?>"><?php echo $x->nama_kelas; ?></option>
                            <?php endforeach; ?>
                            <?php } ?>

                          </select>
                      </div>

                      <div class="col-sm-3 mt-2 mb-2">
                        <button type="submit" class="btn btn-info">Tampilkan</button>
                      </div>
                      <div class="col-sm-1 mt-2 mb-2">
                      </div>
                    </form>
                      <div class="col-sm-5 mt-2">
                        <?php if(isset($_GET['kelas'])): ?><a style="float:right" class="btn btn-primary" target="__BLANK" href="<?php echo base_url('export/exportsiswa_pdf?kelas='.$_GET['kelas']) ?>" role="button">Export Ke PDF</a>  <a style="float:right; margin-right:5px;" class="btn btn-success" href="<?php echo base_url('export/exportsiswa_excel?kelas='.$_GET['kelas']) ?>" role="button">Export Ke Excle</a><?php endif; ?>
                      </div>
                  </div>

                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped" id="DataSiswa">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">NISN</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Nama Ortu</th>
                            <th scope="col">No Hp</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; foreach ($siswa as $x): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $x->nisn; ?></td>
                                <td><?php echo $x->nis; ?></td>
                                <td><?php echo $x->nama_siswa; ?></td>
                                <td><?php echo $x->jenis_kelamin; ?></td>
                                <td><?php echo $x->nama_kelas; ?></td>
                                <td><?php echo $x->nama_ortu; ?></td>
                                <td><?php echo $x->no_hp; ?></td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

      </div>
    </section>
  </div>

<script>
    $('#DataSiswa').DataTable();
</script>
<?= $this->endSection('content'); ?>