<?= $this->include('partisi/head'); ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Login</b>Siswa</a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><?php if(isset($_SESSION['error'])){echo $_SESSION['error'];}else{echo "Sign in to start your session"; } ?></p>

      <form action="<?php echo base_url('Home/login_siswa') ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="NIS" name="nis" required value="<?php if(isset($_COOKIE['remember_siswa'])){echo $_COOKIE['remember_siswa']; } ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3 embed-responsive">
          <div class="input-group">
              <input type="text" name="number_1" class="form-control" readonly value="<?php echo $number_1; ?>" style="background-color:whitesmoke; text-align:center;">
              <div class="input-group-prepend">
                  <span class="input-group-text"> + </span>
              </div>
              <input type="text" name="number_2" class="form-control" readonly value="<?php echo $number_2; ?>" style="background-color: whitesmoke; text-align:center;">
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="number" class="form-control" placeholder="Berapa hasil diatas" name="captcha" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-robot"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
            <input type="checkbox" id="remember" name="remember_siswa" <?php if(isset($_COOKIE['remember_siswa'])){?> checked <?php }; ?>>
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php echo $this->include('partisi/js_login'); ?>
</body>
</html>
