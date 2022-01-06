<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tahun Ajaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Tahun Ajaran</li>
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
                  Manajemen Tahun Ajaran  <a class="btn btn-primary" style="float: right;" href="<?php echo base_url('admin/tambahtahunajar') ?>" role="button">Tambah Data</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="TahunAjaran">
                        <thead class="bg-primary text-white">
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tahun Ajaran</th>
                            <th scope="col">Aktif</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; foreach ($data as $x): ?>
                            <tr>
                              <td><?php echo $i++; ?></td>
                              <td><?php echo $x->tahun_ajaran ?></td>
                              <?php if($x->status_tahunajar == 'Y'){ ?>
                              <td><a><span class="badge badge-success"><i class="fas fa-check"></i></span></a></td>
                              <?php }else{ ?>
                              <td><a><span class="badge badge-danger"><i class="fas fa-times fa-lg"></i></span></a></td>
                              <?php } ?>
                              <td><center><a onclick="return confirm('Yakin Mau Menghapus Data Ini ? ')" href="<?php echo base_url('Admin/hapustahunajar/'.$x->id) ?>"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a> <a href="<?php echo base_url('admin/edittahunajar/'.$x->id) ?>"><span class="badge badge-primary"><i class="fas fa-edit"></i></span></a></center></td>
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
    $(document).ready(function(){
        $('#TahunAjaran').DataTable();
    });
  </script>
<?= $this->endSection('content'); ?>
