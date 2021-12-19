<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<style>
.tagihan{
  color:red;
}
.disabled {
  color: currentColor;
  cursor: not-allowed;
  opacity: 0.5;
  text-decoration: none;
}
</style>
<?php foreach ($data_siswa as $x): $nama_siswa = $x->nama_siswa; $nis = $x->nis; endforeach;?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Multi Pembayaran Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/pembayaran') ?>">Pembayaran</a></li>
                <li class="breadcrumb-item active"><?php echo $nama_siswa; ?></li>
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
              <?php foreach ($data_siswa as $x): $nis = $x->nis; $no_hp = $x->no_hp; $nama_siswa = $x->nama_siswa;?>

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
            <div class="card-footer">
                <a href="<?php echo base_url('admin/pembayaran?siswa='.$nis); ?>" type="button" class="btn btn-default"><i class="fas fa-reply"></i> Kembali</a>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
            Daftar Tagihan
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
            </div>
            <div class="card-body">
              <table class="table table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col">Nama Pembayaran</th>
                    <th scope="col">Tipe Tagihan</th>
                    <th scope="col">Total Tagihan</th>
                    <th scope="col">Sudah Dibayar</th>
                    <th scope="col">Tanggungan</th>
                  </tr>
                </thead>
                <form id="multibayar" method="post">
                <?php if(!empty($bulanan)): ?>
                <?php foreach ($bulanan as $x): ?>
                <input type="hidden" name="bulanan[]" value="<?php echo $x; ?>">
                <?php endforeach; ?>
                <?php endif; ?>
                <?php if(!empty($bebas)): ?>
                <?php foreach ($bebas as $y): ?>
                <input type="hidden" name="bebas[]" value="<?php echo $y; ?>">
                <?php endforeach; ?>
                <?php endif; ?>
                <input type="hidden" name="nis" value="<?php echo $nis; ?>">
                <tbody>
                    <?php $harus_bayar = 0; $i=1; if(!empty($data_bulanan)): ?>
                    <?php foreach ($data_bulanan as $x):  ?>
                    <?php $harus_bayar = $harus_bayar + $x['tanggungan']; ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $x['tahun_ajaran']; ?></td>
                        <td><?php echo $x['nama_pembayaran']; ?></td>
                        <td><?php echo ucfirst($x['tipe_tagihan']); ?></td>
                        <td><?php echo "Rp. ".number_format($x['total_tagihan'],2,',','.'); ?></td>
                        <td><?php echo "Rp. ".number_format($x['sudah_dibayar'],2,',','.'); ?></td>
                        <td><?php echo "Rp. ".number_format($x['tanggungan'],2,',','.');?></td>                        
                    </tr>

                    <?php if(empty($x['sudah_dibayar'])){ ?>
                    <input type="hidden" name="sudah_dibayar_bulanan[]" value="0">
                    <?php }else{ ?>
                    <input type="hidden" name="sudah_dibayar_bulanan[]" value="<?php echo $x['sudah_dibayar'] ?>">
                    <?php } ?>

                    <?php if(empty($x['tanggungan'])){ ?>
                    <input type="hidden" name="tanggungan_bulanan[]" value="0">
                    <?php }else{ ?>
                    <input type="hidden" name="tanggungan_bulanan[]" value="<?php echo $x['tanggungan'] ?>">
                    <?php } ?>

                    <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if(!empty($data_bebas)): ?>
                    <?php foreach ($data_bebas as $y): ?>
                    <?php $harus_bayar = $harus_bayar + $y['tanggungan']; ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $y['tahun_ajaran']; ?></td>
                        <td><?php echo $y['nama_pembayaran']; ?></td>
                        <td><?php echo ucfirst($y['tipe_tagihan']); ?></td>
                        <td><?php echo "Rp. ".number_format($y['total_tagihan'],2,',','.'); ?></td>
                        <td><?php echo "Rp. ".number_format($y['sudah_dibayar'],2,',','.'); ?></td>
                        <td><?php echo "Rp. ".number_format($y['tanggungan'],2,',','.');?></td>                       
                    </tr>
                    <?php if(empty($y['sudah_dibayar'])){ ?>
                    <input type="hidden" name="sudah_dibayar_bebas[]" value="0">
                    <?php }else{ ?>
                    <input type="hidden" name="sudah_dibayar_bebas[]" value="<?php echo $y['sudah_dibayar'] ?>">
                    <?php } ?>

                    <?php if(empty($y['tanggungan'])){ ?>
                    <input type="hidden" name="tanggungan_bebas[]" value="0">
                    <?php }else{ ?>
                    <input type="hidden" name="tanggungan_bebas[]" value="<?php echo $y['tanggungan'] ?>">
                    <?php } ?>

                    <?php endforeach; ?>
                    <?php endif; ?>
                    <tr class="table-warning text-bold">
                        <td colspan="6">Tipe Pembayaran</td>
                        <td>
                            <select name="tipe_pembayaran" required class="form-control" aria-label="Default select example">
                                <option value="tunai">Tunai</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="table-success text-bold">
                        <td colspan="6">Harus Dibayar</td>
                        <td><?php echo "Rp. ".number_format($harus_bayar ,2,',','.'); ?></td>
                    </tr>
                    <input type="hidden" name="harus_dibayar" value="<?php echo $harus_bayar; ?>">
                    <tr class="table-light text-bold">
                        <td colspan="6"></td>
                        <td>
                            <button class="btn btn-info btn-sm btn-block" type="button" disabled id="spinner">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>
                                Loading...
                            </button>  
                            <button type="submit" class="btn btn-info btn-sm btn-block" id="submit">Bayar</button>
                        </td>
                    </tr>
                </tbody>
                </form>
              </table>
            </div>
            <div class="card-footer">
            
            </div>
        </div>
        </div>
      </div>
    </section>
  </div>
  
<script>
$(document).ready(function(){
    $('#spinner').hide();
    $('#multibayar').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('Admin/bayarmultiitem') ?>',
            type : 'POST',
            data : $(this).serialize(),
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
                    location.href = "<?php echo base_url('admin/pembayaran?siswa='.$nis); ?>"
                });
            }, 
            error : function(data){
                console.log(data);
            }
        });
    });
});
</script>
<?php if(isset($_GET['gagal'])): ?>
<script>swal('Mohon Checklist Salah Satu Pembayaran');</script>
<?php endif; ?>
<?= $this->endSection('content'); ?>