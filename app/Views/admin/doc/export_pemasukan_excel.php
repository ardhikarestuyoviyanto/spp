<style type="text/css" media="print">
  @page { size: landscape; }

  .str{
	mso-number-format : \@;
}
</style>
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Pemasukan Keuangan.xls");
?>

<h3 class="text-center">Data Pemasukan Keuangan</h3>
<br>
<table width="100%">
	<tbody>
    <tr class="text-bold">
		<td width="200px">Periode</td>
		<td width="10px">:</td>
		<td><?php echo date("d F Y", strtotime($_GET['start']))." s.d ".date("d F Y", strtotime($_GET['finish'])); ?></td>
	</tr>
</tbody>
</table>
<?php use App\Models\ModelAdmin; $modelss = new ModelAdmin();?>
<table border="1" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Nama Siswa</th>
            <th>Total Pembayaran</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; $total = 0; foreach ($siswa as $x):  ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $x->nama_kelas; ?></td>
        <td><?php echo $x->nama_siswa; ?></td>
        <td><?php echo "Rp. ".number_format($modelss->getBayarBebas($x->nis, $_GET['start'], $_GET['finish']) + $modelss->getBayarBulanan($x->nis,  $_GET['start'], $_GET['finish']) ,2,',','.'); ?></td>
    </tr>
    <?php $total = $total + $modelss->getBayarBebas($x->nis,  $_GET['start'], $_GET['finish']) + $modelss->getBayarBulanan($x->nis,  $_GET['start'], $_GET['finish']); endforeach; ?>
    <tr class="text-bold">
        <td></td>
        <td></td>
        <td>Total Pemasukan</td>
        <td><?php echo "Rp. ".number_format($total ,2,',','.'); ?></td>
    </tr>
    </tbody>
</table>
<br><br>
