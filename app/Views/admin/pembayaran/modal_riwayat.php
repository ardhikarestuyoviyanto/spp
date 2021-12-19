<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Riwayat Pembayaran Multi Bayar</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button></div>
<div class="modal-body">
<table class="table table-bordered" id="MultiBayar">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Kode Bayar</th>
            <th scope="col">Tgl Bayar</th>
            <th scope="col">Total Bayar</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; foreach ($data_left as $x): ?> 
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $x->kd_tagihan; ?></td>
            <td><?php echo $x->tgl; ?></td>
            <td><?php echo "Rp. ".number_format($x->harus_dibayar ,2,',','.'); ?></td>
            <td>
                <a onclick="return confirm('Yakin Mau Menghapus Pembayaran Ini ? ')" title="hapus pembayaran" href="<?php echo base_url('Admin/hapustagihanmulti/'.$x->kd_tagihan.'/'.$x->nis) ?>"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a> <a title="cetak pembayaran" target="__BLANK" href="<?php echo base_url('export/export_multibayar/'.$x->kd_tagihan.'/'.$x->nis); ?>"><span class="badge badge-primary"><i class="fas fa-print"></i></span></a>
            </td>
        </tr>
        <?php $i++; endforeach; ?>

        <?php foreach ($data_right as $x): ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $x->kd_tagihan; ?></td>
            <td><?php echo $x->tgl; ?></td>
            <td><?php echo "Rp. ".number_format($x->harus_dibayar ,2,',','.'); ?></td>
            <td>
                <a onclick="return confirm('Yakin Mau Menghapus Pembayaran Ini ? ')" title="hapus pembayaran" href="<?php echo base_url('Admin/hapustagihanmulti/'.$x->kd_tagihan.'/'.$x->nis) ?>"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a> <a title="cetak pembayaran" target="__BLANK" href="<?php echo base_url('export/export_multibayar/'.$x->kd_tagihan.'/'.$x->nis); ?>"><span class="badge badge-primary"><i class="fas fa-print"></i></span></a>
            </td>
        </tr>
        <?php $i++; endforeach; ?>

        <?php foreach ($data_inner as $x): ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $x->kd_tagihan; ?></td>
            <td><?php echo $x->tgl; ?></td>
            <td><?php echo "Rp. ".number_format($x->harus_dibayar ,2,',','.'); ?></td>
            <td>
                <a onclick="return confirm('Yakin Mau Menghapus Pembayaran Ini ? ')" title="hapus pembayaran" href="<?php echo base_url('Admin/hapustagihanmulti/'.$x->kd_tagihan.'/'.$x->nis) ?>"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a> <a title="cetak pembayaran" target="__BLANK" href="<?php echo base_url('export/export_multibayar/'.$x->kd_tagihan.'/'.$x->nis); ?>"><span class="badge badge-primary"><i class="fas fa-print"></i></span></a>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>
</div>
<div class="modal-footer"><small>*) Riwayat Transaksi Terbaru akan muncul pada rechord table yang paling atas</small>
</div>
</div>
