<style type="text/css" media="print">
  .str{
	mso-number-format : \@;
}
</style>
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Tagihan Lain.xls");
?>
<?php use App\Models\ModelAdmin; $modelss = new ModelAdmin();?>

<h3 class="text-center">Bukti Penerima Tagihan</h3>
<h3 class="text-center"><?php echo $namapembayaran; ?></h3>
<br>
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