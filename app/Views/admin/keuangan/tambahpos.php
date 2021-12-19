<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Pos Bayar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/pos') ?>">Pos Bayar</a></li>
                <li class="breadcrumb-item active">Tambah Pos Bayar</li>
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
                        Tambah Data Pembayaran
                    </div>
                    <div class="card-body">

                      <form id="tambah_pos" method="post">

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                            <div class="col-sm-10">
                                <select class="form-control" aria-label="Default select example" required name="tahun_ajaran" id="tahun_ajaran">
                                    <?php foreach ($tahun_ajaran as $x): ?>
                                    <option value="<?php echo $x->tahun_ajaran; ?>"><?php echo $x->tahun_ajaran; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                          <div class="mb-3 row">
                              <label for="nama_alumni" class="col-sm-2 col-form-label">Nama Pembayaran</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="nama_pembayaran" id="nama_pembayaran" placeholder="Contoh : Bayar SPP" required>
                              </div>
                          </div>

                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Tipe Pembayaran</label>
                                <div class="col-sm-10">
                                    <select class="form-control" aria-label="Default select example" required name="tipe_pembayaran" id="tipe_pembayaran">
                                        <option value="bulanan">Bulanan</option>
                                        <option value="bebas">Bebas</option>
                                    </select>
                                </div>
                            </div>
            
                      </div>
                      <div class="card-footer">
                          <div class="float-right">
                              <button type="submit" class="btn btn-primary">
                              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Simpan
                          </button>
                          </div>
                      </div>
                  </form>

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

    $('#tambah_pos').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('Admin/tambahpos_action'); ?>',
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
                $('#tambah_pos').trigger("reset");
            },
            error : function(err){
                console.log(err);
            }
        });
    });

  });
  </script>
<?= $this->endSection('content'); ?>