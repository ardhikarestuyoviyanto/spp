<?php echo $this->include('partisi/head'); ?>
<?= $this->include('partisi/js_app') ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
<ul class="navbar-nav">
    <li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link"><?php echo date('d-M-Y - H:i:s') ?></a>
    </li>
</ul>

<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"  href="<?php echo base_url('home/logout'); ?>" role="button">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </li>
</ul>
</nav>

<?= $this->include('partisi/sidebar_siswa'); ?>
<?= $this->renderSection('content'); ?>
<?= $this->include('partisi/footer'); ?>
<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
</body>
</html>
