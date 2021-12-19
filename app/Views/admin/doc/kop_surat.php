<!DOCTYPE html>
<html>
<head>
    <?php $newDate = date("d F Y", strtotime(date('Y-m-d'))); ?>
	<title><?php echo $newDate ?>	</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/jqvmap/jqvmap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/css/adminlte.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/summernote/summernote-bs4.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
    <?= $this->include('partisi/js_app') ?>
</head>
<body>

    <?php foreach ($data_sekolah as $x): ?>
    <table width="100%">
        <td width="100px" align="left">
            <img src="<?php echo base_url('dist/img/'.$x->logo_kiri) ?>" alt="" height="60px">
        </td>
        <td align="top">
            <h3 align="center" style="margin-bottom:8px;"><?php echo $x->nama_sekolah; ?></h3>
            <center><?php echo $x->alamat; ?></center>
        </td>
        <td width="100px" align="right">
            <img src="<?php echo base_url('dist/img/'.$x->logo_kanan) ?>" alt="" height="60px">
        </td>
    </table>

    <?= $this->renderSection('content'); ?>

    <?php if(isset($_GET['rekap'])){}else{ ?>
    <table width="100%">
        <tbody>
            <td align="left"></td>
            <td align="left">
                Jombang, <?php echo $newDate ?>	
                <br>Penerima,<br><br><br><br>
                <b><u> </u><br>-</b>
            </td>


            <td align="right"></td>
            <td align="right">
                Jombang, <?php echo $newDate ?>	
                <br>Bendahara,<br><br><br><br>
                <b><u><?php echo $x->bendahara; ?> </u><br>-</b>
            </td>
        </tbody>
    </table>
    <?php } ?>

    <?php endforeach; ?>
	<script>
		window.print();
	</script>

</body>
</html>