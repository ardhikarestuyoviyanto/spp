<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Tahun Ajaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/tahunajar') ?>">Tahun Ajaran</a></li>
                <li class="breadcrumb-item active">Edit</li>
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
                    Edit Tahun Ajaran
                </div>
                <div class="card-body">
                    <?php foreach ($data as $x): ?>
                    <form id="edit_tahunajar" method="post">
                        <input type="hidden" name="id" value="<?php echo $x->id; ?>">
                        <div class="mb-3 row">
                            <label for="tahun_lulus" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" required name="tahun_ajaran" placeholder="0000/9999" value="<?php echo $x->tahun_ajaran; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tahun_lulus" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                            <div class="col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" name="status_tahunajar" id="flexRadioDefault1" required value="Y" <?php if($x->status_tahunajar == "Y"){ ?> checked <?php } ?>>
                                    <label class="custom-control-label" for="flexRadioDefault1" style="font-weight: normal;">
                                        Aktif
                                    </label>
                                    </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" name="status_tahunajar" id="flexRadioDefault2" required value="N" <?php if($x->status_tahunajar == "N"){ ?> checked <?php } ?>>
                                    <label class="custom-control-label" for="flexRadioDefault2" style="font-weight: normal;">
                                        Tidak Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span>
                            Update
                        </button>
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

    $('#edit_tahunajar').submit(function(e){
        e.preventDefault();
        $.ajax({
            type : 'POST',
            url : '<?php echo base_url('Admin/edittahunajar_action'); ?>',
            data : $(this).serialize(),
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide()
            },
            success : function(data){
                swal(data)
                .then((value)=>{
                    location.reload();
                })
            },
            error : function(error){
                console.log(error);
            }
        });
    });
});
</script>
<?= $this->endSection('content'); ?>