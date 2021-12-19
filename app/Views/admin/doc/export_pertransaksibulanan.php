<?= $this->extend('admin/doc/kop_surat'); ?>
<?= $this->section('content'); ?>
<hr>
<?php foreach ($informasiTagihan as $x): ?>
<h3 class="text-center text-bold"><?php echo $x->nama_pembayaran; ?></h3>
<hr>
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
        <th scope="col">Bulan</th>
        <th scope="col">Opsi</th>
        <th scope="col">Tagihan/Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach ($data as $x): ?>
        <?php $newDate = date("d F Y", strtotime($x->tgl)); ?>
        <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $newDate; ?></td>
        <?php if($x->bulan == "jan"){ ?>
        <td>Januari</td>
        <?php }else if($x->bulan == "feb"){ ?>
        <td>Februari</td>
        <?php }else if($x->bulan == "mar"){ ?>
        <td>Maret</td>
        <?php }else if($x->bulan == "apr"){ ?>
        <td>April</td>
        <?php }else if($x->bulan == "jun"){ ?>
        <td>Juni</td>
        <?php }else if($x->bulan == "jul"){ ?>
        <td>Juli</td>
        <?php }else if($x->bulan == "agu"){ ?>
        <td>Agustus</td>
        <?php }else if($x->bulan == "sep"){ ?>
        <td>September</td>
        <?php }else if($x->bulan == "okt"){ ?>
        <td>Oktober</td>
        <?php }else if($x->bulan == "nov"){ ?>
        <td>November</td>
        <?php }else if($x->bulan == "des"){ ?>
        <td>Desember</td>
        <?php } ?>
        <td><?php echo ucfirst($x->tipe_pembayaran); ?></td>
        <td><?php echo "Rp. ".number_format($x->total_bayar ,2,',','.'); ?>/Lunas</td>

        </tr>
        <?php endforeach; ?>
    
    </tbody>
    </table>

<br><br>
<?= $this->endSection('content'); ?>
