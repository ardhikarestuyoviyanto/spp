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
                    <th scope="col" >Bayar</th>
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
                    <td>
                        <a href="<?= base_url('siswa/detailbulanan/'.$x['id_tagihan']) ?>" class="btn btn-primary btn-xs btn-block" title="Detail Pembayaran">Detail</a>
                    </td>
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
                    <th scope="col" >Bayar</th>
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
                    <?php if($x->total_bayar != $x->total_tagihan): ?>
                      <td>
                        <a href="#" type="button" class="btn btn-primary btn-xs btn-block bayar-bebas" title="Bayar" data-id="<?= $x->id_tagihan; ?>">Bayar</a>
                      </td>
                    <?php else: echo "<td>-</td>"; endif; ?>

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

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= $client_key; ?>"></script>
<script>
$(document).ready(function(){
    //-----------------------------------------------------
    $('[data-toggle="tooltip"]').tooltip();
    //--------------------------------------------------------
    $('.bayar-bebas').click(function(e){
        e.preventDefault();
        $.ajax({
            url: "<?= base_url('siswa/bayarbebas') ?>",
            type: "POST",
            data: {'id_tagihan': $(this).data('id')},
            success: function(data){
                var data = JSON.parse(data);
                snap.pay(data.snap_token, {
                    onSuccess: function(result){
                      $.ajax({
                          url: '<?= base_url('siswa/bayarbebas_update'); ?>',
                          type: 'POST',
                          data: {'id_tagihan': $(this).data('id')},
                          success: function(data){
                            swal(data)
                            .then((result) => {
                                location.reload();
                            });
                          }
                      });
                    },
                    onPending: function(result){

                    },
                    onError: function(result){
                       console.log('Error : '+JSON.stringify(result, null, 2));
                    }
                });
            },
            error: function(error){
                console.log(error);
            }
        });


    });
});
</script>

<?= $this->endSection('content'); ?>