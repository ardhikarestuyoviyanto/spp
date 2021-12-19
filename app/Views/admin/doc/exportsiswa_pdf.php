<?= $this->extend('admin/doc/kop_surat'); ?>
<?= $this->section('content'); ?>
<hr>
<h3 class="text-center text-bold">Kelas <?php if(isset($_GET['kelas'])) echo urldecode($_GET['kelas']) ?></h3>
<br>
<table class="table table-bordered table-striped" id="DataSiswa">
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
            <td><?php echo $x->no_hp; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br><br>
<?= $this->endSection('content'); ?>
