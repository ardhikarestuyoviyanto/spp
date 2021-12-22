<?php echo $this->include('partisi/head'); ?>
<!-- FILE CSS -->
<style>
  .card-login:hover {
    background-color: #3184f7;
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    color: #dfdfdc;
  }
  .card-login, .card-visimisi{
    color : #00265c;
    background-color: #f7f7f7;
  }
  .title{
    color: dimgray;
    font-size: 39px;
    font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
  }
</style>

<body>


  <!-- Image and text -->
  <nav class="navbar navbar-light bg-dark">
    <div class="container">
    <a class="navbar-brand text-white" href="#">
      <img src="https://blogger.googleusercontent.com/img/a/AVvXsEhk5MwngxD6rtFYKi3p53GOvSEyIxYQnxAspLuM3ILmzWhg4prw4dGbbxtTyLni70KuvCwR5V3XTA6s6Asx7Jrr5QUEn9SQOL0D0jBL7J0UuWbKF3JQJW5cFsPOv3eqhi4kKI09oQVEDRLkdnjxXiaU_POVUvuN9Dm7MyXJvBF15vgBqXRnFXJpzj2wbw=s16000" width="30" height="30" class="d-inline-block align-top" alt="">
      SMKN 96 YOGYAKARTA
    </a>
    </div>
  </nav>
    
    <div class="bg-primary" style="background-color: #c0c1c2;">
        <div class="container">
        <div class="row">
          <div class="col mt-4">
              <center><img src="https://blogger.googleusercontent.com/img/a/AVvXsEhk5MwngxD6rtFYKi3p53GOvSEyIxYQnxAspLuM3ILmzWhg4prw4dGbbxtTyLni70KuvCwR5V3XTA6s6Asx7Jrr5QUEn9SQOL0D0jBL7J0UuWbKF3JQJW5cFsPOv3eqhi4kKI09oQVEDRLkdnjxXiaU_POVUvuN9Dm7MyXJvBF15vgBqXRnFXJpzj2wbw=s16000" alt="SMKN 96 YOGYAKARTA" width="100px"></center>
          </div>
          <div class="col-5 mt-4">
            <h2 style="color: #eeff00;"><b>SMKN 96 YOGYAKARTA</b></h2>
              <p>
                  <b>Argorejo, Kecamatan Sedayu, Kab. Bantul, Prov. D.I. Yogyakarta </b><br>
                  Sukses Membangun Kecerdasan Spiritual, Emosional dan Intelektual
              </p>
          </div>
          <div class="col mt-4">
              <center>
                <a href="#">
                <i class="fab fa-instagram fa-2x" style="color:#ffffff;"></i>
                </a>
                <a href="#">
                <i class="fab fa-twitter fa-2x ml-3" style="color:#ffffff;"></i>
                </a>
                <a href="#">
                <i class="fab fa-facebook fa-2x ml-3" style="color:#ffffff;"></i>
                </a>
              </center>
          </div>
        </div>
        </div>
        <div class="bg-light bg-dark mt-4">
          <div class="container">
          <marquee style="word-spacing: 10px;">Selamat datang di website pembayaran SMKN 96 YOGYAKARTA | Ayo ciptakan ruang belajar yang kondusif dan tenang demi meraih masa depan | "Hanya pendidikan yang bisa menyelamatkan masa depan, Tanpa pendidikan Indonesia tak mungkin bertahan (Najwa Shihab)"</marquee>
          </div>
      </div>
    </div>

      <div class="container mt-4">
      <nav class="navbar navbar-dark bg-primary">
      <span class="navbar-brand mb-0 h1">Opsi</span>
      </nav>
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

    <div class="container mt-4">
    <nav class="navbar navbar-dark bg-primary">
    <span class="navbar-brand mb-0 h1">About</span>
    </nav>
      <div class="row mt-4">
        <div class="col-md-8">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="http://www.radartanggamus.co.id/wp-content/uploads/2020/02/IMG-20200224-WA0016.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="https://smansapringsewu.sch.id/wp-content/uploads/2020/01/81949205_163142921696229_8368015190888808448_o.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="https://smansapringsewu.sch.id/wp-content/uploads/2019/11/76959427_146564383354083_1836387475849740288_o.jpg" alt="Third slide">
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
          <br>
        </div>
        <div class="col-md-4">
        <center>
        <div class="card" style="width: 15rem;">
            <img class="card-img-top" src="https://us.123rf.com/450wm/magurok/magurok1403/magurok140300016/26453415-kale-man-in-pak-icoon.jpg?ver=6" alt="Card image cap">
            <div class="card-body">
              <h3>Abdurrab Almaarif, M.Pd.</h3>
              <p class="card-text">Saya mendukung penuh atas diluncurkannya website pembayaran pendidikan SMKN 96 Yogyakarta.</p>
            </div>
          </div>
        </center>
        </div>
      </div>
    </div>

    <div style="margin-bottom: -100px;">
      <footer class="py-3 my-4 bg-dark">
      <p class="text-center text-white">&copy; 2021 Copyright SMKN 96 YOGYAKARTA</p>
    </footer>
    </div>



<?php echo $this->include('partisi/js_login'); ?>
</body>
</html>
