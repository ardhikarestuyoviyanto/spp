<?= $this->extend('siswa/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tagihan Pembayaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Tagihan Pembayaran</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-success">
            <div class="card-header">
                Informasi Siswa
                <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
            </div>
            <div class="card-body">

                <?php foreach ($data_siswa as $x): $no_hp = $x->no_hp; $nama_siswa = $x->nama_siswa;?>

                    <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th scope="row">Tahun Ajaran</th>
                        <td>Semua Tahun Ajaran</td>
                    </tr>
                    <tr>
                        <th scope="row">NISN</th>
                        <td><?php echo $x->nisn; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">NIS</th>
                        <td><?php echo $x->nis; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Nama Siswa</th>
                        <td><?php echo $x->nama_siswa; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Kelas</th>
                        <td><?php echo $x->nama_kelas; ?></td>
                    </tr>
                    </tbody>
                    </table>
                <?php endforeach; ?>

                </div>
            </div>

        <div class="card card-primary">
            <div class="card-header">
            Tagihan Bulanan
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
            </div>
            <div class="card-body">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col">Nama Pembayaran</th>
                    <th scope="col">Total Tagihan</th>
                    <th scope="col">Dibayar</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($data_bulanan)): ?>
                  <?php $i=1; foreach ($data_bulanan as $x): ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $x['tahun_ajaran']; ?></td>
                    <td><?php echo $x['nama_pembayaran']; ?></td>
                    <td><?php echo "Rp. ".number_format($x['total_tagihan'] ,2,',','.'); ?></td>
                    <td><?php echo "Rp. ".number_format($x['total_bayar'] ,2,',','.'); ?></td>
                    <?php if($x['total_bayar'] == 0){ ?>
                    <td><span class="badge badge-danger">Belum Bayar</span></td>
                    <?php }else if($x['total_bayar'] == $x['total_tagihan']){ ?>
                      <td><span class="badge badge-success">Lunas</span></td>
                    <?php }else{ ?>
                      <td><span class="badge badge-warning">Belum Lengkap</span></td>
                    <?php } ?>
                    
                  </tr>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
              Tagihan Lainnya
              <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
            </div>
            <div class="card-body">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col">Nama Pembayaran</th>
                    <th scope="col">Total Tagihan</th>
                    <th scope="col">Dibayar</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach ($data_bebas as $x): ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $x->tahun_ajaran; ?></td>
                    <td><?php echo $x->nama_pembayaran; ?></td>
                    <td><?php echo "Rp. ".number_format($x->total_tagihan ,2,',','.'); ?></td>
                    <td><?php echo "Rp. ".number_format($x->total_bayar ,2,',','.'); ?></td>
                    <?php if($x->total_bayar == 0){ ?>
                    <td><span class="badge badge-danger">Belum Bayar</span></td>
                    <?php }else if($x->total_bayar == $x->total_tagihan){ ?>
                      <td><span class="badge badge-success">Lunas</span></td>
                    <?php }else{ ?>
                      <td><span class="badge badge-warning">Belum Lengkap</span></td>
                    <?php } ?>
                    
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
        </div>

        </div>
      </div>
    </section>
  </div>
<?= $this->endSection('content'); ?>