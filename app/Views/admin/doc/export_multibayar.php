<?= $this->extend('admin/doc/kop_surat'); ?>
<?= $this->section('content'); ?>
<hr>
<?php foreach ($informasiTagihan as $x): ?>
<table width="100%">
	<tbody>
    <tr>
		<td width="200px">NIS </td>
		<td width="10px">:</td>
		<td><?php echo $x->nis; ?></td>
	</tr>
    <tr>
		<td width="200px">NISN </td>
		<td width="10px">:</td>
		<td><?php echo $x->nisn; ?></td>
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
</tbody>
</table>

<hr>
<?php endforeach; ?>

<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">Tahun Ajaran</th>
        <th scope="col">Nama Pembayaran</th>
        <th scope="col">Tipe Tagihan</th>
        <th scope="col">Total Tagihan</th>
        <th scope="col">Sudah Dibayar</th>
        <th scope="col">Tanggungan</th>
        </tr>
    </thead>

    <tbody>
        <?php $harus_bayar = 0; $i=1; ?>
        <?php foreach ($data_bulanan as $x):  ?>
        <?php $harus_bayar = $harus_bayar + $x->tanggungan; ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $x->tahun_ajaran; ?></td>
            <td><?php echo $x->nama_pembayaran; ?></td>
            <td><?php echo "Bulanan" ?></td>
            <td><?php echo "Rp. ".number_format($x->tanggungan+$x->sudah_dibayar,2,',','.'); ?></td>
            <td><?php echo "Rp. ".number_format($x->sudah_dibayar,2,',','.'); ?></td>
            <td><?php echo "Rp. ".number_format($x->tanggungan,2,',','.');?></td>                        
        </tr>


        <?php endforeach; ?>

        <?php foreach ($data_bebas as $y): ?>
        <?php $harus_bayar = $harus_bayar + $y->tanggungan; ?>
        <?php $type = $y->tipe_pembayaran; ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $y->tahun_ajaran; ?></td>
            <td><?php echo $y->nama_pembayaran; ?></td>
            <td><?php echo "Lain - Lain" ?></td>
            <td><?php echo "Rp. ".number_format($y->total_tagihan,2,',','.'); ?></td>
            <td><?php echo "Rp. ".number_format($y->sudah_dibayar,2,',','.'); ?></td>
            <td><?php echo "Rp. ".number_format($y->tanggungan,2,',','.');?></td>                       
        </tr>

        <?php endforeach; ?>

        <tr class="text-bold">
            <td colspan="6">Total Dibayar</td>
            <td><?php echo "Rp. ".number_format($harus_bayar ,2,',','.'); ?></td>
        </tr>
    </tbody>
</table><br>
<p>*)Jumlah Uang : <b><?php echo terbilang($harus_bayar); ?></b></p>
<?php
function terbilang($bilangan) {

    $angka = array('0','0','0','0','0','0','0','0','0','0',
                   '0','0','0','0','0','0');
    $kata = array('','satu','dua','tiga','empat','lima',
                  'enam','tujuh','delapan','sembilan');
    $tingkat = array('','ribu','juta','milyar','triliun');
  
    $panjang_bilangan = strlen($bilangan);
  
    /* pengujian panjang bilangan */
    if ($panjang_bilangan > 15) {
      $kalimat = "Diluar Batas";
      return $kalimat;
    }
  
    /* mengambil angka-angka yang ada dalam bilangan,
       dimasukkan ke dalam array */
    for ($i = 1; $i <= $panjang_bilangan; $i++) {
      $angka[$i] = substr($bilangan,-($i),1);
    }
  
    $i = 1;
    $j = 0;
    $kalimat = "";
  
  
    /* mulai proses iterasi terhadap array angka */
    while ($i <= $panjang_bilangan) {
  
      $subkalimat = "";
      $kata1 = "";
      $kata2 = "";
      $kata3 = "";
  
      /* untuk ratusan */
      if ($angka[$i+2] != "0") {
        if ($angka[$i+2] == "1") {
          $kata1 = "seratus";
        } else {
          $kata1 = $kata[$angka[$i+2]] . " ratus";
        }
      }
  
      /* untuk puluhan atau belasan */
      if ($angka[$i+1] != "0") {
        if ($angka[$i+1] == "1") {
          if ($angka[$i] == "0") {
            $kata2 = "sepuluh";
          } elseif ($angka[$i] == "1") {
            $kata2 = "sebelas";
          } else {
            $kata2 = $kata[$angka[$i]] . " belas";
          }
        } else {
          $kata2 = $kata[$angka[$i+1]] . " puluh";
        }
      }
  
      /* untuk satuan */
      if ($angka[$i] != "0") {
        if ($angka[$i+1] != "1") {
          $kata3 = $kata[$angka[$i]];
        }
      }
  
      /* pengujian angka apakah tidak nol semua,
         lalu ditambahkan tingkat */
      if (($angka[$i] != "0") OR ($angka[$i+1] != "0") OR
          ($angka[$i+2] != "0")) {
        $subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
      }
  
      /* gabungkan variabe sub kalimat (untuk satu blok 3 angka)
         ke variabel kalimat */
      $kalimat = $subkalimat . $kalimat;
      $i = $i + 3;
      $j = $j + 1;
  
    }
  
    /* mengganti satu ribu jadi seribu jika diperlukan */
    if (($angka[5] == "0") AND ($angka[6] == "0")) {
      $kalimat = str_replace("satu ribu","seribu",$kalimat);
    }
  
    return trim($kalimat);
  
}
?>
<br><br>
<?= $this->endSection('content'); ?>
