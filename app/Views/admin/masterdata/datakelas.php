<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Kelas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Data Kelas</li>
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
                    Manajemen Data Kelas <a style="float: right;" class="btn btn-primary" href="<?php echo base_url('admin/tambahkelas') ?>" role="button">Tambah Kelas</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="DataKelas">
                        <thead class="bg-primary text-white">
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Id Kelas</th>
                            <th scope="col">Nama Kelas</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($data as $x): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $x->id_kelas; ?></td>
                                <td><?php echo $x->nama_kelas; ?></td>
                                <td><center><a onclick="return confirm('Yakin Mau Menghapus Data Ini ? ')" href="<?php echo base_url('Admin/hapuskelas/'.$x->id_kelas) ?>"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a> <a href="<?php echo base_url('admin/editkelas/'.$x->id_kelas) ?>"><span class="badge badge-primary"><i class="fas fa-edit"></i></span></a></center></td>
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
        $('#DataKelas').DataTable();
    });
  </script>
<?= $this->endSection('content'); ?>
