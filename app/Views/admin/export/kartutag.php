<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kartu Tagihan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Kartu Tagihan</li>
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
                  Cetak Kartu Tagihan
                </div>
                <div class="card-header" style="background-color: #f9f9f9;">

                <div class="row">
                      <div class="col-sm-3 mt-2 mb-2">
                      <form action="<?php echo base_url('admin/kartutag') ?>" method="GET">
                        <?php if(isset($_GET['status'])){ ?>
                          <select class="form-control" required name="status">
                            <option value="">- Semua Status -</option>

                            <?php if($_GET['status'] == "L"){ ?>
                            <option value="L" selected>Lulus</option>
                            <?php }else{ ?>
                            <option value="L">Lulus</option>
                            <?php } ?>

                            <?php if($_GET['status'] == "T"){ ?>
                            <option value="T" selected>Belum Lulus</option>
                            <?php }else{ ?>
                            <option value="T">Belum Lulus</option>
                            <?php } ?>

                            <?php if($_GET['status'] == "P"){ ?>
                            <option value="P" selected>Pindah</option>
                            <?php }else{ ?>
                            <option value="P">Pindah</option>
                            <?php } ?>
                          </select>
                        <?php }else{ ?>
                          <select class="form-control" required name="status">
                            <option value="">- Semua Status -</option>
                            <option value="L">Lulus</option>
                            <option value="T">Belum Lulus</option>
                            <option value="P">Pindah</option>
                          </select>
                        <?php } ?>
                      </div>

                      <div class="col-sm-3 mt-2 mb-2">
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
                      <div class="col-sm-1 mt-2 mb-2">
                        <button type="submit" class="btn btn-info">Tampilkan</button>
                      </div>
                    </form>
                      <div class="col-sm-5 mt-2">
                      </div>
                  </div>

                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped" id="DataSiswa">
                        <thead class="bg-primary text-white">
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Nama Ortu</th>
                            <th scope="col">No Hp</th>
                            <th scope="col">Cetak Tagihan</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; foreach ($siswa as $x): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $x->nisn; ?></td>
                                <td><?php echo $x->nama_siswa; ?></td>
                                <td><?php echo $x->jenis_kelamin; ?></td>
                                <td><?php echo $x->nama_kelas; ?></td>
                                <td><?php echo $x->nama_ortu; ?></td>
                                <td><?php echo $x->no_hp; ?></td>
                                <td><center><a target="_BLANK" href="<?php echo base_url('export/exportkartu/'.$x->nis) ?>" class="btn btn-danger btn-sm"><i class="fas fa-print fa-1x"></i> Cetak Kartu</a></center></td>
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
    $(function () {
      bsCustomFileInput.init();
    });
    $(document).ready(function(){
        $('#DataSiswa').DataTable({
          responsive: true
        });
        $('#spinner').hide();
    });
  </script>
<?= $this->endSection('content'); ?>
