<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/users') ?>">Manajemen User</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Edit Pengguna
            </div>
            <div class="card-body">

            <?php foreach ($data as $x): ?>
            <form id="edit_user" method="post">
                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Nama Pengguna</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" placeholder="Nama Pengguna" required value="<?php echo $x->nama; ?>">
                    </div>
                </div>

                <input type="hidden" name="id" value="<?php echo $x->id; ?>">

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" placeholder="Email" required value="<?php echo $x->email; ?>">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">No Hp</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="no_hp" placeholder="Nomor HP" required value="<?php echo  $x->no_hp; ?>">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Level</label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="level" <?php if($x->level == "admin"): ?> checked <?php endif; ?> id="flexRadioDefault1" required value="admin">
                            <label class="custom-control-label" for="flexRadioDefault1" style="font-weight: normal;">
                                Admin
                            </label>
                            </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="level"  <?php if($x->level == "bendahara"): ?> checked <?php endif; ?> id="flexRadioDefault2" required value="bendahara">
                            <label class="custom-control-label" for="flexRadioDefault2" style="font-weight: normal;">
                                Bendahara
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" placeholder="Username" required value="<?php echo $x->username; ?>">
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
            </div>
        </form>
        <?php endforeach; ?>
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
          
        $('#edit_user').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('Admin/editusers_action'); ?>',
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