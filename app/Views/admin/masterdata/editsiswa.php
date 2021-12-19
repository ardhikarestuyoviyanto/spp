<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Data Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/datasiswa') ?>">Data Siswa</a></li>
                <li class="breadcrumb-item active">Edit Data Siswa</li>
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
                        Edit Data Siswa
                    </div>
                    <div class="card-body">

                    <?php foreach ($data as $x): ?>
                      <form id="edit_siswa" method="post">
                          <div class="mb-3 row">
                              <label for="nama_alumni" class="col-sm-2 col-form-label">NISN</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="nisn" id="nisn" placeholder="Nisn" required value="<?php echo $x->nisn; ?>">
                              </div>
                          </div>

                          <div class="mb-3 row">
                              <label for="nama_alumni" class="col-sm-2 col-form-label">NIS</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="nis" id="nis" placeholder="Nis" required readonly value="<?php echo $x->nis; ?>">
                              </div>
                          </div>

                            <div class="mb-3 row">
                                <label for="nama_alumni" class="col-sm-2 col-form-label">Nama Siswa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Nama Lengkap" required value="<?php echo $x->nama_siswa; ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="nama_alumni" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="jenis_kelamin" id="flexRadioDefault1" required value="L" <?php if($x->jenis_kelamin == "L"){ ?> checked <?php } ?>>
                                        <label class="custom-control-label" for="flexRadioDefault1" style="font-weight: normal;">
                                            Laki - Laki
                                        </label>
                                        </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="jenis_kelamin" id="flexRadioDefault2" required value="P" <?php if($x->jenis_kelamin == "P"){ ?> checked <?php } ?>>
                                        <label class="custom-control-label" for="flexRadioDefault2" style="font-weight: normal;">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="nama_alumni" class="col-sm-2 col-form-label">Status Siswa</label>
                                <div class="col-sm-10">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="status" id="flexRadioDefault11" required value="T" <?php if($x->status == "T"){ ?> checked <?php } ?>>
                                        <label class="custom-control-label" for="flexRadioDefault11" style="font-weight: normal;">
                                            Belum Lulus
                                        </label>
                                        </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="status" id="flexRadioDefault22" required value="L" <?php if($x->status == "L"){ ?> checked <?php } ?>>
                                        <label class="custom-control-label" for="flexRadioDefault22" style="font-weight: normal;">
                                            Lulus
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="status" id="flexRadioDefault33" required value="P" <?php if($x->status == "P"){ ?> checked <?php } ?>>
                                        <label class="custom-control-label" for="flexRadioDefault33" style="font-weight: normal;">
                                            Pindah
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Agama</label>
                                <div class="col-sm-10">
                                    <select class="form-control" aria-label="Default select example" required name="agama" id="agama">
                                        <?php if($x->agama == "Islam"){ ?>
                                        <option value="Islam" selected>Islam</option>
                                        <?php }else{ ?>
                                        <option value="Islam">Islam</option>
                                        <?php } ?>
                                        <?php if($x->agama == "Katolik"){ ?>
                                        <option value="Katolik" selected>Katolik</option>
                                        <?php }else{ ?>
                                         <option value="Katolik">Katolik</option>
                                        <?php } ?>
                                        <?php if($x->agama == "Protestan"){ ?>
                                        <option value="Protestan" selected>Protestan</option>
                                        <?php }else{ ?>
                                        <option value="Protestan">Protestan</option>
                                        <?php } ?>
                                        <?php if($x->agama == "Hindu"){ ?>
                                        <option value="Hindu" selected>Hindu</option>
                                        <?php }else{ ?>
                                        <option value="Hindu">Hindu</option>
                                        <?php } ?>
                                        <?php if($x->agama == "Budha"){ ?>
                                        <option value="Budha" selected>Budha</option>
                                        <?php }else{ ?>
                                        <option value="Budha">Budha</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
              
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Kelas</label>
                                <div class="col-sm-10">
                                    <select class="form-control" aria-label="Default select example" required name="id_kelas" id="id_kelas">
                                        <option value="">Pilih Kelas</option>
                                        <?php foreach ($kelas as $z): ?>
                                        <?php if($x->id_kelas == $z->id_kelas){ ?>
                                        <option selected value="<?php echo $z->id_kelas; ?>"><?php echo $z->nama_kelas; ?></option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $z->id_kelas; ?>"><?php echo $z->nama_kelas; ?></option>
                                        <?php } ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="nama_alumni" class="col-sm-2 col-form-label">Nama Ortu</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_ortu" name="nama_ortu" placeholder="Nama Orang Tua" required value="<?php echo $x->nama_ortu; ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="nama_alumni" class="col-sm-2 col-form-label">No Hp / Wa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No Hp / No WA" required value="<?php echo $x->no_hp; ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="nama_alumni" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea id="alamat" class="form-control" name="alamat" rows="2" placeholder="Alamat Lengkap, Meliputi RT/RW" required><?php echo $x->alamat; ?></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <label for="nama_alumni" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-eye fa-1x toggle-password"></i></span>
                                        </div>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                      </div>
                      <div class="card-footer">
                          <div class="float-right">
                              <button type="submit" class="btn btn-primary">
                              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Update
                          </button>
                          </div>

                          <div class="float-right" style="margin-right: 5px;">
                              <a href="<?php echo base_url('Admin/hapussiswa/'.$x->nis); ?>" onclick="return confirm('Yakin Mau Menghapus Siswa Ini ? ')" type="button" class="btn btn-danger">Hapus</a>
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

  $(document).on('click', '.toggle-password', function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $("#password");
      input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
  });
  $(document).ready(function(){
      
    $('#spinner').hide();

    $('#edit_siswa').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('Admin/editsiswa_action'); ?>',
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
    });

  });
  </script>
<?= $this->endSection('content'); ?>