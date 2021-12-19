<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Tagihan Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/pos') ?>">Pos Bayar</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/tarif/'.$id_pembayaran) ?>"><?php echo $nama_pembayaran; ?></a></li>
                <li class="breadcrumb-item active"> Edit Tagihan Siswa</li>
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
                            Edit Tagihan Siswa
                        </div>
                        <div class="card-body">
                            <?php foreach ($data as $x): ?>
                            <form id="edit_tagihan_bebas" method="post">
                                <div class="mb-3 row">
                                    <label for="nama_alumni" class="col-sm-2 col-form-label">Nama Pembayaran</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly value="<?php echo $x->nama_pembayaran; ?>" required>
                                    </div>
                                </div>
                                <input type="hidden" name="id_tagihan" value="<?php echo $x->id_tagihan; ?>">
                                <div class="mb-3 row">
                                    <label for="nama_alumni" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly  value="<?php echo $x->tahun_ajaran; ?>">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nama_alumni" class="col-sm-2 col-form-label">Tipe Pembayaran</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" required readonly value="<?php echo $x->tipe_pembayaran; ?>">
                                    </div>
                                </div>

                                
                                <div class="mb-3 row">
                                    <label for="nama_alumni" class="col-sm-2 col-form-label">Kelas</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" required readonly value="<?php echo $x->nama_kelas; ?>">
                                    </div>
                                </div>

                                
                                <div class="mb-3 row">
                                    <label for="nama_alumni" class="col-sm-2 col-form-label">NIS</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" required readonly value="<?php echo $x->nis; ?>">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nama_alumni" class="col-sm-2 col-form-label">Nama Siswa</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" required readonly value="<?php echo $x->nama_siswa; ?>">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nama_alumni" class="col-sm-2 col-form-label">Total Tagihan</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="total_tagihan" required value="<?php echo $x->total_tagihan; ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                    <a href="<?php echo base_url('admin/tarif/'.$id_pembayaran.'?kelas='.$x->id_kelas); ?>" type="button" class="btn btn-default">Kembali</a>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Update Tagihan
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

      </div>
    </section>

    <script>
    $(document).ready(function(){
        $('#spinner').hide();

        $('#edit_tagihan_bebas').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('Admin/edittagihanBebas_action'); ?>',
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
                error : function(data){
                console.log(data);
                }
            });
        })
    });

  </script>
  </div>
<?= $this->endSection('content'); ?>