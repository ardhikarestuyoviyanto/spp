<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pengaturan Sekolah</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Pengaturan Sekolah</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-7">
                <div class="card">
                  <div class="card-header">
                      Data Sekolah
                  </div>
                  <div class="card-body">
                  <?php foreach ($data as $x): ?>
                    <form id="data_sekolah" method="post">
                        <div class="mb-3">
                            <label for="nama_alumni">Nama Sekolah</label>
                            <input type="text" class="form-control" name="nama_sekolah" placeholder="Nama Sekolah" value="<?php echo $x->nama_sekolah; ?>" required>
                            <small>Digunakan Pada Kop Surat</small>
                        </div>

                        <div class="mb-3">
                            <label for="nama_alumni">Alamat Sekolah</label>
                            <input type="text" class="form-control" name="alamat" placeholder="Alamat Sekolah" value="<?php echo $x->alamat; ?>" required>
                            <small>Digunakan Pada Kop Surat</small>
                        </div>

                        <div class="mb-3">
                            <label for="nama_alumni">Bendahara</label>
                            <input type="text" class="form-control" name="bendahara" placeholder="Bendahara" required value="<?php echo $x->bendahara; ?>">
                            <small>Digunakan Pada Kop Surat, Bagian Tanda Tangan</small>
                        </div>

                        <div class="mb-3">
                            <label for="nama_alumni">Kepala Sekolah</label>
                            <input type="text" class="form-control" name="kepsek" placeholder="Kepsek" required value="<?php echo $x->kepsek; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="nama_alumni">SID (API Sms)</label>
                            <input type="text" class="form-control" name="sid_twilo" placeholder="Bendahara" readonly required value="<?php echo $x->sid_twilo; ?>">
                            <small><a href="https://www.twilio.com/" target="_BLANK">klik disini</a> Untuk setting API sms</small>
                        </div>

                        <div class="mb-3">
                            <label for="nama_alumni">Token (API Sms)</label>
                            <input type="text" class="form-control" name="token_twilo" placeholder="Bendahara" readonly required value="<?php echo $x->token_twilo; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="nama_alumni">Phone Number (API Sms)</label>
                            <input type="text" class="form-control" name="number_twilo" placeholder="Bendahara" readonly required value="<?php echo $x->number_twilo; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="nama_alumni">Visi</label>
                            <textarea name="visi" id="" cols="30" rows="5" class="form-control" required><?php echo $x->visi; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="nama_alumni">Misi</label>
                            <textarea name="misi" id="" cols="30" rows="7" class="form-control" required><?php echo $x->misi; ?></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                      <div class="float-right">
                          <button type="submit" class="btn btn-primary">
                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinners"></span> Update
                      </button>
                      </div>
                    </div>
                  </form>
                  </div>
            </div>
                
            <div class="col-4">
                <div class="card">
                  <div class="card-header">
                      Kop Surat
                  </div>
                  <div class="card-body">
                    <div class="alert alert-info text-center" role="alert">
                      <label for="#">Logo Kiri</label>
                    </div>
                      <div class="text-center">
                          <a href="#" data-toggle="modal" data-target="#logo-kiri"><img src="<?php echo base_url('dist/img/'.$x->logo_kiri) ?>" alt="" class="rounded-circle img-fluid" width="190"></a>
                      </div>
                      <br>
                      <div class="alert alert-secondary text-center" role="alert">
                      <label for="#">Logo Kanan</label>
                      </div>
                      <div class="text-center">
                        <a href="#" data-toggle="modal" data-target="#logo-kanan"><img src="<?php echo base_url('dist/img/'.$x->logo_kanan) ?>" alt="" class="rounded-circle img-fluid" width="250"></a>
                      </div>
                  </div>
                </div>
            </div>
            </div>
          <?php endforeach; ?>
        </div>

    </section>
  </div>
  <div class="modal fade" id="logo-kiri">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Logo Kiri</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="logo_kiri">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="logo" id="customFile">
              <input type="hidden" name="type" value="kiri">
              <label class="custom-file-label" for="customFile" required>Choose file</label>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-primary" type="button" disabled id="spinner">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>
              Loading...
          </button>  
          <button type="submit" class="btn btn-primary" id="submit">Update</button>
        </div>
        </form>

      </div>
    </div>
  </div>

  <div class="modal fade" id="logo-kanan">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Logo Kanan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="logo_kanan">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="logo" required id="customFile">
              <input type="hidden" name="type" value="kanan">
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-primary" type="button" disabled id="spinnerss">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>
              Loading...
          </button>  
          <button type="submit" class="btn btn-primary" id="submitss">Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<script>
    $(document).ready(function(){
      $(function () {
        bsCustomFileInput.init();
      });
      $('#spinners').hide();
        
        $('#data_sekolah').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('Admin/updatesetting_action'); ?>',
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
                .then((result) => {
                    location.reload(); 
                });
                },
                error : function(data){
                console.log(data);
                }
            });
        });

        $('#spinner').hide();
        $('#spinnerss').hide();

        $('#logo_kiri').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('Admin/updatelogo') ?>',
                type : 'POST',
                data : new FormData(this),
                dataType : 'JSON',
                contentType : false,
                cache : false,
                processData : false,
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

        $('#logo_kanan').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('Admin/updatelogo') ?>',
                type : 'POST',
                data : new FormData(this),
                dataType : 'JSON',
                contentType : false,
                cache : false,
                processData : false,
                beforeSend : function(){
                    $('#spinnerss').show();
                    $('#submitss').hide();
                },
                complete : function(){
                    $('#spinnerss').hide();
                    $('#submitss').show();
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
<?= $this->endSection('content'); ?>