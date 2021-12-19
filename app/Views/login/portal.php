<?php echo $this->include('partisi/head'); ?>
<style>
.card-login:hover {
  background-color: #051702;
  box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
  color: #dfdfdc;
}
.card-login, .card-visimisi{
  color : #051702;
  background-color: #f7f7f7;
}
.title{
  color: dimgray;
  font-size: 39px;
  font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}
</style>
<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand-md fixed-top" style="background-color:#051702;">
    <div class="container">
      <a href="<?php echo base_url() ?>" class="navbar-brand" style="color:white;">
        <img src="https://www.smkngudo.sch.id/wp-content/uploads/2021/02/logo-smkn-gudo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Smk Percobaan</span>
      </a>
    </div>
  </nav>

  <div class="content mt-5" style="background-color:#0a240a;">
    <br>
      <div class="container">
        <center><b><h1 class="title" style="color: white;"><i class="fas fa-graduation-cap"></i> Selamat Datang</h1></b></center>
        <center><h3 class="mt-3 mb-3 sub-title" style="color: #848d00;">Sistem Pembayaran Pendidikan Sekolah</h3></center>

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
       <div class="carousel-inner"  role="listbox" style=" width:100%; height: 500px !important;">
            <div class="carousel-item active">
              <img src="https://suaracirebon.com/wp-content/uploads/2020/04/22918-NU6SNY.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="https://suaracirebon.com/wp-content/uploads/2020/04/22918-NU6SNY.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="https://suaracirebon.com/wp-content/uploads/2020/04/22918-NU6SNY.jpg" class="d-block w-100" alt="...">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="content mt-5">
          <div class="container">
            <div class="row justify-content-md-center">

              <div class="col col-lg-4">
                <a href="<?php echo base_url('auth/loginadmin') ?>">
                <div class="card card-login" style="height: 14rem;">
                  <div class="card-body">
                    <p class="card-text">
                      <h3 class="text-center"><i class="fas fa-user-tie fa-3x"></i></h3>
                      <h3 class="text-center" id="text">Login Admin</h3>
                    </p>
                  </div>
                </div>
                </a>
              </div>
              <div class="col col-lg-4">
                <a href="<?php echo base_url('auth/loginsiswa') ?>">
                <div class="card card-login" style="height: 14rem;">
                  <div class="card-body">
                      <h3 class="text-center mt-2"><i class="fas fa-users fa-3x"></i></h3>
                      <h3 class="text-center">Login Siswa</h3>
                  </div>
                </div>
                </a>
              </div>
              <div class="col col-lg-4">
                <a href="<?php echo base_url('home/carisiswa') ?>">
                <div class="card card-login" style="height: 14rem;">
                  <div class="card-body">
                      <h3 class="text-center mt-2"><i class="fas fa-money-bill-alt fa-3x"></i></h3>
                      <h3 class="text-center">Cek Pembayaran</h3>
                  </div>
                </div>
                </a>
              </div>
            </div>
          </div>
        </div>

    <?php foreach ($data_sekolah as $x): ?>
    <div class="card card-visimisi mt-3">
      <div class="card-header text-center text-bold">
        - Visi Sekolah -
      </div>
      <div class="card-body">
        <?php echo $x->visi; ?>
      </div>
    </div>

    <div class="card card-visimisi mt-3">
      <div class="card-header text-center text-bold">
        - Misi Sekolah -
      </div>
      <div class="card-body">
      <?php echo $x->misi; ?>
      </div>
    </div>
    <?php endforeach; ?>
    </div>

    <footer class="main-footer text-center" style="background-color:#051702; color:white;">
    <strong>Copyright &copy; 2021 Sistem Informasi Pembayaran Sekolah
  </footer>
</div>
  </div>

<?php echo $this->include('partisi/js_login'); ?>
</body>
</html>