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
            <h1 class="m-0">Pembayaran Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/pembayaran') ?>">Pembayaran</a></li>
                <?php if(isset($_GET['siswa'])): ?>
                <li class="breadcrumb-item active"><?php echo $nama_siswa; ?></li>
                <?php endif; ?>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                    Filter Siswa
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="<?php echo base_url('admin/pembayaran') ?>" method="get">
                            <div class="form-group justify-content-center row">
                                <label class="col-sm-2 mt-2 mb-2 col-form-label">NIS / NISN / Nama</label>
                                <div class="col-sm-6 mt-2 mb-2">
                                    <select class="form-control select2bs4" style="width: 100%;" name="siswa" required>
                                        <option value="">- pilih Siswa-</option>
                                    </select>
                                </div>
                                <div class="col-sm-3 mt-2 mb-2">
                                    <button type="submit" class="btn btn-info">Cari Siswa</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-success">
            <div class="card-header">
            Informasi Siswa
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
            <a href="#" data-toggle="modal" data-target="#riwayat_bayar" <?php echo "data-nis=".$nis.""; ?> type="button" class="btn btn-success btn-sm" style="float:right;">Cetak Tagihan Multi Item</a>
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
            <form action="<?php echo base_url('admin/multiitem'); ?>" method="post">
            <div class="card-body">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col"><input type="checkbox" id="parent_bulanan"></th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col">Nama Pembayaran</th>
                    <th scope="col">Total Tagihan</th>
                    <th scope="col">Dibayar</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($data_bulanan)): ?>
                  <?php $i=1; foreach ($data_bulanan as $x): ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><input name="bulanan[]" <?php if($x['total_bayar'] == $x['total_tagihan']): ?> disabled <?php endif; ?> class="child_bulanan" type="checkbox" value="<?php echo $x['id_tagihan']; ?>"></td>
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
                    
                    <?php if($x['total_bayar'] == 0){ ?>
                    <td><a href="<?php echo base_url('admin/bayarbulanan/'.$nis.'/'.$x['id_tagihan']); ?>"><span class="badge badge-danger"><i class="fas fa-plus"></i> Bayar</span></a></td>
                    <?php }else if($x['total_bayar'] == $x['total_tagihan']){ ?>
                      <td><a href="<?php echo base_url('admin/bayarbulanan/'.$nis.'/'.$x['id_tagihan']); ?>"><span class="badge badge-success"><i class="fas fa-search"></i> Detail</span></a></td>
                    <?php }else{ ?>
                      <td><a href="<?php echo base_url('admin/bayarbulanan/'.$nis.'/'.$x['id_tagihan']); ?>"><span class="badge badge-warning"><i class="fas fa-plus"></i> Bayar</span></a></td>
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
                    <th scope="col"><input type="checkbox" id="parent_bebas"></th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col">Nama Pembayaran</th>
                    <th scope="col">Total Tagihan</th>
                    <th scope="col">Dibayar</th>
                    <th scope="col">Status</th>
                    <th scope="col">Bayar</th>
                    <th scope="col">Cetak</th>
                    <th scope="col">Kirim SMS Tagihan</th>
                    <th scope="col">Kirim Whatsapp Tagihan</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach ($data_bebas as $x): ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><input name="bebas[]" class="child_bebas" type="checkbox" <?php if($x->total_bayar == $x->total_tagihan): ?> disabled <?php endif; ?> value="<?php echo $x->id_tagihan; ?>"></td>
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
                    
                    <?php if($x->total_bayar == 0){ ?>
                    <td><a href="<?php echo base_url('admin/bayarbebas/'.$nis.'/'.$x->id_tagihan); ?>"><span class="badge badge-danger"><i class="fas fa-plus"></i> Bayar</span></a></td>
                    <?php }else if($x->total_bayar == $x->total_tagihan){ ?>
                      <td><a href="<?php echo base_url('admin/bayarbebas/'.$nis.'/'.$x->id_tagihan); ?>"><span class="badge badge-success"><i class="fas fa-search"></i> Detail</span></a></td>
                    <?php }else{ ?>
                      <td><a href="<?php echo base_url('admin/bayarbebas/'.$nis.'/'.$x->id_tagihan); ?>"><span class="badge badge-warning"><i class="fas fa-plus"></i> Bayar</span></a></td>
                    <?php } ?>
                    <?php if($x->total_bayar == $x->total_tagihan || $x->total_bayar != 0){ ?>
                    <td><a target="__BLANK" href="<?php echo base_url('export/export_pertagihanbebas/'.$nis.'/'.$x->id_tagihan) ?>"><span class="badge badge-success"><i class="fas fa-print"></i> Cetak Pembayaran</span></a></td>
                    <?php }else{ ?>
                    <td><a href="" class="disabled"><span class="badge badge-success"><i class="fas fa-print"></i> Cetak Pembayaran</span></a></td>
                    <?php } ?>
                    <td><a href="<?php echo base_url('Admin/NotifikasiSMS?nama_tagihan='. $x->nama_pembayaran.'&total_tagihan='.$x->total_tagihan.'&no_hp='.$no_hp.'&nis='.$nis) ?>"><span class="badge badge-info"><i class="far fa-comment-dots"></i> Kirim Tagihan</span></a></td>
                    <td><a target="__BLANK" href="https://api.whatsapp.com/send?phone=<?php echo $no_hp; ?>&text=<?php echo "Assalamualaikum Wr.Wb, Harap Segera Menyelesaikan Pembayaran Tagihan *$x->nama_pembayaran* Anak anda *$nama_siswa* Sebesar Rp. ".number_format($x->total_tagihan ,2,',','.')." Yang Sekarang Sudah dilunasi Sebesar Rp. ".number_format($x->total_bayar ,2,',','.').", Terima Kasih (Keuangan SMA Jumapolo)" ?>"><span class="badge badge-info"><i class="far fa-comment-dots"></i> Kirim Tagihan</span></a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
        </div>
        
        <div class="text-right">
          <input type="hidden" name="nis" value="<?php echo $nis; ?>">
          <button type="submit" class="btn btn-success mb-4 text-right">Bayar Multi Item</button>
        </div>

        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="riwayat_bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
      <div class="modal_riwayat"></div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
      $('.select2bs4').select2({
        theme: 'bootstrap4',
        minimumInputLength: 1,
           allowClear: true,
           placeholder: 'Masukkan NISN/NIS/Nama Siswa',
           ajax: {
              dataType: 'json',
              url: '<?php echo base_url('Admin/getSiswaSearchLimit') ?>',
              delay: 250,
              data: function(params) {
                return {
                  search: params.term
                }
              },
              processResults: function (data) {
                var results = [];

                $.each(data, function(index, item){
                    results.push({
                        id : item.nis,
                        text : item.nis+" - "+item.nama_siswa
                    });
                });

                return{
                    results : results
                }
            },
          }
        
    });

    $('.child_bebas').click(function() {
        if ($('.child_bebas:checked').length == $('.child_bebas').length) {
          $('#parent_bebas').prop('checked', true);
        } else {
          $('#parent_bebas').prop('checked', false);
        }
    });

    $('#parent_bebas').click(function(){
        $('.child_bebas').prop('checked', this.checked);
    });

    $('#parent_bulanan').click(function(){
        $('.child_bulanan').prop('checked', this.checked);
    });

    $('.child_bulanan').click(function() {
        if ($('.child_bulanan:checked').length == $('.child_bulanan').length) {
          $('#parent_bulanan').prop('checked', true);
        } else {
          $('#parent_bulanan').prop('checked', false);
        }
    });

    $('#riwayat_bayar').on('show.bs.modal', function(e){
        var nis = $(e.relatedTarget).data('nis');
        $.ajax({
            url : '<?php echo base_url('Admin/getRiwayatTagihanMulti'); ?>',
            type : 'POST',
            data : {'nis':nis},
            success : function(data){
                $('.modal_riwayat').html(data);
            }
        });
    });

  });
  </script>
  <?php if(isset($_GET['gagal'])): ?>
  <script>swal('Mohon Checklist Salah Satu Pembayaran');</script>
  <?php endif; ?>
<?= $this->endSection('content'); ?>