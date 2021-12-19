<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Pos Bayar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/pos') ?>">Pos Bayar</a></li>
                <li class="breadcrumb-item active">Edit Pos Bayar</li>
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
                        Edit Data Pembayaran
                    </div>
                    <div class="card-body">
                    <?php foreach ($data as $z): ?>
                      <form id="edit_pos" method="post">

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                            <div class="col-sm-10">
                                <select class="form-control" aria-label="Default select example" required name="tahun_ajaran" id="tahun_ajaran">
                                    <?php foreach ($tahun_ajaran as $x): ?>
                                    <?php if($z->tahun_ajaran == $x->tahun_ajaran){ ?>
                                    <option selected value="<?php echo $x->tahun_ajaran; ?>"><?php echo $x->tahun_ajaran; ?></option>
                                    <?php }else{ ?>
                                    <option value="<?php echo $x->tahun_ajaran; ?>"><?php echo $x->tahun_ajaran; ?></option>
                                    <?php } ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="id_pembayaran" value="<?php echo $z->id_pembayaran; ?>">

                          <div class="mb-3 row">
                              <label for="nama_alumni" class="col-sm-2 col-form-label">Nama Pembayaran</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="nama_pembayaran" id="nama_pembayaran" placeholder="Contoh : Bayar SPP" required value="<?php echo $z->nama_pembayaran; ?>">
                              </div>
                          </div>

                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Tipe Pembayaran</label>
                                <div class="col-sm-10">
                                    <select class="form-control" aria-label="Default select example" required name="tipe_pembayaran" id="tipe_pembayaran">
                                        <?php if($z->tipe_pembayaran == "bulanan"){ ?>
                                        <option selected value="bulanan">Bulanan</option>
                                        <?php }else{ ?>
                                        <option value="bulanan">Bulanan</option>
                                        <?php }?>
                                        <?php if($z->tipe_pembayaran == "bebas"){ ?>
                                        <option selected value="bebas">Bebas</option>
                                        <?php }else{ ?>
                                        <option value="bebas">Bebas</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
            
                      </div>
                      <div class="card-footer">
                          <div class="float-right">
                              <button type="submit" class="btn btn-primary">
                              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Update
                          </button>
                          </div>
                      </div>
                  </form>
                <?php endforeach; ?>
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

    $('#edit_pos').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('Admin/editpos_action'); ?>',
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
                .then((result) => {
                   location.reload(); 
                });
            },
            error : function(err){
                console.log(err);
            }
        });
    });

  });
  </script>
<?= $this->endSection('content'); ?>