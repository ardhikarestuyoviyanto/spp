<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Data Siswa</li>
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
                      <form action="<?php echo base_url('admin/datasiswa') ?>" method="GET">
                        <?php if(isset($_GET['status'])){ ?>
                          <select class="form-control" required name="status">
                            <option  value="">- Semua Status -</option>

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
                            <option  value="">- Semua Status -</option>
                            <option value="L">Lulus</option>
                            <option value="T">Belum Lulus</option>
                            <option value="P">Pindah</option>
                          </select>
                        <?php } ?>
                      </div>

                      <div class="col-sm-3 mt-2 mb-2">
                          <select class="form-control" required name="kelas">
                            <option  value="">- Pilih Kelas -</option>

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
                        <a style="float:right" class="btn btn-primary" href="<?php echo base_url('admin/tambahsiswa') ?>" role="button">Tambah Siswa</a>  <a style="float:right; margin-right:5px;" class="btn btn-success"  data-toggle="modal" data-target="#modal-default" role="button">Import Excle</a>
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
                            <th scope="col" style="width:10px;">Aksi</th>
                            <th scope="col">Cek Tagihan</th>
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
                                <td><center><a href="<?php echo base_url('admin/editsiswa/'.$x->nis); ?>"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a></center></td>
                                <td><center><a target="_BLANK" href="<?php echo base_url('export/exporttagihanpersiswa/'.$x->nis) ?>" class="btn btn-danger btn-sm"><i class="fas fa-print fa-1x"></i> Cek Tagihan</a></center></td>
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

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Import Excel</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="excel" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile" name="excel" required accept=".xls, .xlsx">
              <label class="custom-file-label" for="customFile">Klik disini</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" disabled id="spinner">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>
              Loading...
          </button>  
          <button type="submit" class="btn btn-primary" id="submit">Import</button>
        </div>
        </form>
      </div>
    </div>
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
        $('#excel').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('Admin/importdatasiswa') ?>',
                type : 'POST',
                data : new FormData(this),
                dataType : 'JSON',
                contentType : false,
                cache : false,
                processData : false,
                beforeSend : function(){
                    $('#spinner').show();
                    $('#submit').hide();
                },
                complete : function(){
                    $('#spinner').hide();
                    $('#submit').show();
                },
                success : function(data){
                    swal(data)
                    .then((value) => {
                    location.reload();
                    });
                }, 
                error : function(data){
                    console.log(data);
                }
            });
        });
    });
  </script>
<?= $this->endSection('content'); ?>
