<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Setting Tarif - <?php echo $nama_pembayaran; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/pos') ?>">Pos Bayar</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/tarif/'.$id_pembayaran) ?>"><?php echo $nama_pembayaran; ?></a></li>
                <li class="breadcrumb-item active">Setting</li>
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
                    Setting Tarif - <?php echo $nama_pembayaran; ?>
                </div>

                  <div class="card-body">
                      <div class="row">
                          <div class="col">
                            <div class="card card-info">
                                <div class="card-header">
                                  <h3 class="card-title">Pilih Kelas</h3>
                                </div>
                                <form type="GET" action="<?php echo base_url('admin/settingTarif/'.$id_pembayaran) ?>">
                                  <div class="card-body">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Nama Pembayaran</label>
                                      <input type="text" class="form-control" readonly  value="<?php echo $nama_pembayaran; ?>"> 
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Tipe Pembayaran</label>
                                      <input type="text" readonly class="form-control" id="jenis_bayar" value="<?php echo $tipe_pembayaran; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Tahun Ajaran</label>
                                      <input type="text" readonly class="form-control" id="tahun_ajaran" value="<?php echo $tahun_ajaran; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Pilih Kelas</label>
                                      <select class="form-control" required name="kelas">
                                        <option value="">- PILIH KELAS -</option>
                                       
                                        <?php if(isset($_GET['kelas'])){ ?>
                                        <option selected value="all">- SEMUA KELAS -</option>
                                        <?php foreach ($kelas as $x): ?>
                                        <?php if($_GET['kelas'] == $x->id_kelas){ ?>
                                        <option selected value="<?php echo $x->id_kelas; ?>"><?php echo " - ".$x->nama_kelas." - "; ?></option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $x->id_kelas; ?>"><?php echo " - ".$x->nama_kelas." - "; ?></option>
                                        <?php } ?>
                                        <?php endforeach; ?>

                                        <?php }else{ ?>
                                        <option value="all">- SEMUA KELAS -</option>
                                        <?php foreach ($kelas as $x): ?>
                                        <option value="<?php echo $x->id_kelas; ?>"><?php echo " - ".$x->nama_kelas." - "; ?></option>
                                        <?php endforeach; ?>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Tampilkan</button>
                                  </div>
                                </form>
                              </div>
                          </div>

                                                
                          <div class="col">
                          <div class="card card-success">
                                <div class="card-header">
                                  <h3 class="card-title">Tarif Setiap Siswa Sama</h3>
                                </div>
                                  <div class="card-body">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Tarif (Rp.)</label>
                                      <input type="number" id="allTarifBebas" class="form-control" placeholder="Rp. 00">
                                    </div>
                                  </div>
                                  <div class="card-footer">
                                      Masukkan Nilai Tagihan Lalu Tekan Enter
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>

              <?php if(isset($_GET['kelas'])): ?>
              <div class="card">
                  <div class="card-header">
                    Tentukan Tagihan Setiap Siswa
                  </div>
                  <div class="card-body">
                  <form id="SimpanTagihan">
                    <input type="hidden" name="type" value="bebas">
                    <input type="hidden" name="id_pembayaran" value="<?php echo $id_pembayaran; ?>">
                    <table class="table table-bordered table-striped" id="Tarif">
                        <thead>
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col"><input type="checkbox" id="parent"></th>
                              <th scope="col">Nis</th>
                              <th scope="col">Nama Siswa</th>
                              <th scope="col">Kelas</th>
                              <th scope="col">Besar Tagihan</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=1; foreach ($data as $x): ?>
                            <tr>
                              <td><?php echo $i++; ?></td>
                              <td><input name="nis[]" class="child" type="checkbox" value="<?php echo $x->nis; ?>"></td>
                              <td><?php echo $x->nis; ?></td>
                              <td><?php echo $x->nama_siswa; ?></td>
                              <td><?php echo $x->nama_kelas; ?></td>
                              <td>
                                <input type="number" name="total_tagihan" class="form-control tagihan" required placeholder="Rp. 00">
                              </td>
                            </tr>
                            <?php endforeach; ?>
                          </tbody>
                      </table>
                  </div>
                  <?php if(!empty($data)): ?>
                  <div class="card-footer">
                      <button class="btn btn-primary" type="button" disabled id="spinner">
                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>
                          Loading...
                      </button>
                      <button type="submit" id="submit" class="btn btn-info">Simpan Tagihan</button>
                  </div>
                  <?php endif; ?>
                  </form>
              </div>
            <?php endif; ?>
            </div>
        </div>

      </div>
    </section>

    <script>
    $(document).ready(function(){
        $('#spinner').hide();
        $('#Tarif').DataTable({
          responsive: true,
          "paging":   false,
          "ordering": false,
          "info":     false
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

        $("#allTarifBebas").keypress(function (e) {
          var allTarif = $("#allTarifBebas").val();
          if (e.which == 13) {
            $(".tagihan").val(allTarif);
          }
        });

        $('#SimpanTagihan').submit(function(e){
          e.preventDefault();
          $.ajax({
              url : '<?php echo base_url('Admin/SimpanTagihan') ?>',
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
                  location.href = '<?php echo base_url('admin/tarif/'.$id_pembayaran); ?>';
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