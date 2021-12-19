<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tahun Ajaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/tahunajar') ?>">Tahun Ajaran</a></li>
                <li class="breadcrumb-item active">Tambah</li>
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
                    Tambah Tahun Ajaran
                </div>
                <div class="card-body">
                    <form id="tambah_tahunajar" method="post">
                        <div class="mb-3 row">
                            <label for="tahun_lulus" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" required name="tahun_ajaran" placeholder="0000/9999">
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

    $('#tambah_tahunajar').submit(function(e){
        e.preventDefault();
        $.ajax({
            type : 'POST',
            url : '<?php echo base_url('Admin/tambahtahunajar_action'); ?>',
            data : $(this).serialize(),
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide()
            },
            success : function(data){
                swal(data);
                $('#tambah_tahunajar').trigger("reset");
            },
            error : function(error){
                console.log(error);
            }
        });
    });
});
</script>
<?= $this->endSection('content'); ?>