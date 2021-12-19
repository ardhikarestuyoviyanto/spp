<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<style>
.tagihan{
  color:red;
}
.disabled {
  color: currentColor;
  cursor: not-allowed;
  opacity: 0.5;
  text-decoration: none;
}
</style>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pembayaran Bulanan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/pembayaran') ?>">Pembayaran</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/pembayaran?siswa='.$nis) ?>"><?php echo $nama_siswa; ?></a></li>
                <li class="breadcrumb-item active"><?php echo $nama_pembayaran; ?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">

        <div class="card card-info">
            <div class="card-header">
            Informasi Tagihan
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <table class="table table-striped">
                        <tbody>
                          <?php foreach ($informasiTagihan as $x): $nohp = $x->no_hp; $nama_pembayaran = $x->nama_pembayaran; $nama_siswa = $x->nama_siswa; ?>
                            <tr>
                              <td>Nama Pembayaran</td>
                              <td>:</td>
                              <td><?php echo $x->nama_pembayaran; ?></td>
                            </tr>
                            <tr>
                              <td>Tahun Ajaran</td>
                              <td>:</td>
                              <td><?php echo $x->tahun_ajaran; ?></td>
                            </tr>
                            <tr>
                              <td>NIS</td>
                              <td>:</td>
                              <td><?php echo $x->nis; ?></td>
                            </tr>
                            <tr>
                              <td>NISN</td>
                              <td>:</td>
                              <td><?php echo $x->nisn; ?></td>
                            </tr>
                            <tr>
                              <td>Nama Siswa</td>
                              <td>:</td>
                              <td><?php echo $x->nama_siswa; ?></td>
                            </tr>
                            <tr>
                              <td>Kelas</td>
                              <td>:</td>
                              <td><?php echo $x->nama_kelas; ?></td>
                            </tr>
                            <tr>
                              <td class="table-warning">Total Tagihan</td>
                              <td class="table-warning">:</td>
                              <td class="table-warning text-bold"><?php echo "Rp. ".number_format($x->total_tagihan ,2,',','.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
              <a href="<?php echo base_url('admin/pembayaran?siswa='.$nis); ?>" type="button" class="btn btn-default"><i class="fas fa-reply"></i> Kembali</a>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="card card-success">
            <div class="card-header">
                Pembayaran Tagihan Bulanan
                <a target="__BLANK" href="<?php echo base_url('export/export_pertagihanbulanan/'.$nis.'/'.$id_tagihan); ?>" type="button" class="btn btn-secondary btn-sm" style="float:right;"><i class="fas fa-print"></i> Cetak Semua</a>
            </div>
            <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Bulan</th>
                      <th scope="col">Tagihan</th>
                      <th scope="col">Tgl Bayar</th>
                      <th scope="col">Opsi</th>
                      <th scope="col">Bayar</th>
                      <th scope="col">Cetak</th>
                      <th scope="col">Tagihan Sms</th>
                      <th scope="col">Tagihan Wa</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($data)): ?>
                    <?php foreach ($data as $x): ?>

                    <tr class="tagihan">
                        <td <?php if($x['tipe_jul']!=null): ?> style="color:green;" <?php endif; ?>>1</td>
                        <td <?php if($x['tipe_jul']!=null): ?> style="color:green;" <?php endif; ?>>July</td>
                        <td <?php if($x['tipe_jul']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_jul'] ,2,',','.'); ?></td>
                        <form id="form_jul">
                        <td><input type="date" name="tgl" class="form-control" <?php if($x['tgl_jul'] == null){ ?> value="<?php echo date('Y-m-d'); ?>" <?php }else{ ?> disabled value="<?php echo $x['tgl_jul'];  ?>" <?php } ?>></td>
                        <td <?php if($x['tipe_jul']!=null): ?> style="color:green;" <?php endif; ?>>
                          <?php if($x['tipe_jul'] != null){ ?>
                          <?php echo ucwords($x['tipe_jul']); ?>
                          <?php }else{ ?>
                          <select name="tipe_pembayaran" class="form-control" aria-label="Default select example">
                            <option value="tunai">Tunai</option>
                            <option value="transfer">Transfer</option>
                          </select>
                          <?php } ?>
                        </td>

                        <input type="hidden" name="id_tagihan" value="<?php echo $x['id_tagihan']; ?>">
                        <input type="hidden" name="total_bayar" value="<?php echo $x['tag_jul']; ?>">
                        <input type="hidden" name="bulan" value="jul">

                        <?php if($x['tipe_jul'] == null){ ?>
                        <input type="hidden" id="type_jul" value="bayar">
                        <td><button type="submit" class="btn btn-success btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_jul"></span> Bayar</b></button></td>
                        <?php }else{ ?>
                          <input type="hidden" id="type_jul" value="batal">
                          <td><button type="submit" class="btn btn-danger btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_jul"></span> Batal</b></button></td>
                        <?php } ?>                                
                      </form>
                        <td><a href="<?php echo base_url('export/export_pertransaksibulanan/'.$x['id_tagihan'].'/jul') ?>" target="__BLANK" <?php if($x['tipe_jul'] == null){ ?> class="disabled" <?php } ?>><span class="badge badge-success"><i class="fas fa-print"></i> Cetak</span></a></td>
                        <td><a href="<?php echo base_url('Admin/NotifikasiSMSBulanan?nama_pembayaran='. $nama_pembayaran.'&nama_siswa='.$nama_siswa.'&tagihan='.$x['tag_jul'].'&bulan=Juli&nohp='.$nohp) ?>" target="__BLANK"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                        <td><a target="__BLANK" href="https://api.whatsapp.com/send?phone=<?php echo $nohp; ?>&text=<?php echo "Assalamualaikum Wr.Wb, Harap Segera Menyelesaikan Pembayaran Tagihan *$nama_pembayaran* (BULANAN) Anak anda *$nama_siswa* Pada Bulan July Sebesar Rp. ".number_format($x['tag_jul'] ,2,',','.')." Terima Kasih (Keuangan SMA Jumapolo)" ?>"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                    </tr>

                    <tr class="tagihan">
                        <td <?php if($x['tipe_agu']!=null): ?> style="color:green;" <?php endif; ?>>2</td>
                        <td <?php if($x['tipe_agu']!=null): ?> style="color:green;" <?php endif; ?>>Agustus</td>
                        <td <?php if($x['tipe_agu']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_agu'] ,2,',','.'); ?></td>
                        <form id="form_agu">
                        <td><input type="date" name="tgl" class="form-control" <?php if($x['tgl_agu'] == null){ ?> value="<?php echo date('Y-m-d'); ?>" <?php }else{ ?> disabled value="<?php echo $x['tgl_agu'];  ?>" <?php } ?>></td>
                        <td <?php if($x['tipe_agu']!=null): ?> style="color:green;" <?php endif; ?>>
                          <?php if($x['tipe_agu'] != null){ ?>
                          <?php echo ucwords($x['tipe_agu']); ?>
                          <?php }else{ ?>
                          <select name="tipe_pembayaran" class="form-control" aria-label="Default select example">
                            <option value="tunai">Tunai</option>
                            <option value="transfer">Transfer</option>
                          </select>
                          <?php } ?>
                        </td>

                        <input type="hidden" name="id_tagihan" value="<?php echo $x['id_tagihan']; ?>">
                        <input type="hidden" name="total_bayar" value="<?php echo $x['tag_agu']; ?>">
                        <input type="hidden" name="bulan" value="agu">

                        <?php if($x['tipe_agu'] == null){ ?>
                          <input type="hidden" id="type_agu" value="bayar">
                        <td><button type="submit" class="btn btn-success btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_agu"></span> Bayar</b></button></td>
                        <?php }else{ ?>
                          <input type="hidden" id="type_agu" value="batal">
                          <td><button type="submit" class="btn btn-danger btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_agu"></span> Batal</b></button></td>
                        <?php } ?>                                
                      </form>
                        <td><a href="<?php echo base_url('export/export_pertransaksibulanan/'.$x['id_tagihan'].'/agu') ?>" target="__BLANK"  <?php if($x['tipe_agu'] == null){ ?> class="disabled" <?php } ?>><span class="badge badge-success"><i class="fas fa-print"></i> Cetak</span></a></td>
                        <td><a href="<?php echo base_url('Admin/NotifikasiSMSBulanan?nama_pembayaran='. $nama_pembayaran.'&nama_siswa='.$nama_siswa.'&tagihan='.$x['tag_agu'].'&bulan=Agustus&nohp='.$nohp) ?>" target="__BLANK"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                        <td><a target="__BLANK" href="https://api.whatsapp.com/send?phone=<?php echo $nohp; ?>&text=<?php echo "Assalamualaikum Wr.Wb, Harap Segera Menyelesaikan Pembayaran Tagihan *$nama_pembayaran* (BULANAN) Anak anda *$nama_siswa* Pada Bulan Agustus Sebesar Rp. ".number_format($x['tag_agu'] ,2,',','.')." Terima Kasih (Keuangan SMA Jumapolo)" ?>"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                    </tr>

                    <tr class="tagihan">
                        <td <?php if($x['tipe_sep']!=null): ?> style="color:green;" <?php endif; ?>>3</td>
                        <td <?php if($x['tipe_sep']!=null): ?> style="color:green;" <?php endif; ?>>September</td>
                        <td <?php if($x['tipe_sep']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_sep'] ,2,',','.'); ?></td>
                        <form id="form_sep">
                        <td><input type="date" name="tgl" class="form-control" <?php if($x['tgl_sep'] == null){ ?> value="<?php echo date('Y-m-d'); ?>" <?php }else{ ?> disabled value="<?php echo $x['tgl_sep'];  ?>" <?php } ?>></td>
                        <td <?php if($x['tipe_sep']!=null): ?> style="color:green;" <?php endif; ?>>
                          <?php if($x['tipe_sep'] != null){ ?>
                          <?php echo ucwords($x['tipe_sep']); ?>
                          <?php }else{ ?>
                          <select name="tipe_pembayaran" class="form-control" aria-label="Default select example">
                            <option value="tunai">Tunai</option>
                            <option value="transfer">Transfer</option>
                          </select>
                          <?php } ?>
                        </td>

                        <input type="hidden" name="id_tagihan" value="<?php echo $x['id_tagihan']; ?>">
                        <input type="hidden" name="total_bayar" value="<?php echo $x['tag_sep']; ?>">
                        <input type="hidden" name="bulan" value="sep">

                        <?php if($x['tipe_sep'] == null){ ?>
                          <input type="hidden" id="type_sep" value="bayar">
                        <td><button type="submit" class="btn btn-success btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_sep"></span> Bayar</b></button></td>
                        <?php }else{ ?>
                          <input type="hidden" id="type_sep" value="batal">
                          <td><button type="submit" class="btn btn-danger btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_sep"></span> Batal</b></button></td>
                        <?php } ?>                                
                      </form>
                        <td><a href="<?php echo base_url('export/export_pertransaksibulanan/'.$x['id_tagihan'].'/sep') ?>" target="__BLANK"  <?php if($x['tipe_sep'] == null){ ?> class="disabled" <?php } ?>><span class="badge badge-success"><i class="fas fa-print"></i> Cetak</span></a></td>
                        <td><a href="<?php echo base_url('Admin/NotifikasiSMSBulanan?nama_pembayaran='. $nama_pembayaran.'&nama_siswa='.$nama_siswa.'&tagihan='.$x['tag_sep'].'&bulan=September&nohp='.$nohp) ?>" target="__BLANK"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                        <td><a target="__BLANK" href="https://api.whatsapp.com/send?phone=<?php echo $nohp; ?>&text=<?php echo "Assalamualaikum Wr.Wb, Harap Segera Menyelesaikan Pembayaran Tagihan *$nama_pembayaran* (BULANAN) Anak anda *$nama_siswa* Pada Bulan September Sebesar Rp. ".number_format($x['tag_sep'] ,2,',','.')." Terima Kasih (Keuangan SMA Jumapolo)" ?>"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                    </tr>

                    <tr class="tagihan">
                        <td <?php if($x['tipe_okt']!=null): ?> style="color:green;" <?php endif; ?>>4</td>
                        <td <?php if($x['tipe_okt']!=null): ?> style="color:green;" <?php endif; ?>>Oktober</td>
                        <td <?php if($x['tipe_okt']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_okt'] ,2,',','.'); ?></td>
                        <form id="form_okt">
                        <td><input type="date" name="tgl" class="form-control" <?php if($x['tgl_okt'] == null){ ?> value="<?php echo date('Y-m-d'); ?>" <?php }else{ ?> disabled value="<?php echo $x['tgl_okt'];  ?>" <?php } ?>></td>
                        <td <?php if($x['tipe_okt']!=null): ?> style="color:green;" <?php endif; ?>>
                          <?php if($x['tipe_okt'] != null){ ?>
                          <?php echo ucwords($x['tipe_okt']); ?>
                          <?php }else{ ?>
                          <select name="tipe_pembayaran" class="form-control" aria-label="Default select example">
                            <option value="tunai">Tunai</option>
                            <option value="transfer">Transfer</option>
                          </select>
                          <?php } ?>
                        </td>

                        <input type="hidden" name="id_tagihan" value="<?php echo $x['id_tagihan']; ?>">
                        <input type="hidden" name="total_bayar" value="<?php echo $x['tag_okt']; ?>">
                        <input type="hidden" name="bulan" value="okt">

                        <?php if($x['tipe_okt'] == null){ ?>
                        <input type="hidden" id="type_okt" value="bayar">
                        <td><button type="submit" class="btn btn-success btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_okt"></span> Bayar</b></button></td>
                        <?php }else{ ?>
                        <input type="hidden" id="type_okt" value="batal">
                        <td><button type="submit" class="btn btn-danger btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_okt"></span> Batal</b></button></td>
                        <?php } ?>                                
                      </form>
                        <td><a href="<?php echo base_url('export/export_pertransaksibulanan/'.$x['id_tagihan'].'/okt') ?>" target="__BLANK"  <?php if($x['tipe_okt'] == null){ ?> class="disabled" <?php } ?>><span class="badge badge-success"><i class="fas fa-print"></i> Cetak</span></a></td>
                        <td><a href="<?php echo base_url('Admin/NotifikasiSMSBulanan?nama_pembayaran='. $nama_pembayaran.'&nama_siswa='.$nama_siswa.'&tagihan='.$x['tag_okt'].'&bulan=Oktober&nohp='.$nohp) ?>" target="__BLANK"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                        <td><a target="__BLANK" href="https://api.whatsapp.com/send?phone=<?php echo $nohp; ?>&text=<?php echo "Assalamualaikum Wr.Wb, Harap Segera Menyelesaikan Pembayaran Tagihan *$nama_pembayaran* (BULANAN) Anak anda *$nama_siswa* Pada Bulan Oktober Sebesar Rp. ".number_format($x['tag_okt'] ,2,',','.')." Terima Kasih (Keuangan SMA Jumapolo)" ?>"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                    </tr>

                    <tr class="tagihan">
                        <td <?php if($x['tipe_nov']!=null): ?> style="color:green;" <?php endif; ?>>5</td>
                        <td <?php if($x['tipe_nov']!=null): ?> style="color:green;" <?php endif; ?>>November</td>
                        <td <?php if($x['tipe_nov']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_nov'] ,2,',','.'); ?></td>
                        <form id="form_nov">
                        <td><input type="date" name="tgl" class="form-control" <?php if($x['tgl_nov'] == null){ ?> value="<?php echo date('Y-m-d'); ?>" <?php }else{ ?> disabled value="<?php echo $x['tgl_nov'];  ?>" <?php } ?>></td>
                        <td <?php if($x['tipe_nov']!=null): ?> style="color:green;" <?php endif; ?>>
                          <?php if($x['tipe_nov'] != null){ ?>
                          <?php echo ucwords($x['tipe_nov']); ?>
                          <?php }else{ ?>
                          <select name="tipe_pembayaran" class="form-control" aria-label="Default select example">
                            <option value="tunai">Tunai</option>
                            <option value="transfer">Transfer</option>
                          </select>
                          <?php } ?>
                        </td>

                        <input type="hidden" name="id_tagihan" value="<?php echo $x['id_tagihan']; ?>">
                        <input type="hidden" name="total_bayar" value="<?php echo $x['tag_nov']; ?>">
                        <input type="hidden" name="bulan" value="nov">

                        <?php if($x['tipe_nov'] == null){ ?>
                        <input type="hidden" id="type_nov" value="bayar">
                        <td><button type="submit" class="btn btn-success btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_nov"></span> Bayar</b></button></td>
                        <?php }else{ ?>
                        <input type="hidden" id="type_nov" value="batal">
                        <td><button type="submit" class="btn btn-danger btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_nov"></span> Batal</b></button></td>
                        <?php } ?>                                
                      </form>
                        <td><a href="<?php echo base_url('export/export_pertransaksibulanan/'.$x['id_tagihan'].'/nov') ?>" target="__BLANK"  <?php if($x['tipe_nov'] == null){ ?> class="disabled" <?php } ?>><span class="badge badge-success"><i class="fas fa-print"></i> Cetak</span></a></td>
                        <td><a href="<?php echo base_url('Admin/NotifikasiSMSBulanan?nama_pembayaran='. $nama_pembayaran.'&nama_siswa='.$nama_siswa.'&tagihan='.$x['tag_nov'].'&bulan=November&nohp='.$nohp) ?>" target="__BLANK"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                        <td><a target="__BLANK" href="https://api.whatsapp.com/send?phone=<?php echo $nohp; ?>&text=<?php echo "Assalamualaikum Wr.Wb, Harap Segera Menyelesaikan Pembayaran Tagihan *$nama_pembayaran* (BULANAN) Anak anda *$nama_siswa* Pada Bulan November Sebesar Rp. ".number_format($x['tag_nov'] ,2,',','.')." Terima Kasih (Keuangan SMA Jumapolo)" ?>"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                    </tr>

                    <tr class="tagihan">
                        <td <?php if($x['tipe_des']!=null): ?> style="color:green;" <?php endif; ?>>6</td>
                        <td <?php if($x['tipe_des']!=null): ?> style="color:green;" <?php endif; ?>>Desember</td>
                        <td <?php if($x['tipe_des']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_des'] ,2,',','.'); ?></td>
                        <form id="form_des">
                        <td><input type="date" name="tgl" class="form-control" <?php if($x['tgl_des'] == null){ ?> value="<?php echo date('Y-m-d'); ?>" <?php }else{ ?> disabled value="<?php echo $x['tgl_des'];  ?>" <?php } ?>></td>
                        <td <?php if($x['tipe_des']!=null): ?> style="color:green;" <?php endif; ?>>
                          <?php if($x['tipe_des'] != null){ ?>
                          <?php echo ucwords($x['tipe_des']); ?>
                          <?php }else{ ?>
                          <select name="tipe_pembayaran" class="form-control" aria-label="Default select example">
                            <option value="tunai">Tunai</option>
                            <option value="transfer">Transfer</option>
                          </select>
                          <?php } ?>
                        </td>

                        <input type="hidden" name="id_tagihan" value="<?php echo $x['id_tagihan']; ?>">
                        <input type="hidden" name="total_bayar" value="<?php echo $x['tag_des']; ?>">
                        <input type="hidden" name="bulan" value="des">

                        <?php if($x['tipe_des'] == null){ ?>
                        <input type="hidden" id="type_des" value="bayar">
                        <td><button type="submit" class="btn btn-success btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_des"></span> Bayar</b></button></td>
                        <?php }else{ ?>
                        <input type="hidden" id="type_des" value="batal">
                        <td><button type="submit" class="btn btn-danger btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_des"></span> Batal</b></button></td>
                        <?php } ?>                                
                      </form>
                        <td><a href="<?php echo base_url('export/export_pertransaksibulanan/'.$x['id_tagihan'].'/des') ?>" target="__BLANK"  <?php if($x['tipe_des'] == null){ ?> class="disabled" <?php } ?>><span class="badge badge-success"><i class="fas fa-print"></i> Cetak</span></a></td>
                        <td><a href="<?php echo base_url('Admin/NotifikasiSMSBulanan?nama_pembayaran='. $nama_pembayaran.'&nama_siswa='.$nama_siswa.'&tagihan='.$x['tag_des'].'&bulan=Desember&nohp='.$nohp) ?>" target="__BLANK"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                        <td><a target="__BLANK" href="https://api.whatsapp.com/send?phone=<?php echo $nohp; ?>&text=<?php echo "Assalamualaikum Wr.Wb, Harap Segera Menyelesaikan Pembayaran Tagihan *$nama_pembayaran* (BULANAN) Anak anda *$nama_siswa* Pada Bulan Desember Sebesar Rp. ".number_format($x['tag_des'] ,2,',','.')." Terima Kasih (Keuangan SMA Jumapolo)" ?>"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                    </tr>

                    <tr class="tagihan">
                        <td <?php if($x['tipe_jan']!=null): ?> style="color:green;" <?php endif; ?>>7</td>
                        <td <?php if($x['tipe_jan']!=null): ?> style="color:green;" <?php endif; ?>>Januari</td>
                        <td <?php if($x['tipe_jan']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_jan'] ,2,',','.'); ?></td>
                        
                        <form id="form_jan">
                        <td><input type="date" name="tgl" id="" class="form-control" <?php if($x['tgl_jan'] == null){ ?> value="<?php echo date('Y-m-d'); ?>" <?php }else{ ?> disabled value="<?php echo $x['tgl_jan'];  ?>" <?php } ?>></td>
                        <td <?php if($x['tipe_jan']!=null): ?> style="color:green;" <?php endif; ?>>
                          <?php if($x['tipe_jan'] != null){ ?>
                          <?php echo ucwords($x['tipe_jan']); ?>
                          <?php }else{ ?>
                          <select name="tipe_pembayaran" class="form-control" aria-label="Default select example">
                            <option value="tunai">Tunai</option>
                            <option value="transfer">Transfer</option>
                          </select>
                          <?php } ?>
                        </td>

                        <input type="hidden" name="id_tagihan" value="<?php echo $x['id_tagihan']; ?>">
                        <input type="hidden" name="total_bayar" value="<?php echo $x['tag_jan']; ?>">
                        <input type="hidden" name="bulan" value="jan">

                        <?php if($x['tipe_jan'] == null){ ?>
                          <input type="hidden" id="type" value="bayar">
                        <td><button type="submit" class="btn btn-success btn-xs"><b> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Bayar</b></button></td>
                        <?php }else{ ?>
                          <input type="hidden" id="type" value="batal">
                          <td><button type="submit" class="btn btn-danger btn-xs"><b> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Batal</b></button></td>
                        <?php } ?>
                        </form>

                        <td><a href="<?php echo base_url('export/export_pertransaksibulanan/'.$x['id_tagihan'].'/jan') ?>" target="__BLANK" <?php if($x['tipe_jan'] == null){ ?> class="disabled" <?php } ?>><span class="badge badge-success"><i class="fas fa-print"></i> Cetak</span></a></td>
                        <td><a href="<?php echo base_url('Admin/NotifikasiSMSBulanan?nama_pembayaran='. $nama_pembayaran.'&nama_siswa='.$nama_siswa.'&tagihan='.$x['tag_jan'].'&bulan=Januari&nohp='.$nohp) ?>" target="__BLANK"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                        <td><a target="__BLANK" href="https://api.whatsapp.com/send?phone=<?php echo $nohp; ?>&text=<?php echo "Assalamualaikum Wr.Wb, Harap Segera Menyelesaikan Pembayaran Tagihan *$nama_pembayaran* (BULANAN) Anak anda *$nama_siswa* Pada Bulan Januari Sebesar Rp. ".number_format($x['tag_jan'] ,2,',','.')." Terima Kasih (Keuangan SMA Jumapolo)" ?>"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                    </tr>

                    <tr class="tagihan">
                        <td <?php if($x['tipe_feb']!=null): ?> style="color:green;" <?php endif; ?>>8</td>
                        <td <?php if($x['tipe_feb']!=null): ?> style="color:green;" <?php endif; ?>>Februari</td>
                        <td <?php if($x['tipe_feb']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_feb'] ,2,',','.'); ?></td>
                        <form id="form_feb">
                        <td><input type="date" name="tgl" class="form-control" <?php if($x['tgl_feb'] == null){ ?> value="<?php echo date('Y-m-d'); ?>" <?php }else{ ?> disabled value="<?php echo $x['tgl_feb'];  ?>" <?php } ?>></td>
                        <td <?php if($x['tipe_feb']!=null): ?> style="color:green;" <?php endif; ?>>
                          <?php if($x['tipe_feb'] != null){ ?>
                          <?php echo ucwords($x['tipe_feb']); ?>
                          <?php }else{ ?>
                          <select name="tipe_pembayaran" class="form-control" aria-label="Default select example">
                            <option value="tunai">Tunai</option>
                            <option value="transfer">Transfer</option>
                          </select>
                          <?php } ?>
                        </td>

                        <input type="hidden" name="id_tagihan" value="<?php echo $x['id_tagihan']; ?>">
                        <input type="hidden" name="total_bayar" value="<?php echo $x['tag_feb']; ?>">
                        <input type="hidden" name="bulan" value="feb">

                        <?php if($x['tipe_feb'] == null){ ?>
                        <input type="hidden" id="type_feb" value="bayar">
                        <td><button type="submit" class="btn btn-success btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_feb"></span> Bayar</b></button></td>
                        <?php }else{ ?>
                        <input type="hidden" id="type_feb" value="batal">
                        <td><button type="submit" class="btn btn-danger btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_feb"></span> Batal</b></button></td>
                        <?php } ?>                                
                      </form>
                      <td><a href="<?php echo base_url('export/export_pertransaksibulanan/'.$x['id_tagihan'].'/feb') ?>" target="__BLANK" <?php if($x['tipe_feb'] == null){ ?> class="disabled" <?php } ?>><span class="badge badge-success"><i class="fas fa-print"></i> Cetak</span></a></td>
                      <td><a href="<?php echo base_url('Admin/NotifikasiSMSBulanan?nama_pembayaran='. $nama_pembayaran.'&nama_siswa='.$nama_siswa.'&tagihan='.$x['tag_feb'].'&bulan=Februari&nohp='.$nohp) ?>" target="__BLANK"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                        <td><a target="__BLANK" href="https://api.whatsapp.com/send?phone=<?php echo $nohp; ?>&text=<?php echo "Assalamualaikum Wr.Wb, Harap Segera Menyelesaikan Pembayaran Tagihan *$nama_pembayaran* (BULANAN) Anak anda *$nama_siswa* Pada Bulan Februari Sebesar Rp. ".number_format($x['tag_feb'] ,2,',','.')." Terima Kasih (Keuangan SMA Jumapolo)" ?>"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                    </tr>

                    <tr class="tagihan">
                        <td <?php if($x['tipe_mar']!=null): ?> style="color:green;" <?php endif; ?>>9</td>
                        <td <?php if($x['tipe_mar']!=null): ?> style="color:green;" <?php endif; ?>>Maret</td>
                        <td <?php if($x['tipe_mar']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_mar'] ,2,',','.'); ?></td>
                        <form id="form_mar">
                        <td><input type="date" name="tgl" class="form-control" <?php if($x['tgl_mar'] == null){ ?> value="<?php echo date('Y-m-d'); ?>" <?php }else{ ?> disabled value="<?php echo $x['tgl_mar'];  ?>" <?php } ?>></td>
                        <td <?php if($x['tipe_mar']!=null): ?> style="color:green;" <?php endif; ?>>
                          <?php if($x['tipe_mar'] != null){ ?>
                          <?php echo ucwords($x['tipe_mar']); ?>
                          <?php }else{ ?>
                          <select name="tipe_pembayaran" class="form-control" aria-label="Default select example">
                            <option value="tunai">Tunai</option>
                            <option value="transfer">Transfer</option>
                          </select>
                          <?php } ?>
                        </td>

                        <input type="hidden" name="id_tagihan" value="<?php echo $x['id_tagihan']; ?>">
                        <input type="hidden" name="total_bayar" value="<?php echo $x['tag_mar']; ?>">
                        <input type="hidden" name="bulan" value="mar">

                        <?php if($x['tipe_mar'] == null){ ?>
                        <input type="hidden" id="type_mar" value="bayar">
                        <td><button type="submit" class="btn btn-success btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_mar"></span> Bayar</b></button></td>
                        <?php }else{ ?>
                        <input type="hidden" id="type_mar" value="batal">
                          <td><button type="submit" class="btn btn-danger btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_mar"></span> Batal</b></button></td>
                        <?php } ?>                                
                      </form>
                      <td><a href="<?php echo base_url('export/export_pertransaksibulanan/'.$x['id_tagihan'].'/mar') ?>" target="__BLANK"  <?php if($x['tipe_mar'] == null){ ?> class="disabled" <?php } ?>><span class="badge badge-success"><i class="fas fa-print"></i> Cetak</span></a></td>
                      <td><a href="<?php echo base_url('Admin/NotifikasiSMSBulanan?nama_pembayaran='. $nama_pembayaran.'&nama_siswa='.$nama_siswa.'&tagihan='.$x['tag_mar'].'&bulan=Maret&nohp='.$nohp) ?>" target="__BLANK"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                        <td><a target="__BLANK" href="https://api.whatsapp.com/send?phone=<?php echo $nohp; ?>&text=<?php echo "Assalamualaikum Wr.Wb, Harap Segera Menyelesaikan Pembayaran Tagihan *$nama_pembayaran* (BULANAN) Anak anda *$nama_siswa* Pada Bulan Maret Sebesar Rp. ".number_format($x['tag_mar'] ,2,',','.')." Terima Kasih (Keuangan SMA Jumapolo)" ?>"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                    </tr>

                    <tr class="tagihan">
                        <td <?php if($x['tipe_apr']!=null): ?> style="color:green;" <?php endif; ?>>10</td>
                        <td <?php if($x['tipe_apr']!=null): ?> style="color:green;" <?php endif; ?>>April</td>
                        <td <?php if($x['tipe_apr']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_apr'] ,2,',','.'); ?></td>
                        <form id="form_apr">
                        <td><input type="date" name="tgl" class="form-control" <?php if($x['tgl_apr'] == null){ ?> value="<?php echo date('Y-m-d'); ?>" <?php }else{ ?> disabled value="<?php echo $x['tgl_apr'];  ?>" <?php } ?>></td>
                        <td <?php if($x['tipe_apr']!=null): ?> style="color:green;" <?php endif; ?>>
                          <?php if($x['tipe_apr'] != null){ ?>
                          <?php echo ucwords($x['tipe_apr']); ?>
                          <?php }else{ ?>
                          <select name="tipe_pembayaran" class="form-control" aria-label="Default select example">
                            <option value="tunai">Tunai</option>
                            <option value="transfer">Transfer</option>
                          </select>
                          <?php } ?>
                        </td>

                        <input type="hidden" name="id_tagihan" value="<?php echo $x['id_tagihan']; ?>">
                        <input type="hidden" name="total_bayar" value="<?php echo $x['tag_apr']; ?>">
                        <input type="hidden" name="bulan" value="apr">

                        <?php if($x['tipe_apr'] == null){ ?>
                        <input type="hidden" id="type_apr" value="bayar">
                        <td><button type="submit" class="btn btn-success btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_apr"></span> Bayar</b></button></td>
                        <?php }else{ ?>
                        <input type="hidden" id="type_apr" value="batal">
                        <td><button type="submit" class="btn btn-danger btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_apr"></span> Batal</b></button></td>
                        <?php } ?>                                
                      </form>
                      <td><a href="<?php echo base_url('export/export_pertransaksibulanan/'.$x['id_tagihan'].'/apr') ?>" target="__BLANK" <?php if($x['tipe_apr'] == null){ ?> class="disabled" <?php } ?>><span class="badge badge-success"><i class="fas fa-print"></i> Cetak</span></a></td>
                      <td><a href="<?php echo base_url('Admin/NotifikasiSMSBulanan?nama_pembayaran='. $nama_pembayaran.'&nama_siswa='.$nama_siswa.'&tagihan='.$x['tag_apr'].'&bulan=April&nohp='.$nohp) ?>" target="__BLANK"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                        <td><a target="__BLANK" href="https://api.whatsapp.com/send?phone=<?php echo $nohp; ?>&text=<?php echo "Assalamualaikum Wr.Wb, Harap Segera Menyelesaikan Pembayaran Tagihan *$nama_pembayaran* (BULANAN) Anak anda *$nama_siswa* Pada Bulan April Sebesar Rp. ".number_format($x['tag_apr'] ,2,',','.')." Terima Kasih (Keuangan SMA Jumapolo)" ?>"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                    </tr>

                    <tr class="tagihan">
                        <td <?php if($x['tipe_mei']!=null): ?> style="color:green;" <?php endif; ?>>11</td>
                        <td <?php if($x['tipe_mei']!=null): ?> style="color:green;" <?php endif; ?>>Mei</td>
                        <td <?php if($x['tipe_mei']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_mei'] ,2,',','.'); ?></td>
                        <form id="form_mei">
                        <td><input type="date" name="tgl" class="form-control" <?php if($x['tgl_mei'] == null){ ?> value="<?php echo date('Y-m-d'); ?>" <?php }else{ ?> disabled value="<?php echo $x['tgl_mei'];  ?>" <?php } ?>></td>
                        <td <?php if($x['tipe_mei']!=null): ?> style="color:green;" <?php endif; ?>>
                          <?php if($x['tipe_mei'] != null){ ?>
                          <?php echo ucwords($x['tipe_mei']); ?>
                          <?php }else{ ?>
                          <select name="tipe_pembayaran" class="form-control" aria-label="Default select example">
                            <option value="tunai">Tunai</option>
                            <option value="transfer">Transfer</option>
                          </select>
                          <?php } ?>
                        </td>

                        <input type="hidden" name="id_tagihan" value="<?php echo $x['id_tagihan']; ?>">
                        <input type="hidden" name="total_bayar" value="<?php echo $x['tag_mei']; ?>">
                        <input type="hidden" name="bulan" value="mei">

                        <?php if($x['tipe_mei'] == null){ ?>
                        <input type="hidden" id="type_mei" value="bayar">
                        <td><button type="submit" class="btn btn-success btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_mei"></span> Bayar</b></button></td>
                        <?php }else{ ?>
                        <input type="hidden" id="type_mei" value="batal">
                        <td><button type="submit" class="btn btn-danger btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_mei"></span> Batal</b></button></td>
                        <?php } ?>                                
                      </form>
                      <td><a href="<?php echo base_url('export/export_pertransaksibulanan/'.$x['id_tagihan'].'/mei') ?>" target="__BLANK"  <?php if($x['tipe_mei'] == null){ ?> class="disabled" <?php } ?>><span class="badge badge-success"><i class="fas fa-print"></i> Cetak</span></a></td>
                      <td><a href="<?php echo base_url('Admin/NotifikasiSMSBulanan?nama_pembayaran='. $nama_pembayaran.'&nama_siswa='.$nama_siswa.'&tagihan='.$x['tag_mei'].'&bulan=Mei&nohp='.$nohp) ?>" target="__BLANK"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                        <td><a target="__BLANK" href="https://api.whatsapp.com/send?phone=<?php echo $nohp; ?>&text=<?php echo "Assalamualaikum Wr.Wb, Harap Segera Menyelesaikan Pembayaran Tagihan *$nama_pembayaran* (BULANAN) Anak anda *$nama_siswa* Pada Bulan Mei Sebesar Rp. ".number_format($x['tag_mei'] ,2,',','.')." Terima Kasih (Keuangan SMA Jumapolo)" ?>"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                    </tr>

                    <tr class="tagihan">
                        <td <?php if($x['tipe_jun']!=null): ?> style="color:green;" <?php endif; ?>>12</td>
                        <td <?php if($x['tipe_jun']!=null): ?> style="color:green;" <?php endif; ?>>Juni</td>
                        <td <?php if($x['tipe_jun']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_jun'] ,2,',','.'); ?></td>
                        <form id="form_jun">
                        <td><input type="date" name="tgl" class="form-control" <?php if($x['tgl_jun'] == null){ ?> value="<?php echo date('Y-m-d'); ?>" <?php }else{ ?> disabled value="<?php echo $x['tgl_jun'];  ?>" <?php } ?>></td>
                        <td <?php if($x['tipe_jun']!=null): ?> style="color:green;" <?php endif; ?>>
                          <?php if($x['tipe_jun'] != null){ ?>
                          <?php echo ucwords($x['tipe_jun']); ?>
                          <?php }else{ ?>
                          <select name="tipe_pembayaran" class="form-control" aria-label="Default select example">
                            <option value="tunai">Tunai</option>
                            <option value="transfer">Transfer</option>
                          </select>
                          <?php } ?>

                        <input type="hidden" name="id_tagihan" value="<?php echo $x['id_tagihan']; ?>">
                        <input type="hidden" name="total_bayar" value="<?php echo $x['tag_jun']; ?>">
                        <input type="hidden" name="bulan" value="jun">

                        </td>
                        <?php if($x['tipe_jun'] == null){ ?>
                        <input type="hidden" id="type_jun" value="bayar">
                        <td><button type="submit" class="btn btn-success btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_jun"></span> Bayar</b></button></td>
                        <?php }else{ ?>
                          <input type="hidden" id="type_jun" value="batal">
                          <td><button type="submit" class="btn btn-danger btn-xs"><b><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_jun"></span> Batal</b></button></td>
                        <?php } ?>                                
                      </form>
                        <td><a href="<?php echo base_url('export/export_pertransaksibulanan/'.$x['id_tagihan'].'/jun') ?>" target="__BLANK"  <?php if($x['tipe_jun'] == null){ ?> class="disabled" <?php } ?>><span class="badge badge-success"><i class="fas fa-print"></i> Cetak</span></a></td>
                        <td><a href="<?php echo base_url('Admin/NotifikasiSMSBulanan?nama_pembayaran='. $nama_pembayaran.'&nama_siswa='.$nama_siswa.'&tagihan='.$x['tag_jun'].'&bulan=Juni&nohp='.$nohp) ?>" target="__BLANK"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                        <td><a target="__BLANK" href="https://api.whatsapp.com/send?phone=<?php echo $nohp; ?>&text=<?php echo "Assalamualaikum Wr.Wb, Harap Segera Menyelesaikan Pembayaran Tagihan *$nama_pembayaran* (BULANAN) Anak anda *$nama_siswa* Pada Bulan Juni Sebesar Rp. ".number_format($x['tag_jun'] ,2,',','.')." Terima Kasih (Keuangan SMA Jumapolo)" ?>"><span class="badge badge-info"><i class="fas fa-comment-dots"></i> Kirim</span></a></td>
                    </tr>

                    <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
            </div>
        </div>
      </div>
    </section>
  </div>

  <script>
    $(document).ready(function(){
        $('#spinner').hide();
        $('#spinner_feb').hide();
        $('#spinner_mar').hide();
        $('#spinner_apr').hide();
        $('#spinner_mei').hide();
        $('#spinner_jun').hide();
        $('#spinner_jul').hide();
        $('#spinner_agu').hide();
        $('#spinner_sep').hide();
        $('#spinner_okt').hide();
        $('#spinner_nov').hide();
        $('#spinner_des').hide();


        $('#form_jan').submit(function(e){
            e.preventDefault();

            if($('#type').val() == "bayar"){

              $.ajax({
                  url : '<?php echo base_url('Admin/bayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner').show();
                  },
                  complete : function(){
                    $('#spinner').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }else{

              $.ajax({
                  url : '<?php echo base_url('Admin/batalbayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner').show();
                  },
                  complete : function(){
                    $('#spinner').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }
        });

        $('#form_feb').submit(function(e){
            e.preventDefault();

            if($('#type_feb').val() == "bayar"){

              $.ajax({
                  url : '<?php echo base_url('Admin/bayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_feb').show();
                  },
                  complete : function(){
                    $('#spinner_feb').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }else{

              $.ajax({
                  url : '<?php echo base_url('Admin/batalbayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_feb').show();
                  },
                  complete : function(){
                    $('#spinner_feb').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }
        });

        $('#form_mar').submit(function(e){
            e.preventDefault();

            if($('#type_mar').val() == "bayar"){

              $.ajax({
                  url : '<?php echo base_url('Admin/bayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_mar').show();
                  },
                  complete : function(){
                    $('#spinner_mar').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }else{

              $.ajax({
                  url : '<?php echo base_url('Admin/batalbayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_mar').show();
                  },
                  complete : function(){
                    $('#spinner_mar').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }
        });

        $('#form_apr').submit(function(e){
            e.preventDefault();

            if($('#type_apr').val() == "bayar"){

              $.ajax({
                  url : '<?php echo base_url('Admin/bayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_apr').show();
                  },
                  complete : function(){
                    $('#spinner_apr').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }else{

              $.ajax({
                  url : '<?php echo base_url('Admin/batalbayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_apr').show();
                  },
                  complete : function(){
                    $('#spinner_apr').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }
        });

        $('#form_mei').submit(function(e){
            e.preventDefault();

            if($('#type_mei').val() == "bayar"){

              $.ajax({
                  url : '<?php echo base_url('Admin/bayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_mei').show();
                  },
                  complete : function(){
                    $('#spinner_mei').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }else{

              $.ajax({
                  url : '<?php echo base_url('Admin/batalbayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_mei').show();
                  },
                  complete : function(){
                    $('#spinner_mei').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }
        });

        $('#form_jun').submit(function(e){
            e.preventDefault();

            if($('#type_jun').val() == "bayar"){

              $.ajax({
                  url : '<?php echo base_url('Admin/bayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_jun').show();
                  },
                  complete : function(){
                    $('#spinner_jun').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }else{

              $.ajax({
                  url : '<?php echo base_url('Admin/batalbayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_jun').show();
                  },
                  complete : function(){
                    $('#spinner_jun').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }
        });


        $('#form_jul').submit(function(e){
            e.preventDefault();

            if($('#type_jul').val() == "bayar"){

              $.ajax({
                  url : '<?php echo base_url('Admin/bayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_jul').show();
                  },
                  complete : function(){
                    $('#spinner_jul').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }else{

              $.ajax({
                  url : '<?php echo base_url('Admin/batalbayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_jul').show();
                  },
                  complete : function(){
                    $('#spinner_jul').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }
        });

        $('#form_agu').submit(function(e){
            e.preventDefault();

            if($('#type_agu').val() == "bayar"){

              $.ajax({
                  url : '<?php echo base_url('Admin/bayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_agu').show();
                  },
                  complete : function(){
                    $('#spinner_agu').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }else{

              $.ajax({
                  url : '<?php echo base_url('Admin/batalbayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_agu').show();
                  },
                  complete : function(){
                    $('#spinner_agu').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }
        });

        $('#form_sep').submit(function(e){
            e.preventDefault();

            if($('#type_sep').val() == "bayar"){

              $.ajax({
                  url : '<?php echo base_url('Admin/bayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_sep').show();
                  },
                  complete : function(){
                    $('#spinner_sep').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }else{

              $.ajax({
                  url : '<?php echo base_url('Admin/batalbayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_sep').show();
                  },
                  complete : function(){
                    $('#spinner_sep').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }
        });

        
        $('#form_okt').submit(function(e){
            e.preventDefault();

            if($('#type_okt').val() == "bayar"){

              $.ajax({
                  url : '<?php echo base_url('Admin/bayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_okt').show();
                  },
                  complete : function(){
                    $('#spinner_okt').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }else{

              $.ajax({
                  url : '<?php echo base_url('Admin/batalbayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_okt').show();
                  },
                  complete : function(){
                    $('#spinner_okt').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }
        });

        $('#form_nov').submit(function(e){
            e.preventDefault();

            if($('#type_nov').val() == "bayar"){

              $.ajax({
                  url : '<?php echo base_url('Admin/bayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_nov').show();
                  },
                  complete : function(){
                    $('#spinner_nov').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }else{

              $.ajax({
                  url : '<?php echo base_url('Admin/batalbayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_nov').show();
                  },
                  complete : function(){
                    $('#spinner_nov').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }
        });

        $('#form_des').submit(function(e){
            e.preventDefault();

            if($('#type_des').val() == "bayar"){

              $.ajax({
                  url : '<?php echo base_url('Admin/bayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_des').show();
                  },
                  complete : function(){
                    $('#spinner_des').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }else{

              $.ajax({
                  url : '<?php echo base_url('Admin/batalbayartagihanbulanan'); ?>',
                  type : 'POST',
                  data : $(this).serialize(),
                  beforeSend : function(){
                    $('#spinner_des').show();
                  },
                  complete : function(){
                    $('#spinner_des').hide()
                  },
                  success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                  }
              });

            }
        });

    });
  </script>
<?= $this->endSection('content'); ?>