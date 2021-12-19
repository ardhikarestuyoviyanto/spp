<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo base_url('admin/home'); ?>" class="brand-link">
      <img src="https://img2.pngdownload.id/20180401/vew/kisspng-letter-gothic-alphabet-font-letter-s-5ac183be3677d3.5919141415226316142231.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Siswa</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://i.pinimg.com/originals/72/cd/96/72cd969f8e21be3476277d12d44c791c.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php if(isset($_SESSION['nama_siswa'])){echo $_SESSION['nama_siswa']; }else{echo "Siswa";}; ?></a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <?php if($sidebar == "Dashboard"){ ?>
            <a href="<?php echo base_url('siswa/home'); ?>" class="nav-link active">
            <?php }else{ ?>
            <a href="<?php echo base_url('siswa/home'); ?>" class="nav-link">
            <?php } ?>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <?php if($sidebar == "Tagihan"){ ?>
            <a href="<?php echo base_url('siswa/tagihan'); ?>" class="nav-link active">
            <?php }else{ ?>
            <a href="<?php echo base_url('siswa/tagihan'); ?>" class="nav-link">
            <?php } ?>
              <i class="nav-icon fas fa-money-bill-alt"></i>
              <p>
                Tagihan Pembayaran
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('home/logout'); ?>" class="nav-link">
              <i class="nav-icon fas fa-door-open"></i>
              <p>
                Keluar
              </p>
            </a>
          </li>

        </ul>
      </nav>
    </div>
  </aside>