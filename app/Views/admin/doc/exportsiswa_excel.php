<style>
.str{
	mso-number-format : \@;
}
</style>

<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Siswa.xls");
?>

<table border="1">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">NISN</th>
        <th scope="col">NIS</th>
        <th scope="col">Nama Siswa</th>
        <th scope="col">Jenis Kelamin</th>
        <th scope="col">Kelas</th>
        <th scope="col">Nama Ortu</th>
        <th scope="col">No Hp</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach ($siswa as $x): ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $x->nisn; ?></td>
            <td><?php echo $x->nis; ?></td>
            <td><?php echo $x->nama_siswa; ?></td>
            <td><?php echo $x->jenis_kelamin; ?></td>
            <td><?php echo $x->nama_kelas; ?></td>
            <td><?php echo $x->nama_ortu; ?></td>
            <td class="str"><?php echo $x->no_hp; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>