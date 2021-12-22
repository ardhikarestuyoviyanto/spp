<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo base_url('admin/home'); ?>" class="brand-link">
      <img src="<?php echo base_url('dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Administrator</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://i.pinimg.com/originals/72/cd/96/72cd969f8e21be3476277d12d44c791c.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php if(isset($_SESSION['nama_admin'])){echo $_SESSION['nama_admin']; }else{echo "Administrator";}; ?></a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <?php if($sidebar == "Dashboard"){ ?>
            <a href="<?php echo base_url('admin/home'); ?>" class="nav-link active">
            <?php }else{ ?>
            <a href="<?php echo base_url('admin/home'); ?>" class="nav-link">
            <?php } ?>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <?php if($sidebar == "Users"){ ?>
            <a href="<?php echo base_url('admin/users'); ?>" class="nav-link active">
            <?php }else{ ?>
            <a href="<?php echo base_url('admin/users'); ?>" class="nav-link">
            <?php } ?>
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manajemen User
              </p>
            </a>
          </li>

          <?php if($sidebar == "Tahun Ajaran" || $sidebar == "Data Siswa" || $sidebar == "Data Kelas" || $sidebar == "Kenaikan Kelas" || $sidebar == "Kelulusan"){ ?>
          <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
          <?php }else{ ?>
          <li class="nav-item">
              <a href="#" class="nav-link">
          <?php } ?>
              <i class="nav-icon fas fa-book"></i>
              <p>
              Master Data
              <i class="right fas fa-angle-left"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <?php if($sidebar == "Tahun Ajaran"){ ?>
                      <a href="<?php echo base_url('admin/tahunajar') ?>" class="nav-link active">
                  <?php }else{ ?>
                      <a href="<?php echo base_url('admin/tahunajar') ?>" class="nav-link">
                  <?php } ?>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tahun Ajaran</p>
                  </a>
                  </li>
              </ul>

              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <?php if($sidebar == "Data Kelas"){ ?>
                      <a href="<?php echo base_url('admin/datakelas') ?>" class="nav-link active">
                  <?php }else{ ?>
                      <a href="<?php echo base_url('admin/datakelas') ?>" class="nav-link">
                  <?php } ?>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Kelas</p>
                  </a>
                  </li>
              </ul>

              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <?php if($sidebar == "Data Siswa"){ ?>
                      <a href="<?php echo base_url('admin/datasiswa') ?>" class="nav-link active">
                  <?php }else{ ?>
                      <a href="<?php echo base_url('admin/datasiswa') ?>" class="nav-link">
                  <?php } ?>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Siswa</p>
                  </a>
                  </li>
              </ul>

              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <?php if($sidebar == "Kenaikan Kelas"){ ?>
                      <a href="<?php echo base_url('admin/kenaikankelas') ?>" class="nav-link active">
                  <?php }else{ ?>
                      <a href="<?php echo base_url('admin/kenaikankelas') ?>" class="nav-link">
                  <?php } ?>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kenaikan Kelas</p>
                  </a>
                  </li>
              </ul>

              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <?php if($sidebar == "Kelulusan"){ ?>
                      <a href="<?php echo base_url('admin/kelulusan') ?>" class="nav-link active">
                  <?php }else{ ?>
                      <a href="<?php echo base_url('admin/kelulusan') ?>" class="nav-link">
                  <?php } ?>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kelulusan</p>
                  </a>
                  </li>
              </ul>
          </li>


          <?php if($sidebar == "Pos Bayar"){ ?>
          <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
          <?php }else{ ?>
          <li class="nav-item">
              <a href="#" class="nav-link">
          <?php } ?>
              <i class="nav-icon fas fa-funnel-dollar"></i>
              <p>
              Keuangan
              <i class="right fas fa-angle-left"></i>
              </p>
            </a>

              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <?php if($sidebar == "Pos Bayar"){ ?>
                      <a href="<?php echo base_url('admin/pos') ?>" class="nav-link active">
                  <?php }else{ ?>
                      <a href="<?php echo base_url('admin/pos') ?>" class="nav-link">
                  <?php } ?>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Setting Pembayaran</p>
                  </a>
                  </li>
              </ul>
          </li>

          <li class="nav-item">
            <?php if($sidebar == "Pembayaran Siswa"){ ?>
            <a href="<?php echo base_url('admin/pembayaran'); ?>" class="nav-link active">
            <?php }else{ ?>
            <a href="<?php echo base_url('admin/pembayaran'); ?>" class="nav-link">
            <?php } ?>
              <i class="nav-icon fas fa-money-bill-alt"></i>
              <p>
                Pembayaran Siswa
              </p>
            </a>
          </li>

          <?php if($sidebar == "Laporan Siswa" || $sidebar == "Laporan SPP" || $sidebar == "Laporan Lain" || $sidebar == "Rekap" || $sidebar == "LapWali" || $sidebar == "kartutag" || $sidebar == "pemasukan"){ ?>
          <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
          <?php }else{ ?>
          <li class="nav-item">
              <a href="#" class="nav-link">
          <?php } ?>
          <i class="nav-icon fas fa-file"></i>
              <p>
              Laporan
              <i class="right fas fa-angle-left"></i>
              </p>
            </a>

              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <?php if($sidebar == "Laporan Siswa"){ ?>
                      <a href="<?php echo base_url('admin/lapsiswa') ?>" class="nav-link active">
                  <?php }else{ ?>
                      <a href="<?php echo base_url('admin/lapsiswa') ?>" class="nav-link">
                  <?php } ?>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lap. Data. Siswa</p>
                  </a>
                  </li>
              </ul>

              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <?php if($sidebar == "Laporan SPP"){ ?>
                      <a href="<?php echo base_url('admin/lapspp') ?>" class="nav-link active">
                  <?php }else{ ?>
                      <a href="<?php echo base_url('admin/lapspp') ?>" class="nav-link">
                  <?php } ?>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lap. Pemb. SPP</p>
                  </a>
                  </li>
              </ul>

              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <?php if($sidebar == "Laporan Lain"){ ?>
                      <a href="<?php echo base_url('admin/laplain') ?>" class="nav-link active">
                  <?php }else{ ?>
                      <a href="<?php echo base_url('admin/laplain') ?>" class="nav-link">
                  <?php } ?>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lap. Pemb. Lain</p>
                  </a>
                  </li>
              </ul>

              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <?php if($sidebar == "kartutag"){ ?>
                      <a href="<?php echo base_url('admin/kartutag') ?>" class="nav-link active">
                  <?php }else{ ?>
                      <a href="<?php echo base_url('admin/kartutag') ?>" class="nav-link">
                  <?php } ?>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kartu Tagihan</p>
                  </a>
                  </li>
              </ul>

              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <?php if($sidebar == "Rekap"){ ?>
                      <a href="<?php echo base_url('admin/rekap') ?>" class="nav-link active">
                  <?php }else{ ?>
                      <a href="<?php echo base_url('admin/rekap') ?>" class="nav-link">
                  <?php } ?>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Rekap Pembayaran</p>
                  </a>
                  </li>
              </ul>

              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <?php if($sidebar == "pemasukan"){ ?>
                      <a href="<?php echo base_url('admin/pemasukan') ?>" class="nav-link active">
                  <?php }else{ ?>
                      <a href="<?php echo base_url('admin/pemasukan') ?>" class="nav-link">
                  <?php } ?>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pemasukan Keuangan</p>
                  </a>
                  </li>
              </ul>

          </li>

        <?php if($sidebar == "Sekolah"){ ?>
          <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
          <?php }else{ ?>
          <li class="nav-item">
              <a href="#" class="nav-link">
          <?php } ?>
              <i class="nav-icon fas fa-cog"></i>
              <p>
              Pengaturan
              <i class="right fas fa-angle-left"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <?php if($sidebar == "Sekolah"){ ?>
                      <a href="<?php echo base_url('admin/setting') ?>" class="nav-link active">
                  <?php }else{ ?>
                      <a href="<?php echo base_url('admin/setting') ?>" class="nav-link">
                  <?php } ?>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Sekolah</p>
                  </a>
                  </li>
              </ul>
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