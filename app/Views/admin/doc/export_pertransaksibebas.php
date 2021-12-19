<?= $this->extend('admin/doc/kop_surat'); ?>
<?= $this->section('content'); ?>
<?php foreach ($informasiTagihan as $x): ?>
<hr>
<h3 class="text-center text-bold"><?php echo $x->nama_pembayaran; ?></h3>
<table width="100%">
	<tbody>
    <tr>
		<td width="200px">NIS </td>
		<td width="10px">:</td>
		<td><?php echo $x->nis; ?></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><?php echo $x->nama_siswa; ?></td>
	</tr>
	<tr>
		<td>Kelas </td>
		<td>:</td>
		<td><?php echo $x->nama_kelas; ?></td>
	</tr>
	<tr>
		<td>Tahun Pelajaran</td>
		<td>:</td>
		<td><?php echo $x->tahun_ajaran; ?></td>
	</tr>
</tbody>
</table>

<?php endforeach; ?>

<hr>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Jumlah Bayar</th>
        <th scope="col">Opsi</th>
        <th scope="col">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php $total_bayar = 0; $i=1; foreach ($data as $x): ?>
        <?php $newDate = date("d F Y", strtotime($x->tgl)); $total_bayar = $total_bayar + $x->total_bayar; $total_tagihan = $x->total_tagihan; $id_tagihan = $x->id_tagihan;?>
        <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $newDate; ?></td>
        <td><?php echo "Rp. ".number_format($x->total_bayar,2,',','.'); ?></td>
        <td><?php echo ucfirst($x->tipe_pembayaran); ?></td>
        <td><?php echo ucfirst($x->status_bayar); ?></td>

        </tr>
        <?php endforeach; ?>
    
    </tbody>
    </table>

<br><br>
<?= $this->endSection('content'); ?>
