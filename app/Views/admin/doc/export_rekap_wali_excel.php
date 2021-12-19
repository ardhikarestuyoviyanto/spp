<style type="text/css" media="print">
  @page { size: landscape; }

  .str{
	mso-number-format : \@;
}
</style>
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$namakelas.xls");
?>
<?php use App\Models\ModelAdmin; $modelss = new ModelAdmin();?>
<h3 class="text-center">Rekap Pembayaran</h3>
<table width="100%">
	<tbody>
    <tr class="text-bold">
		<td>Tahun Ajaran</td>
		<td>:</td>
		<td><?php echo urldecode($_GET['tahun']) ?></td>
	</tr>
    <tr class="text-bold">
		<td width="200px">Kelas</td>
		<td width="10px">:</td>
		<td><?php echo $namakelas; ?></td>
	</tr>
	<tr class="text-bold">
		<td>Periode</td>
		<td>:</td>
		<td><?php echo date("d F Y", strtotime($_GET['start']))." s.d ".date("d F Y", strtotime($_GET['finish'])); ?></td>
	</tr>
</tbody>
</table>

<table border="1" class="table table-bordered">
    <tr>
        <td rowspan="2" style="vertical-align : middle;text-align:center;">No</td>
        <td rowspan="2" style="vertical-align : middle;text-align:center;">Nama Siswa</td>
        <td colspan="<?php echo (count($bulanan) + count($bebas)) * 2; ?>" style="vertical-align : middle;text-align:center;">Jenis Pembayaran</td>  
    </tr>
    <tr>
        <?php foreach ($bulanan as $x): ?>
        <td style="vertical-align : middle;text-align:center;"><?php echo $x->nama_pembayaran; ?></td>
        <?php endforeach; ?>
        <?php foreach ($bebas as $x): ?>
        <td style="vertical-align : middle;text-align:center;"><?php echo $x->nama_pembayaran; ?></td>
        <?php endforeach; ?>
        <td style="vertical-align : middle;text-align:center;">Total Tagihan</td>
    </tr>
    <?php $i=1; foreach ($siswa as $z): ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $z->nama_siswa; ?></td>
        <?php $total_tagihan = 0; foreach ($bulanan as $x): ?>
        <?php $res = $modelss->detailPembayaranBulanan($z->nis, $x->id_pembayaran, $_GET['start'], $_GET['finish']); ?>
        <?php $total_tagihan = $total_tagihan + $res['total_tagihan'] ?>
        <td><?php if($res['total_tagihan'] == 0 && $res['total_bayar'] == 0){echo "Rp. ".number_format(0 ,2,',','.'); }else if($res['total_tagihan'] == $res['total_bayar']){echo "Lunas"; }else{echo "Rp. ".number_format($res['total_tagihan'] - $res['total_bayar'] ,2,',','.');} ?></td>
        <?php endforeach; ?>

        <?php foreach ($bebas as $y): ?>
        <?php $res = $modelss->detailPembayaranbebas($z->nis, $y->id_pembayaran, $_GET['start'], $_GET['finish']); ?>
        <?php $total_tagihan = $total_tagihan + $res['total_tagihan'] ?>
        <td><?php if($res['total_tagihan'] == 0 && $res['total_bayar'] == 0){echo "Rp. ".number_format(0 ,2,',','.'); }else if($res['total_tagihan'] == $res['total_bayar']){echo "Lunas"; }else{echo "Rp. ".number_format($res['total_tagihan'] - $res['total_bayar'] ,2,',','.');} ?></td>
        <?php endforeach; ?>
        <td><?php echo "Rp. ".number_format($total_tagihan ,2,',','.'); ?></td>
    </tr>
    <?php endforeach;  ?>


</table><br>
<small>*) Data diatas menunjukan jumlah tunggakan yang harus dibayar siswa.</small><br>
<small>*) Rp. 0, menunjukkan siswa tidak menerima tagihan.</small>
<br><br>
