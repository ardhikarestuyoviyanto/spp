<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tarif - <?php echo $nama_pembayaran; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/pos') ?>">Pos Bayar</a></li>
                <li class="breadcrumb-item active"><?php echo $nama_pembayaran; ?></li>
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
                    Tarif - <?php echo $nama_pembayaran; ?>
                </div>

                <form action="<?php echo base_url('admin/tarif/'.$id_pembayaran) ?>" method="get">
                <div class="card-header" style="background-color: #f9f9f9;">
                  <div class="row">
                      
                      <div class="col-sm-1 mt-2 mb-2">
                        <label for="nama_alumni">Tahun Ajaran</label>
                      </div>
                      <div class="col-sm-3 mt-2 mb-2">
                          <input type="textinput-disabled" id="textinput-disabled" value="<?php echo $tahun_ajaran; ?>" readonly class="form-control">
                      </div>
                        <div class="col-sm-4 mt-2 mb-2" >
                          <select class="form-control" required name="kelas">
                              <option value="">- Pilih Kelas -</option>
                              <?php if(isset($_GET['kelas'])){ ?>
                              <?php foreach ($kelas as $x): ?>
                              <?php if($_GET['kelas'] == $x->id_kelas){ ?>
                              <option selected value="<?php echo $x->id_kelas; ?>"><?php echo $x->nama_kelas; ?></option>
                              <?php }else{ ?>
                              <option value="<?php echo $x->id_kelas; ?>"><?php echo $x->nama_kelas; ?></option>
                              <?php } ?>
                              <?php endforeach; ?>

                              <?php }else{ ?>
                              <?php foreach ($kelas as $x): ?>
                              <option value="<?php echo $x->id_kelas; ?>"><?php echo $x->nama_kelas; ?></option>
                              <?php endforeach; ?>
                              <?php } ?>
                            </select>
                        </div>

                        <div class="col-sm-4 mt-2 mb-2" >
                          <button type="submit" class="btn btn-info">Tampilkan</button>
                        </div>
                      </form>

                </div>

                </div>
                  <div class="card-body">
                      <div class="row">
                        <div class="col-sm-1 mt-2 mb-2">
                          <label for="nama_alumni">Aksi</label>
                        </div>
                        <div class="col">
                          <a href="<?php echo base_url('admin/settingTarif/'.$id_pembayaran); ?>" class="btn btn-success" type="button"><i class="fas fa-user-plus"></i> Tambah Data</a>
                          <a href="<?php echo base_url('admin/tarif/'.$id_pembayaran); ?>" class="btn btn-warning" type="button"><i class="fas fa-sync"></i> Reflesh</a>
                          <a href="<?php echo base_url('admin/pos') ?>" class="btn btn-default" type="button"><i class="fas fa-redo"></i> Kembali</a>
                        </div>
                      </div>
                  </div>
                </div>

              <?php if(isset($_GET['kelas'])): ?>
              <div class="card">
                  <div class="card-header">
                    Siswa Yang Menerima Tagihan
                  </div>
                  <div class="card-body">
                  <form id="hapus_global">
                  <input type="hidden" name="id_pembayaran" value="<?php echo $id_pembayaran; ?>">
                  <table class="table table-bordered" id="Tarif">
                      <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col"><input type="checkbox" id="parent"></th>
                              <th scope="col">No</th>
                              <th scope="col">Nis</th>
                              <th scope="col">Nama Siswa</th>
                              <th scope="col">Kelas</th>
                              <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach ($data_siswa as $x): ?>
                          <tr>
                            <td  data-toggle="collapse" id="table1" data-target=".table<?php echo $i; ?>"><a type="button" class="btn btn-primary btn-xs"><i class="fas fa-plus"></i></a></td>
                            <td><input name="nis[]" class="child" type="checkbox" value="<?php echo $x->nis; ?>"></td>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $x->nis; ?></td>  
                            <td><?php echo $x->nama_siswa; ?></td>
                            <td><?php echo $x->nama_kelas; ?></td>
                            <td><center><a href="#" class="hapus_tagihan" data-toggle="modal" data-tagihan="<?php echo $x->id_tagihan; ?>"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a> <a href="<?php echo base_url('admin/edittagihan/'.$id_pembayaran.'/'.$x->id_tagihan) ?>"><span class="badge badge-primary"><i class="fas fa-edit"></i></span></a></center></td>
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
                  <div class="card-footer">
                      <button type="submit" class="btn btn-danger btn-sm" style="float:right;">
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinners"></span> Hapus Global
                    </button>
                  </div>
                  </form>
              </div>
              <?php endif; ?>
            </div>
        </div>

      </div>
    </section>
    <div class="modal fade" id="ModalHapusTagihan" data-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Hapus</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form_hapus_tagihan" method="post">
              <div class="mb-0">
                <input type="hidden" name="id_tagihan">
                Anda Yakin Ingin Menghapus Tagihan Ini ?
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Hapus
            </button>
          </div>
          </form>
        </div>
      </div>
    </div>
    
    <script>
    $(document).ready(function(){
      $('#spinner').hide();
      $('#spinners').hide();

      $('.hapus_tagihan').on('click', function(e){
            e.preventDefault();
            $('#ModalHapusTagihan').modal('show');
            var tagihan= $(this).data('tagihan');
            $('[name="id_tagihan"]').val(tagihan);
        });

        $('#parent').click(function(){
            $('.child').prop('checked', this.checked);
        });

        $('.child').click(function() {
            if ($('.child:checked').length == $('.child').length) {
              $('#parent').prop('checked', true);
            } else {
              $('#parent').prop('checked', false);
            }
        });

        $('#form_hapus_tagihan').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('Admin/hapustagihanBulanan') ?>',
                type : 'POST',
                data : $(this).serialize(),
                beforeSend : function(){
                    $('#spinner').show();
                },
                complete : function(){
                    $('#spinner').hide();
                },
                success : function(data){
                    swal(data)
                    .then((value) => {
                        location.reload();
                    });
                }, 
                error : function(data){
                    console.log(data);
                }
            });
        });

        $('#hapus_global').submit(function(e){
            e.preventDefault();
            var confirmed = confirm("Yakin Mau Menghapus Data Yang Ter-Checklist");
            if(confirmed){
                $.ajax({
                  url : '<?php echo base_url('Admin/HapusGlobalTagihanBulanan') ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                      $('#spinners').show();
                  },
                  complete : function(){
                      $('#spinners').hide();
                  },
                  success : function(data){
                      swal(data)
                      .then((value) => {
                          location.reload();
                      });
                  }, 
                  error : function(data){
                      console.log(data);
                  }
              });
            }
        });
    });

  </script>
  </div>
<?= $this->endSection('content'); ?>