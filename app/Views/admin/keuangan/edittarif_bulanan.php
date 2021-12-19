<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Tarif - <?php echo $nama_pembayaran; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/pos') ?>">Pos Bayar</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/tarif/'.$id_pembayaran) ?>"><?php echo $nama_pembayaran; ?></a></li>
                <li class="breadcrumb-item active">Edit Tarif</li>
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
                    Edit Tarif - <?php echo $nama_pembayaran; ?>
                </div>
                  <?php foreach ($data as $x): ?>
                  <div class="card-body">
                      <div class="row">
                          <div class="col">
                            <div class="card card-info">
                                <div class="card-header">
                                  <h3 class="card-title">Informasi Tagihan</h3>
                                </div>
                                  <div class="card-body">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Nama Pembayaran</label>
                                      <input type="text" class="form-control" readonly  value="<?php echo $nama_pembayaran; ?>"> 
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Tipe Pembayaran</label>
                                      <input type="text" readonly class="form-control" id="jenis_bayar" value="<?php echo $x->tipe_pembayaran; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Tahun Ajaran</label>
                                      <input type="text" readonly class="form-control" id="tahun_ajaran" value="<?php echo $x->tahun_ajaran; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Kelas</label>
                                      <input type="text" readonly class="form-control" id="tahun_ajaran" value="<?php echo $x->nama_kelas; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Nis</label>
                                      <input type="text" readonly class="form-control" id="tahun_ajaran" value="<?php echo $x->nis; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Nama Siswa</label>
                                      <input type="text" readonly class="form-control" id="tahun_ajaran" value="<?php echo $x->nama_siswa; ?>">
                                    </div>


                                  </div>
                                  <div class="card-footer">
                                    Pilih Kelas Yang Akan anda beri tagihan
                                  </div>
                              </div>

                              <div class="card card-warning">
                                <div class="card-header">
                                <h3 class="card-title">Tarif Setiap Siswa Sama</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Tarif (Rp.)</label>
                                    <input type="number" id="AllPress" class="form-control" placeholder="Rp 0.0">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    Masukkan Nilai Tagihan Lalu Tekan Enter 
                                </div>
                            </div>
                          </div>

                                                
                          <div class="col">
                            <form id="UpdateTagihan">
                                <input type="hidden" name="id_tagihan" value="<?php echo $x->id_tagihan; ?>">
                                <input type="hidden" class="form-control" name="type" value="bulanan"> 
                            <div class="card card-success">
                                <div class="card-header">
                                <h3 class="card-title">Tarif Perbulan</h3>
                                </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Januari</td>
                                                    <td><input type="number" name="tag_jan" class="form-control" id="jan" placeholder="Rp. 00" id="" required value="<?php echo $x->tag_jan; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>Februari</td>
                                                    <td><input type="number" name="tag_feb" class="form-control" id="feb" placeholder="Rp. 00" id="" required value="<?php echo $x->tag_feb; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>Maret</td>
                                                    <td><input type="number" name="tag_mar" class="form-control" id="mar" placeholder="Rp. 00" id="" required value="<?php echo $x->tag_mar; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>April</td>
                                                    <td><input type="number" name="tag_apr" class="form-control" id="apr" placeholder="Rp. 00" id="" required value="<?php echo $x->tag_apr; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>Mei</td>
                                                    <td><input type="number" name="tag_mei" class="form-control" id="mei" placeholder="Rp. 00" id="" required value="<?php echo $x->tag_mei; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>Juni</td>
                                                    <td><input type="number" name="tag_jun" class="form-control" id="jun" placeholder="Rp. 00" id="" required value="<?php echo $x->tag_jun; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>July</td>
                                                    <td><input type="number" name="tag_jul" class="form-control" id="jul" placeholder="Rp. 00" id="" required value="<?php echo $x->tag_jul; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>Agustus</td>
                                                    <td><input type="number" name="tag_agu" class="form-control" id="agu" placeholder="Rp. 00" id="" required value="<?php echo $x->tag_agu; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>September</td>
                                                    <td><input type="number" name="tag_sep" class="form-control" id="sep" placeholder="Rp. 00" id="" required value="<?php echo $x->tag_sep; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>Oktober</td>
                                                    <td><input type="number" name="tag_okt" class="form-control" id="okt" placeholder="Rp. 00" id="" required value="<?php echo $x->tag_okt; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>November</td>
                                                    <td><input type="number" name="tag_nov" class="form-control" id="nov"placeholder="Rp. 00" id="" required value="<?php echo $x->tag_nov ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>Desember</td>
                                                    <td><input type="number" name="tag_des" class="form-control" id="des"placeholder="Rp. 00" id="" required value="<?php echo $x->tag_des; ?>"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-info" type="button" disabled id="spinner">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>
                                            Loading...
                                        </button>
                                        <button type="submit" id="submit" class="btn btn-info">Update Tagihan</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                      </div>
                  </div>
                  <?php endforeach; ?>
                </div>
           </div>
        </div>

      </div>
    </section>

    <script>
    $(document).ready(function(){
        $('#spinner').hide();
        
        $('#Tarif').DataTable({
          responsive: true
        });

        $('#AllPress').keypress(function(e){
            var Tarif = $('#AllPress').val();
            if(e.which == 13){
                $('#jan').val(Tarif);
                $('#feb').val(Tarif);
                $('#mar').val(Tarif);
                $('#apr').val(Tarif);
                $('#mei').val(Tarif);
                $('#jun').val(Tarif);
                $('#jul').val(Tarif);
                $('#agu').val(Tarif);
                $('#sep').val(Tarif);
                $('#okt').val(Tarif);
                $('#nov').val(Tarif);
                $('#des').val(Tarif);
            }
        });

        $('#UpdateTagihan').submit(function(e){
          e.preventDefault();
          $.ajax({
              url : '<?php echo base_url('Admin/edittagihanBulanan_action') ?>',
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
                  location.reload();
                });
              }, 
              error : function(data){
                  console.log(data);
              }
          });
      });
    });

  </script>
  </div>
<?= $this->endSection('content'); ?>