<?= $this->extend('admin/doc/kop_surat'); ?>
<?= $this->section('content'); ?>
<hr>
<?php foreach ($data_siswa as $x): ?>
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
		<td>Semua Tahun Ajaran</td>
	</tr>
</tbody>
</table>

<hr>
<?php endforeach; ?>
<table border="1" class="table table-striped table-bordered">
    <tr>
        <th width="1%">No</th>
        <th>Tahun Ajaran</th>
        <th>Nama Pembayaran</th>
        <th>Tipe Tagihan</th>
        <th>Total Tagihan</th>
        <th>Sudah Dibayar</th>
    </tr>
    <tbody>
    <?php $i=1; if(!empty($data_bulanan)): ?>
        <?php  foreach ($data_bulanan as $x): ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $x['tahun_ajaran']; ?></td>
            <td><?php echo $x['nama_pembayaran']; ?></td>
            <td>Bulanan</td>
            <td><?php echo "Rp. ".number_format($x['total_tagihan'] ,2,',','.'); ?></td>
            <td><?php echo "Rp. ".number_format($x['total_bayar'] ,2,',','.'); ?></td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php foreach ($data_bebas as $x): ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $x->tahun_ajaran; ?></td>
            <td><?php echo $x->nama_pembayaran; ?></td>
            <td>Lain - Lain</td>
            <td><?php echo "Rp. ".number_format($x->total_tagihan ,2,',','.'); ?></td>
            <td><?php echo "Rp. ".number_format($x->total_bayar ,2,',','.'); ?></td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
<br><br>
<?= $this->endSection('content'); ?>
