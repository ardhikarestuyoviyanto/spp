<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Pos Bayar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Pos Bayar</li>
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
                    Data Pos Bayar
                </div>

                <div class="card-header" style="background-color: #f9f9f9;">

                <div class="row">
                      <div class="col-sm-3 mt-2 mb-2">
                      <form action="<?php echo base_url('admin/pos') ?>" method="get">
                          <select class="form-control" required name="tahun">
                            <?php if(isset($_GET['tahun'])){ ?>

                            <?php if($_GET['tahun'] == "all"){ ?>
                            <option value="all" selected>- Semua Tahun Ajaran -</option>
                            <?php }else{ ?>
                            <option value="all">- Semua Tahun Ajaran -</option>
                            <?php } ?>

                            <?php foreach ($tahun_ajaran as $x): ?>
                            <?php if(urldecode($_GET['tahun'] == $x->tahun_ajaran)){ ?>
                            <option selected value="<?php echo $x->tahun_ajaran; ?>"><?php echo $x->tahun_ajaran; ?></option>
                            <?php }else{ ?>
                            <option value="<?php echo $x->tahun_ajaran; ?>"><?php echo $x->tahun_ajaran; ?></option>
                            <?php } ?>
                            <?php endforeach; ?>

                            <?php }else{ ?>

                            <option value="all">- Semua Tahun Ajaran -</option>
                            <?php foreach ($tahun_ajaran as $x): ?>
                            <option value="<?php echo $x->tahun_ajaran; ?>"><?php echo $x->tahun_ajaran; ?></option>
                            <?php endforeach; ?>

                            <?php } ?>
                          </select>
                      </div>
                      <div class="col-sm-1 mt-2 mb-2">
                        <button type="submit" class="btn btn-info">Tampilkan</button>
                      </div>
                    </form>
                      <div class="col-sm-8 mt-2">
                        <a style="float:right" class="btn btn-primary" href="<?php echo base_url('admin/tambahpos') ?>" role="button">Tambah Data</a>
                      </div>
                  </div>

                </div>

                <div class="card-body">
                  <table class="table table-bordered table-striped" id="Pos">
                     <thead class="bg-primary text-white">
                              <tr>
                              <th scope="col">No</th>
                              <th scope="col">Nama Pembayaran</th>
                              <th scope="col">Tipe</th>
                              <th scope="col">Tahun Ajaran</th>
                              <th scope="col">Tarif Pembayaran</th>
                              <th scope="col">Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php $i=1; foreach ($data as $x): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $x->nama_pembayaran; ?></td>
                                <td><?php echo $x->tipe_pembayaran; ?></td>
                                <td><?php echo $x->tahun_ajaran; ?></td>
                                <td>
                                    <a data-toggle="tooltip" data-placement="top" title="Setting Tarif Pembayaran" href="<?php echo base_url('admin/tarif/'.$x->id_pembayaran); ?>" type="button" class="btn btn-primary btn-xs">Setting Tarif Pembayaran</a>
                                </td>
                                <td><center><a onclick="return confirm('Yakin Mau Menghapus Data Ini ? ')" href="<?php echo base_url('Admin/hapuspos/'.$x->id_pembayaran) ?>"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a> <a href="<?php echo base_url('Admin/editpos/'.$x->id_pembayaran) ?>"><span class="badge badge-primary"><i class="fas fa-edit"></i></span></a></center></td>
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

    <script>
    $(document).ready(function(){
        $('#Pos').DataTable({
          responsive: true
        });
    });
    $('[data-toggle="tooltip"]').tooltip();

  </script>
  </div>
<?= $this->endSection('content'); ?>
