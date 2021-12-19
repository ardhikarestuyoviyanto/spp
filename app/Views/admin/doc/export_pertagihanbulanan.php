<?= $this->extend('admin/doc/kop_surat'); ?>
<?= $this->section('content'); ?>
<hr>
<?php foreach ($informasiTagihan as $x): ?>
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
		<td><?php echo $nama_siswa; ?></td>
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

<hr>
<?php endforeach; ?>

<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">Bulan</th>
        <th scope="col">Tgl Bayar</th>
        <th scope="col">Opsi Bayar</th>
        <th scope="col">Tagihan</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($data)): ?>
    <?php foreach ($data as $x): ?>
    <tr>
        <td>1</td>
        <td>Januari</td>
        <td><?php if($x['tgl_jan'] == null){ ?> <?php echo "belum bayar" ?> <?php }else{ ?><?php echo $x['tgl_jan'];  ?> <?php } ?></td>
        <td>
            <?php if($x['tipe_jan'] != null){ ?>
            <?php echo ucwords($x['tipe_jan']); ?>
            <?php }else{ ?>
            Belum Bayar
            <?php } ?>
        </td>
        <td><?php echo "Rp. ".number_format($x['tag_jan'] ,2,',','.'); ?>/<?php if($x['tipe_jan'] != null){echo "lunas"; }else{echo "belum lunas"; } ?></td>
    </tr>

    <tr>
        <td>2</td>
        <td>Februari</td>
        <td><?php if($x['tgl_feb'] == null){ ?> <?php echo "belum bayar" ?> <?php }else{ ?><?php echo $x['tgl_feb'];  ?> <?php } ?></td>
        <td>
            <?php if($x['tipe_feb'] != null){ ?>
            <?php echo ucwords($x['tipe_feb']); ?>
            <?php }else{ ?>
            Belum Bayar
            <?php } ?>
        </td>
        <td><?php echo "Rp. ".number_format($x['tag_feb'] ,2,',','.'); ?>/<?php if($x['tipe_feb'] != null){echo "lunas"; }else{echo "belum lunas"; } ?></td>
    </tr>

    <tr>
        <td>3</td>
        <td>Maret</td>
        <td><?php if($x['tgl_mar'] == null){ ?> <?php echo "belum bayar" ?> <?php }else{ ?><?php echo $x['tgl_mar'];  ?> <?php } ?></td>
        <td>
            <?php if($x['tipe_mar'] != null){ ?>
            <?php echo ucwords($x['tipe_mar']); ?>
            <?php }else{ ?>
            Belum Bayar
            <?php } ?>
        </td>
        <td><?php echo "Rp. ".number_format($x['tag_mar'] ,2,',','.'); ?>/<?php if($x['tipe_mar'] != null){echo "lunas"; }else{echo "belum lunas"; } ?></td>
    </tr>

    <tr>
        <td>4</td>
        <td>April</td>
        <td><?php if($x['tgl_apr'] == null){ ?> <?php echo "belum bayar" ?> <?php }else{ ?><?php echo $x['tgl_apr'];  ?> <?php } ?></td>
        <td>
            <?php if($x['tipe_apr'] != null){ ?>
            <?php echo ucwords($x['tipe_apr']); ?>
            <?php }else{ ?>
            Belum Bayar
            <?php } ?>
        </td>
        <td><?php echo "Rp. ".number_format($x['tag_apr'] ,2,',','.'); ?>/<?php if($x['tipe_apr'] != null){echo "lunas"; }else{echo "belum lunas"; } ?></td>
    </tr>

    <tr>
        <td>5</td>
        <td>Mei</td>
        <td><?php if($x['tgl_mei'] == null){ ?> <?php echo "belum bayar" ?> <?php }else{ ?><?php echo $x['tgl_mei'];  ?> <?php } ?></td>
        <td>
            <?php if($x['tipe_mei'] != null){ ?>
            <?php echo ucwords($x['tipe_mei']); ?>
            <?php }else{ ?>
            Belum Bayar
            <?php } ?>
        </td>
        <td><?php echo "Rp. ".number_format($x['tag_mei'] ,2,',','.'); ?>/<?php if($x['tipe_mei'] != null){echo "lunas"; }else{echo "belum lunas"; } ?></td>
    </tr>

    <tr>
        <td>6</td>
        <td>Juni</td>
        <td><?php if($x['tgl_jun'] == null){ ?> <?php echo "belum bayar" ?> <?php }else{ ?><?php echo $x['tgl_jun'];  ?> <?php } ?></td>
        <td>
            <?php if($x['tipe_jun'] != null){ ?>
            <?php echo ucwords($x['tipe_jun']); ?>
            <?php }else{ ?>
            Belum Bayar
            <?php } ?>
        </td>
        <td><?php echo "Rp. ".number_format($x['tag_jun'] ,2,',','.'); ?>/<?php if($x['tipe_jun'] != null){echo "lunas"; }else{echo "belum lunas"; } ?></td>
    </tr>

    <tr>
        <td>7</td>
        <td>July</td>
        <td><?php if($x['tgl_jul'] == null){ ?> <?php echo "belum bayar" ?> <?php }else{ ?><?php echo $x['tgl_jul'];  ?> <?php } ?></td>
        <td>
            <?php if($x['tipe_jul'] != null){ ?>
            <?php echo ucwords($x['tipe_jul']); ?>
            <?php }else{ ?>
            Belum Bayar
            <?php } ?>
        </td>
        <td><?php echo "Rp. ".number_format($x['tag_jul'] ,2,',','.'); ?>/<?php if($x['tipe_jul'] != null){echo "lunas"; }else{echo "belum lunas"; } ?></td>
    </tr>

    <tr>
        <td>8</td>
        <td>Agustus</td>
        <td><?php if($x['tgl_agu'] == null){ ?> <?php echo "belum bayar" ?> <?php }else{ ?><?php echo $x['tgl_agu'];  ?> <?php } ?></td>
        <td>
            <?php if($x['tipe_agu'] != null){ ?>
            <?php echo ucwords($x['tipe_agu']); ?>
            <?php }else{ ?>
            Belum Bayar
            <?php } ?>
        </td>
        <td><?php echo "Rp. ".number_format($x['tag_agu'] ,2,',','.'); ?>/<?php if($x['tipe_agu'] != null){echo "lunas"; }else{echo "belum lunas"; } ?></td>
    </tr>

    <tr>
        <td>9</td>
        <td>September</td>
        <td><?php if($x['tgl_sep'] == null){ ?> <?php echo "belum bayar" ?> <?php }else{ ?><?php echo $x['tgl_sep'];  ?> <?php } ?></td>
        <td>
            <?php if($x['tipe_sep'] != null){ ?>
            <?php echo ucwords($x['tipe_sep']); ?>
            <?php }else{ ?>
            Belum Bayar
            <?php } ?>
        </td>
        <td><?php echo "Rp. ".number_format($x['tag_sep'] ,2,',','.'); ?>/<?php if($x['tipe_sep'] != null){echo "lunas"; }else{echo "belum lunas"; } ?></td>
    </tr>

    <tr>
        <td>10</td>
        <td>Oktober</td>
        <td><?php if($x['tgl_okt'] == null){ ?> <?php echo "belum bayar" ?> <?php }else{ ?><?php echo $x['tgl_okt'];  ?> <?php } ?></td>
        <td>
            <?php if($x['tipe_okt'] != null){ ?>
            <?php echo ucwords($x['tipe_okt']); ?>
            <?php }else{ ?>
            Belum Bayar
            <?php } ?>
        </td>
        <td><?php echo "Rp. ".number_format($x['tag_okt'] ,2,',','.'); ?>/<?php if($x['tipe_okt'] != null){echo "lunas"; }else{echo "belum lunas"; } ?></td>
    </tr>

    <tr>
        <td>11</td>
        <td>November</td>
        <td><?php if($x['tgl_nov'] == null){ ?> <?php echo "belum bayar" ?> <?php }else{ ?><?php echo $x['tgl_nov'];  ?> <?php } ?></td>
        <td>
            <?php if($x['tipe_nov'] != null){ ?>
            <?php echo ucwords($x['tipe_nov']); ?>
            <?php }else{ ?>
            Belum Bayar
            <?php } ?>
        </td>
        <td><?php echo "Rp. ".number_format($x['tag_nov'] ,2,',','.'); ?>/<?php if($x['tipe_nov'] != null){echo "lunas"; }else{echo "belum lunas"; } ?></td>
    </tr>

    <tr>
        <td>12</td>
        <td>Desember</td>
        <td><?php if($x['tgl_des'] == null){ ?> <?php echo "belum bayar" ?> <?php }else{ ?><?php echo $x['tgl_des'];  ?> <?php } ?></td>
        <td>
            <?php if($x['tipe_des'] != null){ ?>
            <?php echo ucwords($x['tipe_des']); ?>
            <?php }else{ ?>
            Belum Bayar
            <?php } ?>
        </td>
        <td><?php echo "Rp. ".number_format($x['tag_des'] ,2,',','.'); ?>/<?php if($x['tipe_des'] != null){echo "lunas"; }else{echo "belum lunas"; } ?></td>
    </tr>

    <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>

<br><br>
<?= $this->endSection('content'); ?>
