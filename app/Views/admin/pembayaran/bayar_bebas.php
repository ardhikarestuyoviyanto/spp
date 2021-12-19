<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pembayaran Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/pembayaran') ?>">Pembayaran</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/pembayaran?siswa='.$nis) ?>"><?php echo $nama_siswa; ?></a></li>
                <li class="breadcrumb-item active"><?php echo $nama_pembayaran; ?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">

        <div class="row">
            <div class="col-4">
              <div class="card card-info">
                <div class="card-header">
                  Informasi Tagihan
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                      <tbody>
                          <?php foreach ($informasiTagihan as $x): $nama_siswa = $x->nama_siswa; $nama_pembayaran = $x->nama_pembayaran; $nohp = $x->no_hp; ?>
                          <tr>
                            <td>Nama Pembayaran</td>
                            <td>:</td>
                            <td><?php echo $x->nama_pembayaran; ?></td>
                          </tr>
                          <tr>
                            <td>Tahun Ajaran</td>
                            <td>:</td>
                            <td><?php echo $x->tahun_ajaran; ?></td>
                          </tr>
                          <tr>
                            <td>NIS</td>
                            <td>:</td>
                            <td><?php echo $x->nis; ?></td>
                          </tr>
                          <tr>
                            <td>NISN</td>
                            <td>:</td>
                            <td><?php echo $x->nisn; ?></td>
                          </tr>
                          <tr>
                            <td>Nama Siswa</td>
                            <td>:</td>
                            <td><?php echo $x->nama_siswa; ?></td>
                          </tr>
                          <tr>
                            <td>Kelas</td>
                            <td>:</td>
                            <td><?php echo $x->nama_kelas; ?></td>
                          </tr>
                          <tr class="table-warning text-bold">
                            <td>Total Tagihan</td>
                            <td>:</td>
                            <td ><?php echo "Rp. ".number_format($x->total_tagihan ,2,',','.'); ?></td>
                          </tr>
                          <?php endforeach; ?>
                      </tbody>
                    </table>
                </div>
              <div class="card-footer">
                <a href="<?php echo base_url('admin/pembayaran?siswa='.$nis); ?>" type="button" class="btn btn-default"><i class="fas fa-reply"></i> Kembali</a>
              </div>
          </div>
            </div>

            <div class="col-8">
              <div class="card card-success">
                <div class="card-header">
                Pembayaran Tagihan Bebas
                </div>
              <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jumlah Bayar</th>
                    <th scope="col">Opsi</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">#</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $total_bayar = 0; $i=1; foreach ($data as $x): ?>
                  <?php if(empty($x->tgl)){$newDate = null;}else{ $newDate = date("d F Y", strtotime($x->tgl));} $total_bayar = $total_bayar + $x->total_bayar; $total_tagihan = $x->total_tagihan; $id_tagihan = $x->id_tagihan;?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $newDate; ?></td>
                    <td><?php echo "Rp. ".number_format($x->total_bayar,2,',','.'); ?></td>
                    <td><?php echo ucfirst($x->tipe_pembayaran); ?></td>
                    <td><?php echo ucfirst($x->status_bayar); ?></td>
                    <td>

                    <a onclick="return confirm('Yakin Mau Menghapus Pembayaran Ini ? ')" title="hapus pembayaran" href="<?php echo base_url('Admin/batalbayartagihanbebas?id_transaksi='.$x->id_transaksi.'&nis='.$nis.'&id_tagihan='.$id_tagihan) ?>"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a> <a target="__BLANK" title="cetak pembayaran" href="<?php echo base_url('export/export_pertransaksibebas/'.$x->id_transaksi.'/'.$x->id_tagihan) ?>"><span class="badge badge-primary"><i class="fas fa-print"></i></span></a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  
                  <tr class="table-success text-bold">
                    <td colspan="2">Total Bayar</td>
                    <td><?php echo "Rp. ".number_format($total_bayar,2,',','.'); ?></td>
                    <?php if($total_tagihan != $total_bayar){ ?>
                    <td colspan="3">Tunggakan : <?php echo "Rp. ".number_format($total_tagihan - $total_bayar,2,',','.'); ?></td>
                    <?php }else{ ?>
                    <td colspan="3">Lunas <a href="#" style="float:right;"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> SMS</span></a> <a target="__BLANK" href="https://api.whatsapp.com/send?phone=<?php echo $nohp; ?>&text=<?php echo "Assalamualaikum Wr.Wb, Tagihan *$nama_pembayaran*  Anak anda *$nama_siswa*  Sebesar Rp. ".number_format($total_tagihan ,2,',','.')." SUDAH LUNAS Terima Kasih (Keuangan SMA Jumapolo)" ?>" style="float:right; margin-right:5px;"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> WA</span></a></td>
                    <?php } ?>
                  </tr>

                  <?php if($total_tagihan != $total_bayar): ?>
                  <tr class="table-warning text-bold">
                    <td colspan="6">Tambah Pembayaran</td>
                  </tr>
                  <tr class="table-default text-black">
                    <td colspan="2">Tanggal Bayar</td>
                    <td>Jumlah Bayar</td>
                    <td>Cara Bayar</td>
                    <td>Keterangan</td>
                    <td>Bayar</td>
                  </tr>
                  <form id="bayar_bebas">
                  <tr class="table-light">
                    <td colspan="2"><input type="date" name="tgl" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly></td>
                    <input type="hidden" name="id_tagihan" value="<?php echo $id_tagihan; ?>">
                    <td><input type="number" name="total_bayar" id="" value="<?php echo $total_tagihan - $total_bayar; ?>" required class="form-control"></td>
                    <td>
                        <select name="tipe_pembayaran" class="form-control" required aria-label="Default select example">
                          <option value="tunai">Tunai</option>
                          <option value="transfer">Transfer</option>
                        </select>
                    </td>
                    <td>
                        <select name="status_bayar" class="form-control" required aria-label="Default select example">
                          <option value="lunas">Lunas</option>
                          <option value="angsuran 1">Angsuran 1</option>
                          <option value="angsuran 2">Angsuran 2</option>
                          <option value="angsuran 3">Angsuran 3</option>
                          <option value="angsuran 4">Angsuran 4</option>
                          <option value="angsuran 5">Angsuran 5</option>
                        </select>
                    </td>
                    <td><button type="submit" class="btn btn-info btn-sm"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Bayar</button></td>
                  </tr>
                  </form>
                  <?php endif; ?>
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
    $('#spinner').hide();
    $('#bayar_bebas').submit(function(e){
        e.preventDefault();
        $.ajax({
          url : '<?php echo base_url('Admin/bayartagihanbebas'); ?>',
          type : 'POST',
          data : $(this).serialize(),
          beforeSend : function(){
            $('#spinner').show();
          },
          complete : function(){
            $('#spinner').hide()
          },
          success : function(data){
            swal(data)
            .then((result) => {
                location.reload();
            });
          }
      });
    });
});
</script>
<?= $this->endSection('content'); ?>