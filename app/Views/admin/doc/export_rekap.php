<?= $this->extend('admin/doc/kop_surat'); ?>
<?= $this->section('content'); ?>
<hr>
<?php use App\Models\ModelAdmin; $modelss = new ModelAdmin();?>
<?php $newDate = date("d F Y", strtotime(date('Y-m-d'))); ?>
<?php
 $hari   = date('l', microtime('Y-m-d'));
 $hari_indonesia = array('Monday'  => 'Senin',
    'Tuesday'  => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu',
    'Sunday' => 'Minggu');
?>
<h3 class="text-center">Rekapitulasi Penerimaan</h3>
<h3 class="text-center"><?php echo $namapembayaran; ?></h3>
<br>
<table width="100%">
	<tbody>
    <tr>
		<td width="200px">Kelas</td>
		<td width="10px">:</td>
		<td>X, XI dan XII</td>
	</tr>
	<tr>
		<td>Hari, Tgl Cetak</td>
		<td>:</td>
		<td><?php echo $hari_indonesia[$hari].", ".$newDate;; ?></td>
	</tr>
	<tr class="text-bold">
		<td>Tanggal</td>
		<td>:</td>
		<td><?php echo date("d F Y", strtotime($_GET['start']))." s.d ".date("d F Y", strtotime($_GET['finish'])); ?></td>
	</tr>
</tbody>
</table>
<hr>
<table border="1" class="table table-striped table-bordered">
    <tr>
        <th scope="col">No</th>
        <th scope="col">Kelas</th>
        <th scope="col">Jumlah</th>
    </tr>
    <tbody>
        <?php $total = 0; $i=1; foreach ($kelas as $x): ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $x->nama_kelas; ?></td>
                <td><?php echo "Rp. ".number_format($modelss->getRekapBebas($x->id_kelas, $_GET['pembayaran'], urldecode($_GET['tahun']), $_GET['start'], $_GET['finish']) ,2,',','.'); ?></td>
            </tr>
            <?php $total = $total + $modelss->getRekapBebas($x->id_kelas, $_GET['pembayaran'], urldecode($_GET['tahun']), $_GET['start'], $_GET['finish']); ?>
        <?php endforeach; ?>
        <tr class="text-bold">
            <td></td>
            <td colspan="1">Jumlah</td>
            <td colspan="2"><?php echo "Rp. ".number_format($total ,2,',','.'); ?></td>
        </tr>
    </tbody>
</table>
<br><br>
<?= $this->endSection('content'); ?>
