<?= $this->extend('admin/doc/kop_surat'); ?>
<?= $this->section('content'); ?>
<style type="text/css" media="print">
  @page { size: landscape; }
</style>
<hr>
<?php
    use App\Models\ModelAdmin;
    $model_det = new ModelAdmin();
    foreach ($kelas as $x):
        $nama_kelas = $x->nama_kelas;
    endforeach;

?>
<h3 class="text-center text-bold"><?php echo $pembayaran; ?></h3><br>

<table width="100%">
	<tbody>
    <tr class="text-bold">
		<td>Kelas</td>
		<td>:</td>
		<td><?php echo $nama_kelas; ?></td>
	</tr>
    <tr class="text-bold">
		<td width="200px">Tahun Ajaran</td>
		<td width="10px">:</td>
		<td><?php echo ucfirst($_GET['tahun']); ?></td>
	</tr>
	<tr class="text-bold">
		<td>Periode</td>
		<td>:</td>
		<td><?php echo date("d F Y", strtotime($_GET['start']))." s.d ".date("d F Y", strtotime($_GET['finish'])); ?></td>
	</tr>
</tbody>
</table>
<hr>
<font size="1">
    <table border="1" class="table table-bordered">
    <tr>
        <td rowspan="2" style="vertical-align : middle;text-align:center;">No</td>
        <td rowspan="2" style="vertical-align : middle;text-align:center;">NIS</td>
        <td rowspan="2" style="vertical-align : middle;text-align:center;">Nama Siswa</td>
        <td colspan="2" style="vertical-align : middle;text-align:center;">July</td>  
        <td colspan="2" style="vertical-align : middle;text-align:center;">Agustus</td>  
        <td colspan="2" style="vertical-align : middle;text-align:center;">September</td>  
        <td colspan="2" style="vertical-align : middle;text-align:center;">Oktober</td>  
        <td colspan="2" style="vertical-align : middle;text-align:center;">November</td>  
        <td colspan="2" style="vertical-align : middle;text-align:center;">Desember</td>  
        <td colspan="2" style="vertical-align : middle;text-align:center;">Januari</td>
        <td colspan="2" style="vertical-align : middle;text-align:center;">Februari</td>  
        <td colspan="2" style="vertical-align : middle;text-align:center;">Maret</td>  
        <td colspan="2" style="vertical-align : middle;text-align:center;">April</td>  
        <td colspan="2" style="vertical-align : middle;text-align:center;">Mei</td>  
        <td colspan="2" style="vertical-align : middle;text-align:center;">Juni</td>
    </tr>
    <tr>
       <td style="vertical-align : middle;text-align:center;">Rp. </td>
       <td style="vertical-align : middle;text-align:center;">Tgl</td>
       <td style="vertical-align : middle;text-align:center;">Rp. </td>
       <td style="vertical-align : middle;text-align:center;">Tgl</td>
       <td style="vertical-align : middle;text-align:center;">Rp.</td>
       <td style="vertical-align : middle;text-align:center;">Tgl</td>
       <td style="vertical-align : middle;text-align:center;">Rp.</td>
       <td style="vertical-align : middle;text-align:center;">Tgl</td>
       <td style="vertical-align : middle;text-align:center;">Rp.</td>
       <td style="vertical-align : middle;text-align:center;">Tgl</td>
       <td style="vertical-align : middle;text-align:center;">Rp.</td>
       <td style="vertical-align : middle;text-align:center;">Tgl</td>
       <td style="vertical-align : middle;text-align:center;">Rp.</td>
       <td style="vertical-align : middle;text-align:center;">Tgl</td>
       <td style="vertical-align : middle;text-align:center;">Rp.</td>
       <td style="vertical-align : middle;text-align:center;">Tgl</td>
       <td style="vertical-align : middle;text-align:center;">Rp.</td>
       <td style="vertical-align : middle;text-align:center;">Tgl</td>
       <td style="vertical-align : middle;text-align:center;">Rp.</td>
       <td style="vertical-align : middle;text-align:center;">Tgl</td>
       <td style="vertical-align : middle;text-align:center;">Rp.</td>
       <td style="vertical-align : middle;text-align:center;">Tgl</td>
       <td style="vertical-align : middle;text-align:center;">Rp.</td>
       <td style="vertical-align : middle;text-align:center;">Tgl</td>
    </tr>
    <?php $i=1; foreach ($data as $x): ?>
    <tr>
       <td><?php echo $i++; ?></td>
       <td><?php echo $x->nis; ?></td>
       <td><?php echo $x->nama_siswa; ?></td>

       <td><?php echo number_format($x->tag_jul ,2,',','.'); ?></td>
       <td><?php echo $model_det->getDetailPembayaranBulanan($x->id_tagihan, "jul", $_GET['start'], $_GET['finish']); ?></td>

       <td><?php echo number_format($x->tag_agu ,2,',','.'); ?></td>
       <td><?php echo $model_det->getDetailPembayaranBulanan($x->id_tagihan, "agu", $_GET['start'], $_GET['finish']); ?></td>

       <td><?php echo number_format($x->tag_sep ,2,',','.'); ?></td>
       <td><?php echo $model_det->getDetailPembayaranBulanan($x->id_tagihan, "sep", $_GET['start'], $_GET['finish']); ?></td>

       <td><?php echo number_format($x->tag_okt ,2,',','.'); ?></td>
       <td><?php echo $model_det->getDetailPembayaranBulanan($x->id_tagihan, "okt", $_GET['start'], $_GET['finish']); ?></td>

       <td><?php echo number_format($x->tag_nov ,2,',','.'); ?></td>
       <td><?php echo $model_det->getDetailPembayaranBulanan($x->id_tagihan, "nov", $_GET['start'], $_GET['finish']); ?></td>
       
       <td><?php echo number_format($x->tag_des ,2,',','.'); ?></td>
       <td><?php echo $model_det->getDetailPembayaranBulanan($x->id_tagihan, "des", $_GET['start'], $_GET['finish']); ?></td>

       <td><?php echo number_format($x->tag_jan ,2,',','.'); ?></td>
       <td><?php echo $model_det->getDetailPembayaranBulanan($x->id_tagihan, "jan", $_GET['start'], $_GET['finish']); ?></td>

       <td><?php echo number_format($x->tag_feb ,2,',','.'); ?></td>
       <td><?php echo $model_det->getDetailPembayaranBulanan($x->id_tagihan, "feb", $_GET['start'], $_GET['finish']); ?></td>

       <td><?php echo number_format($x->tag_mar ,2,',','.'); ?></td>
       <td><?php echo $model_det->getDetailPembayaranBulanan($x->id_tagihan, "mar", $_GET['start'], $_GET['finish']); ?></td>

       <td><?php echo number_format($x->tag_apr ,2,',','.'); ?></td>
       <td><?php echo $model_det->getDetailPembayaranBulanan($x->id_tagihan, "apr", $_GET['start'], $_GET['finish']); ?></td>

       <td><?php echo number_format($x->tag_mei ,2,',','.'); ?></td>
       <td><?php echo $model_det->getDetailPembayaranBulanan($x->id_tagihan, "mei", $_GET['start'], $_GET['finish']); ?></td>

       <td><?php echo number_format($x->tag_jun ,2,',','.'); ?></td>
       <td><?php echo $model_det->getDetailPembayaranBulanan($x->id_tagihan, "jun", $_GET['start'], $_GET['finish']); ?></td>

    </tr>
    <?php endforeach; ?>
    </table>
</font>
<br><br>
<?= $this->endSection('content'); ?>
