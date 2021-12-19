<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Kelas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/datakelas') ?>">Data Kelas</a></li>
                <li class="breadcrumb-item active">Tambah Kelas</li>
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
                    Tambah Kelas
                </div>
                <div class="card-body">
                    <form id="tambah_kelas" method="post">
                        <div class="mb-3 row">
                            <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Kelas</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" required name="nama_kelas" placeholder="Masukkan Nama Kelas">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span>
                            Simpan
                        </button>
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

    $('#tambah_kelas').submit(function(e){
        e.preventDefault();
        $.ajax({
            type : 'POST',
            url : '<?php echo base_url('Admin/tambahkelas_action'); ?>',
            data : $(this).serialize(),
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide()
            },
            success : function(data){
                swal(data);
                $('#tambah_kelas').trigger("reset");
            },
            error : function(error){
                console.log(error);
            }
        });
    });
});
</script>
<?= $this->endSection('content'); ?>