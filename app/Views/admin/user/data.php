<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manajemen User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Manajemen User</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Data Pengguna Aplikasi
                <a href="<?php echo base_url('admin/tambahusers'); ?>" type="button" class="btn btn-info btn-sm" style="float:right;">Tambah Users</a>
            </div>
            <div class="card-body">

            <table class="table table-bordered table-striped" id="DataUsers">
                <thead class="bg-primary text-white">
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Email</th>
                    <th scope="col">No Hp</th>
                    <th scope="col">Level</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($data as $x): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $x->username; ?></td>
                        <td><?php echo $x->nama; ?></td>
                        <td><?php echo $x->email; ?></td>
                        <td><?php echo $x->no_hp; ?></td>
                        <td><?php echo ucfirst($x->level); ?></td>
                        <td>
                            <a onclick="return confirm('Yakin Mau Menghapus User Ini ? ')" title="hapus users" href="<?php echo base_url('Admin/hapususer/'.$x->username) ?>"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a> <a title="edit users" href="<?php  echo base_url('admin/editusers/'.$x->username) ?>"><span class="badge badge-primary"><i class="fas fa-edit"></i></span></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
      </div>
    </section>
  </div>
  <script>
      $(document).ready(function(){
        $('#DataUsers').DataTable();
      });
  </script>
<?= $this->endSection('content'); ?>
