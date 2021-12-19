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
<h3 class="text-center">Bukti Penerima Tagihan</h3>
<h3 class="text-center"><?php echo $namapembayaran; ?></h3>
<br>
<table width="100%">
	<tbody>
    <tr>
		<td width="200px">Kelas </td>
		<td width="10px">:</td>
		<td><?php echo $kelas; ?></td>
	</tr>
	<tr>
		<td>Hari</td>
		<td>:</td>
		<td><?php echo $hari_indonesia[$hari]; ?></td>
	</tr>
	<tr>
		<td>Tanggal </td>
		<td>:</td>
		<td><?php echo $newDate; ?></td>
	</tr>
</tbody>
</table>
<hr>
<table border="1" class="table table-striped table-bordered">
    <tr>
        <th scope="col">No</th>
        <th scope="col">NIS</th>
        <th scope="col">Nama Siswa</th>
        <th scope="col">Total Tagihan</th>
        <th scope="col">Total Bayar</th>
        <th scope="col">Tunggakan</th>
        <th scope="col">Status</th>
    </tr>
    <tbody>
        <?php $total = 0; $i=1; foreach ($data as $x): ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $x->nis; ?></td>
                <td><?php echo $x->nama_siswa; ?></td>
                <td><?php echo "Rp. ".number_format($x->total_tagihan ,2,',','.'); ?></td>
                <td><?php echo "Rp. ".number_format($modelss->getDetailPembayaranBebas($x->id_tagihan) ,2,',','.'); ?></td>
                <td><?php echo "Rp. ".number_format($x->total_tagihan - $modelss->getDetailPembayaranBebas($x->id_tagihan) ,2,',','.'); ?></td>
                <?php if($x->total_tagihan == $modelss->getDetailPembayaranBebas($x->id_tagihan)){ ?>
                <td>Lunas</td>
                <?php }else{ ?>
                <td>Belum Lunas</td>
                <?php } ?>
            </tr>
        <?php $total = $total + $x->total_tagihan; endforeach; ?>
        <tr>
            <td colspan="3" class="text-bold">Total : </td>
            <td><?php echo "Rp. ".number_format($total ,2,',','.'); ?></td>
        </tr>
    </tbody>
</table>
<br><br>
<?= $this->endSection('content'); ?>
