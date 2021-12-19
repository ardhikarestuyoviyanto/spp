<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Proses Kelulusan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Proses Kelulusan</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Pilih Kelas
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('admin/kelulusan') ?>" method="get">
                            <div class="container">
                              <div class="row justify-content-center">
                              <label for="nama_alumni" class="col-sm-2 col-form-label">Kelas Awal</label>
                                <div class="col col-sm-6 mt-2 mb-2">
                                    <select class="form-control" required name="kelas">
                                      <option value="">- Pilih Kelas Awal -</option>
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
                                  <div class="col col-sm-2 mt-2 mb-2">
                                    <button type="submit" class="btn btn-info">Tampilkan</button>
                                  </div>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card" style="height: 145px;"> 
                    <div class="card-body">
                    Warning!... !
                    Halaman ini digunakan untuk merubah status siswa menjadi lulus. Pastikan siswa yang di proses adalah siswa kelas XII
                    </div>
                </div>
            </div>
        </div>

        <?php if(isset($_GET['kelas'])){ ?>

        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                <div class="card-header">
                    Pilih Siswa Yang Akan Diproses
                </div>
                <div class="card-body">
                  <form id="kelulusan" method="post">
                    <table class="table table-bordered table-striped" id="Kelulusan">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Status</th>
                            <th scope="col"><input type="checkbox" id="parent">  &emsp;Pilih Semua</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($data as $x): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $x->nis; ?></td>
                                <td><?php echo $x->nama_siswa; ?></td>
                                <td><?php echo $x->nama_kelas; ?></td>
                                <?php if($x->status == "L"){ ?>
                                <td>Lulus</td>
                                <?php }else if($x->status == "P"){ ?>
                                <td>Pindah</td>
                                <?php }else{ ?>
                                <td>Belum Lulus</td>
                                <?php } ?>
                                <td><input name="nis[]" class="child" type="checkbox" value="<?php echo $x->nis; ?>"></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                    <div class="card-footer">
                        <?php if(!empty($data)): ?>
                        <div class="row">
                          <div class="col">
                                <div class="container" style="float:left;">
                                    <button class="btn btn-primary" type="button" disabled id="spinner">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>
                                        Loading...
                                    </button>  
                                    <button type="submit" class="btn btn-primary" id="submit">Proses Lulus</button>
                                </div>
                            </form>
                          </div>
                        </div>
                      <?php endif; ?>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <?php } ?>

      </div>
    </section>
  </div>
<script>
$(document).ready(function(){
    $('#Kelulusan').DataTable();
    $('#spinner').hide();
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

    $('#kelulusan').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('Admin/kelulusan_action') ?>',
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
<?= $this->endSection('content'); ?>