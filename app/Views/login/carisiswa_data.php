<?php echo $this->include('partisi/head'); ?>
<style>
.card-login:hover {
  background-color: #051702;
  box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
  color: #dfdfdc;
}
.card-login, .card-visimisi{
  color : #051702;
  background-color: #f7f7f7;
}
.title{
  color: dimgray;
  font-size: 39px;
  font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}
</style>
<?php use App\Models\ModelAdmin; $modelss = new ModelAdmin();?>
<body class="hold-transition sidebar-collapse layout-top-nav" style="background-color:#0a240a;">
<div class="wrapper" >

  <nav class="main-header navbar navbar-expand-md fixed-top" style="background-color:#051702;">
    <div class="container">
      <a href="<?php echo base_url() ?>" class="navbar-brand" style="color:white;">
        <img src="https://www.smkngudo.sch.id/wp-content/uploads/2021/02/logo-smkn-gudo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Smk Percobaan</span>
      </a>
    </div>
  </nav>

  <div class="content mt-5" >
    <br>
      <div class="container">

        <div class="card mt-3">
            <div class="card-header bg-success">
                Cek Tagihan
                <a href="<?php echo base_url('/'); ?>" type="button" class="btn btn-sm btn-success active" style="float:right;">Kembali</a>
            </div>
            <div class="card-body">
            <form action="<?php echo base_url('home/carisiswa'); ?>" method="get">
                <div class="form-group justify-content-center row">
                    <label class="col-sm-2 mt-2 mb-2 col-form-label">NIS / NISN / Nama</label>
                    <div class="col-sm-6 mt-2 mb-2">
                        <select class="form-control select2bs4" style="width: 100%;" name="siswa" required>
                            <option value="">- pilih Siswa-</option>
                        </select>
                    </div>
                    <div class="col-sm-3 mt-2 mb-2">
                        <button type="submit" class="btn btn-success">Cari Siswa</button>
                    </div>
                </div>
            </form>
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
            <table class="table table-bordered" id="Tarif">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach ($data_bulanan as $x): ?>
                    <tr>
                    <td  data-toggle="collapse" id="table1" data-target=".table<?php echo $i; ?>"><a type="button" class="btn btn-primary btn-xs"><i class="fas fa-plus"></i></a></td>
                    <td><?php echo $modelss->getNamaPembayaranByTagihan_Bulanan($x->id_tagihan) ?></td>
                    </tr>
                    <tr class="collapse table<?php echo $i; ?>">
                    <td colspan="999">
                        <div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Tagihan</th>
                                <th>Status Bayar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>July</td>
                                <td><?php echo "Rp. ".number_format($x->tag_jul,2,',','.'); ?></td>
                                <?php if($x->sta_jul == "Y"){ ?>
                                <td><span class="badge badge-info">Lunas</span></td>
                                <?php }else{ ?>
                                <td><span class="badge badge-danger">Belum Lunas</span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>Agustus</td>
                                <td><?php echo "Rp. ".number_format($x->tag_agu,2,',','.'); ?></td>
                                <?php if($x->sta_agu == "Y"){ ?>
                                <td><span class="badge badge-info">Lunas</span></td>
                                <?php }else{ ?>
                                <td><span class="badge badge-danger">Belum Lunas</span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>September</td>
                                <td><?php echo "Rp. ".number_format($x->tag_sep,2,',','.'); ?></td>
                                <?php if($x->sta_sep == "Y"){ ?>
                                <td><span class="badge badge-info">Lunas</span></td>
                                <?php }else{ ?>
                                <td><span class="badge badge-danger">Belum Lunas</span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>Oktober</td>
                                <td><?php echo "Rp. ".number_format($x->tag_okt,2,',','.'); ?></td>
                                <?php if($x->sta_okt == "Y"){ ?>
                                <td><span class="badge badge-info">Lunas</span></td>
                                <?php }else{ ?>
                                <td><span class="badge badge-danger">Belum Lunas</span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>November</td>
                                <td><?php echo "Rp. ".number_format($x->tag_nov,2,',','.'); ?></td>
                                <?php if($x->sta_nov == "Y"){ ?>
                                <td><span class="badge badge-info">Lunas</span></td>
                                <?php }else{ ?>
                                <td><span class="badge badge-danger">Belum Lunas</span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>Desember</td>
                                <td><?php echo "Rp. ".number_format($x->tag_des,2,',','.'); ?></td>
                                <?php if($x->sta_des == "Y"){ ?>
                                <td><span class="badge badge-info">Lunas</span></td>
                                <?php }else{ ?>
                                <td><span class="badge badge-danger">Belum Lunas</span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>Januari</td>
                                <td><?php echo "Rp. ".number_format($x->tag_jan,2,',','.'); ?></td>
                                <?php if($x->sta_jan == "Y"){ ?>
                                <td><span class="badge badge-info">Lunas</span></td>
                                <?php }else{ ?>
                                <td><span class="badge badge-danger">Belum Lunas</span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>Februari</td>
                                <td><?php echo "Rp. ".number_format($x->tag_feb,2,',','.'); ?></td>
                                <?php if($x->sta_feb == "Y"){ ?>
                                <td><span class="badge badge-info">Lunas</span></td>
                                <?php }else{ ?>
                                <td><span class="badge badge-danger">Belum Lunas</span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>Maret</td>
                                <td><?php echo "Rp. ".number_format($x->tag_mar,2,',','.'); ?></td>
                                <?php if($x->sta_mar == "Y"){ ?>
                                <td><span class="badge badge-info">Lunas</span></td>
                                <?php }else{ ?>
                                <td><span class="badge badge-danger">Belum Lunas</span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>April</td>
                                <td><?php echo "Rp. ".number_format($x->tag_apr,2,',','.'); ?></td>
                                <?php if($x->sta_apr == "Y"){ ?>
                                <td><span class="badge badge-info">Lunas</span></td>
                                <?php }else{ ?>
                                <td><span class="badge badge-danger">Belum Lunas</span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>Mei</td>
                                <td><?php echo "Rp. ".number_format($x->tag_mei,2,',','.'); ?></td>
                                <?php if($x->sta_mei == "Y"){ ?>
                                <td><span class="badge badge-info">Lunas</span></td>
                                <?php }else{ ?>
                                <td><span class="badge badge-danger">Belum Lunas</span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>Juni</td>
                                <td><?php echo "Rp. ".number_format($x->tag_jun,2,',','.'); ?></td>
                                <?php if($x->sta_jun == "Y"){ ?>
                                <td><span class="badge badge-info">Lunas</span></td>
                                <?php }else{ ?>
                                <td><span class="badge badge-danger">Belum Lunas</span></td>
                                <?php } ?>
                            </tr>

                            </tbody>
                        </table>
                        </div>
                    </td>
                    </tr>
                    <?php $i++; endforeach; ?>
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
                    <th scope="col">Sudah Dibayar</th>
                    <th scope="col">Tunggakan</th>
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
                    <td><?php echo "Rp. ".number_format($x->total_tagihan - $x->total_bayar ,2,',','.'); ?></td>
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
        <br><br><br>
    </div>
    <footer class="main-footer text-center fixed-bottom" style="background-color:#051702; color:white;">
    <strong>Copyright &copy; 2021 Sistem Informasi Pembayaran Sekolah
  </footer>
</div>
  </div>

<?php echo $this->include('partisi/js_login'); ?>
<script src="<?php echo base_url('plugins/select2/js/select2.full.min.js') ?>"></script>
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
        
        })
    });
  </script>
</body>
</html>