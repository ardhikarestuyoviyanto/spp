<?= $this->extend('siswa/portal'); ?>
<?= $this->section('content'); ?>
<?php $modelsadmin = new App\Models\ModelAdmin(); ?>
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
                <li class="breadcrumb-item"><a href="<?php echo base_url('siswa/tagihan') ?>">Tagihan</a></li>
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
              <a href="<?php echo base_url('siswa/tagihan'); ?>" type="button" class="btn btn-default"><i class="fas fa-reply"></i> Kembali</a>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="card card-success">
            <div class="card-header">
                Pembayaran Tagihan Bulanan
            </div>
            <form action="#" method="post" id="bayar_bulanan">
                <div class="card-body">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">#</th>
                        <th scope="col">Bulan</th>
                        <th scope="col">Tagihan</th>
                        <th scope="col">Tgl Bayar</th>
                        <th scope="col">Opsi Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($data)): ?>
                        <?php foreach ($data as $x): ?>

                        <input type="hidden" name="id_tagihan" value="<?= $x['id_tagihan']; ?>">

                        <tr class="tagihan">
                            <td <?php if($x['tipe_jul']!=null): ?> style="color:green;" <?php endif; ?>>1</td>
                            <td><input name="bulanan[]" <?php if($modelsadmin->getTotalDibayarPerBulan($x['id_tagihan'], 'jul', $x['tag_jul']) == $x['tag_jul']): ?> disabled <?php endif; ?> class="child_bulanan" type="checkbox" value="<?php echo $x['tag_jul'].'|juli'; ?>"></td>
                            <td <?php if($x['tipe_jul']!=null): ?> style="color:green;" <?php endif; ?>>July</td>
                            <td <?php if($x['tipe_jul']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_jul'] ,2,',','.'); ?></td>
                            <td><?php if($x['tgl_jul'] != null){ ?> <input type="date" name="tgl" class="form-control" disabled value="<?php echo $x['tgl_jul'];  ?>"> <?php }else{ ?> - <?php } ?></td>
                            <td <?php if($x['tipe_jul']!=null): ?> style="color:green;" <?php endif; ?>>
                            <?php if($x['tipe_jul'] != null){ ?>
                            <?php echo ucwords($x['tipe_jul']); ?>
                            <?php }else{ ?>
                            -
                            <?php } ?>
                            </td>                             
                        </tr>

                        <tr class="tagihan">
                            <td <?php if($x['tipe_agu']!=null): ?> style="color:green;" <?php endif; ?>>2</td>
                            <td><input name="bulanan[]" <?php if($modelsadmin->getTotalDibayarPerBulan($x['id_tagihan'], 'agu', $x['tag_agu']) == $x['tag_agu']): ?> disabled <?php endif; ?> class="child_bulanan" type="checkbox" value="<?php echo $x['tag_agu'].'|agustus'; ?>"></td>
                            <td <?php if($x['tipe_agu']!=null): ?> style="color:green;" <?php endif; ?>>Agustus</td>
                            <td <?php if($x['tipe_agu']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_agu'] ,2,',','.'); ?></td>
                            <td><?php if($x['tgl_agu'] != null){ ?> <input type="date" name="tgl" class="form-control" disabled value="<?php echo $x['tgl_agu'];  ?>"> <?php }else{ ?> - <?php } ?></td>
                            <td <?php if($x['tipe_agu']!=null): ?> style="color:green;" <?php endif; ?>>
                            <?php if($x['tipe_agu'] != null){ ?>
                            <?php echo ucwords($x['tipe_agu']); ?>
                            <?php }else{ ?>
                            -
                            <?php } ?>
                            </td>                          
                        </tr>

                        <tr class="tagihan">
                            <td <?php if($x['tipe_sep']!=null): ?> style="color:green;" <?php endif; ?>>3</td>
                            <td><input name="bulanan[]" <?php if($modelsadmin->getTotalDibayarPerBulan($x['id_tagihan'], 'sep', $x['tag_sep']) == $x['tag_sep']): ?> disabled <?php endif; ?> class="child_bulanan" type="checkbox" value="<?php echo $x['tag_sep'].'|september'; ?>"></td>
                            <td <?php if($x['tipe_sep']!=null): ?> style="color:green;" <?php endif; ?>>September</td>
                            <td <?php if($x['tipe_sep']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_sep'] ,2,',','.'); ?></td>
                            <td><?php if($x['tgl_sep'] != null){ ?> <input type="date" name="tgl" class="form-control" disabled value="<?php echo $x['tgl_sep'];  ?>"> <?php }else{ ?> - <?php } ?></td>
                            <td <?php if($x['tipe_sep']!=null): ?> style="color:green;" <?php endif; ?>>
                            <?php if($x['tipe_sep'] != null){ ?>
                            <?php echo ucwords($x['tipe_sep']); ?>
                            <?php }else{ ?>
                            -
                            <?php } ?>
                            </td>                            
                        </tr>

                        <tr class="tagihan">
                            <td <?php if($x['tipe_okt']!=null): ?> style="color:green;" <?php endif; ?>>4</td>
                            <td><input name="bulanan[]" <?php if($modelsadmin->getTotalDibayarPerBulan($x['id_tagihan'], 'okt', $x['tag_okt']) == $x['tag_okt']): ?> disabled <?php endif; ?> class="child_bulanan" type="checkbox" value="<?php echo $x['tag_okt'].'|oktober'; ?>"></td>
                            <td <?php if($x['tipe_okt']!=null): ?> style="color:green;" <?php endif; ?>>Oktober</td>
                            <td <?php if($x['tipe_okt']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_okt'] ,2,',','.'); ?></td>
                            <td><?php if($x['tgl_okt'] != null){ ?> <input type="date" name="tgl" class="form-control" disabled value="<?php echo $x['tgl_okt'];  ?>"> <?php }else{ ?> - <?php } ?></td>
                            <td <?php if($x['tipe_okt']!=null): ?> style="color:green;" <?php endif; ?>>
                            <?php if($x['tipe_okt'] != null){ ?>
                            <?php echo ucwords($x['tipe_okt']); ?>
                            <?php }else{ ?>
                            -
                            <?php } ?>
                            </td>                          
                        </tr>

                        <tr class="tagihan">
                            <td <?php if($x['tipe_nov']!=null): ?> style="color:green;" <?php endif; ?>>5</td>
                            <td><input name="bulanan[]" <?php if($modelsadmin->getTotalDibayarPerBulan($x['id_tagihan'], 'nov', $x['tag_nov']) == $x['tag_nov']): ?> disabled <?php endif; ?> class="child_bulanan" type="checkbox" value="<?php echo $x['tag_nov'].'|november'; ?>"></td>
                            <td <?php if($x['tipe_nov']!=null): ?> style="color:green;" <?php endif; ?>>November</td>
                            <td <?php if($x['tipe_nov']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_nov'] ,2,',','.'); ?></td>
                            <td><?php if($x['tgl_nov'] != null){ ?> <input type="date" name="tgl" class="form-control" disabled value="<?php echo $x['tgl_nov'];  ?>"> <?php }else{ ?> - <?php } ?></td>
                            <td <?php if($x['tipe_nov']!=null): ?> style="color:green;" <?php endif; ?>>
                            <?php if($x['tipe_nov'] != null){ ?>
                            <?php echo ucwords($x['tipe_nov']); ?>
                            <?php }else{ ?>
                            -
                            <?php } ?>
                            </td>                             
                        </tr>

                        <tr class="tagihan">
                            <td <?php if($x['tipe_des']!=null): ?> style="color:green;" <?php endif; ?>>6</td>
                            <td><input name="bulanan[]" <?php if($modelsadmin->getTotalDibayarPerBulan($x['id_tagihan'], 'des', $x['tag_des']) == $x['tag_des']): ?> disabled <?php endif; ?> class="child_bulanan" type="checkbox" value="<?php echo $x['tag_des'].'|desember'; ?>"></td>
                            <td <?php if($x['tipe_des']!=null): ?> style="color:green;" <?php endif; ?>>Desember</td>
                            <td <?php if($x['tipe_des']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_des'] ,2,',','.'); ?></td>
                            <td><?php if($x['tgl_des'] != null){ ?> <input type="date" name="tgl" class="form-control" disabled value="<?php echo $x['tgl_des'];  ?>"> <?php }else{ ?> - <?php } ?></td>
                            <td <?php if($x['tipe_des']!=null): ?> style="color:green;" <?php endif; ?>>
                            <?php if($x['tipe_des'] != null){ ?>
                            <?php echo ucwords($x['tipe_nov']); ?>
                            <?php }else{ ?>
                            -
                            <?php } ?>
                            </td>                            
                        </tr>

                        <tr class="tagihan">
                            <td <?php if($x['tipe_jan']!=null): ?> style="color:green;" <?php endif; ?>>7</td>
                            <td><input name="bulanan[]" <?php if($modelsadmin->getTotalDibayarPerBulan($x['id_tagihan'], 'jan', $x['tag_jan']) == $x['tag_jan']): ?> disabled <?php endif; ?> class="child_bulanan" type="checkbox" value="<?php echo $x['tag_jan'].'|januari'; ?>"></td>
                            <td <?php if($x['tipe_jan']!=null): ?> style="color:green;" <?php endif; ?>>Januari</td>
                            <td <?php if($x['tipe_jan']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_jan'] ,2,',','.'); ?></td>
                            
                            <td><?php if($x['tgl_jan'] != null){ ?> <input type="date" name="tgl" class="form-control" disabled value="<?php echo $x['tgl_jan'];  ?>"> <?php }else{ ?> - <?php } ?></td>
                            <td <?php if($x['tipe_jan']!=null): ?> style="color:green;" <?php endif; ?>>
                            <?php if($x['tipe_jan'] != null){ ?>
                            <?php echo ucwords($x['tipe_jan']); ?>
                            <?php }else{ ?>
                            -
                            <?php } ?>
                            </td>
                        </tr>

                        <tr class="tagihan">
                            <td <?php if($x['tipe_feb']!=null): ?> style="color:green;" <?php endif; ?>>8</td>
                            <td><input name="bulanan[]" <?php if($modelsadmin->getTotalDibayarPerBulan($x['id_tagihan'], 'feb', $x['tag_feb']) == $x['tag_feb']): ?> disabled <?php endif; ?> class="child_bulanan" type="checkbox" value="<?php echo $x['tag_feb'].'|februari'; ?>"></td>
                            <td <?php if($x['tipe_feb']!=null): ?> style="color:green;" <?php endif; ?>>Februari</td>
                            <td <?php if($x['tipe_feb']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_feb'] ,2,',','.'); ?></td>
                            <td><?php if($x['tgl_feb'] != null){ ?> <input type="date" name="tgl" class="form-control" disabled value="<?php echo $x['tgl_feb'];  ?>"> <?php }else{ ?> - <?php } ?></td>
                            <td <?php if($x['tipe_feb']!=null): ?> style="color:green;" <?php endif; ?>>
                            <?php if($x['tipe_feb'] != null){ ?>
                            <?php echo ucwords($x['tipe_feb']); ?>
                            <?php }else{ ?>
                            -
                            <?php } ?>
                            </td>                          
                        </tr>

                        <tr class="tagihan">
                            <td <?php if($x['tipe_mar']!=null): ?> style="color:green;" <?php endif; ?>>9</td>
                            <td><input name="bulanan[]" <?php if($modelsadmin->getTotalDibayarPerBulan($x['id_tagihan'], 'mar', $x['tag_mar']) == $x['tag_mar']): ?> disabled <?php endif; ?> class="child_bulanan" type="checkbox" value="<?php echo $x['tag_mar'].'|maret'; ?>"></td>
                            <td <?php if($x['tipe_mar']!=null): ?> style="color:green;" <?php endif; ?>>Maret</td>
                            <td <?php if($x['tipe_mar']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_mar'] ,2,',','.'); ?></td>
                            <td><?php if($x['tgl_mar'] != null){ ?> <input type="date" name="tgl" class="form-control" disabled value="<?php echo $x['tgl_mar'];  ?>"> <?php }else{ ?> - <?php } ?></td>
                            <td <?php if($x['tipe_mar']!=null): ?> style="color:green;" <?php endif; ?>>
                            <?php if($x['tipe_mar'] != null){ ?>
                            <?php echo ucwords($x['tipe_mar']); ?>
                            <?php }else{ ?>
                            -
                            <?php } ?>
                            </td>                            
                        </tr>

                        <tr class="tagihan">
                            <td <?php if($x['tipe_apr']!=null): ?> style="color:green;" <?php endif; ?>>10</td>
                            <td><input name="bulanan[]" <?php if($modelsadmin->getTotalDibayarPerBulan($x['id_tagihan'], 'apr', $x['tag_apr']) == $x['tag_apr']): ?> disabled <?php endif; ?> class="child_bulanan" type="checkbox" value="<?php echo $x['tag_apr'].'|april'; ?>"></td>
                            <td <?php if($x['tipe_apr']!=null): ?> style="color:green;" <?php endif; ?>>April</td>
                            <td <?php if($x['tipe_apr']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_apr'] ,2,',','.'); ?></td>
                            <td><?php if($x['tgl_apr'] != null){ ?> <input type="date" name="tgl" class="form-control" disabled value="<?php echo $x['tgl_apr'];  ?>"> <?php }else{ ?> - <?php } ?></td>
                            <td <?php if($x['tipe_apr']!=null): ?> style="color:green;" <?php endif; ?>>
                            <?php if($x['tipe_apr'] != null){ ?>
                            <?php echo ucwords($x['tipe_apr']); ?>
                            <?php }else{ ?>
                            -
                            <?php } ?>
                            </td>
                        </tr>

                        <tr class="tagihan">
                            <td <?php if($x['tipe_mei']!=null): ?> style="color:green;" <?php endif; ?>>11</td>
                            <td><input name="bulanan[]" <?php if($modelsadmin->getTotalDibayarPerBulan($x['id_tagihan'], 'mei', $x['tag_mei']) == $x['tag_mei']): ?> disabled <?php endif; ?> class="child_bulanan" type="checkbox" value="<?php echo $x['tag_mei'].'|mei'; ?>"></td>
                            <td <?php if($x['tipe_mei']!=null): ?> style="color:green;" <?php endif; ?>>Mei</td>
                            <td <?php if($x['tipe_mei']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_mei'] ,2,',','.'); ?></td>
                            <td><?php if($x['tgl_mei'] != null){ ?> <input type="date" name="tgl" class="form-control" disabled value="<?php echo $x['tgl_mei'];  ?>"> <?php }else{ ?> - <?php } ?></td>
                            <td <?php if($x['tipe_mei']!=null): ?> style="color:green;" <?php endif; ?>>
                            <?php if($x['tipe_mei'] != null){ ?>
                            <?php echo ucwords($x['tipe_mei']); ?>
                            <?php }else{ ?>
                            -
                            <?php } ?>
                            </td>                             
                        </tr>

                        <tr class="tagihan">
                            <td <?php if($x['tipe_jun']!=null): ?> style="color:green;" <?php endif; ?>>12</td>
                            <td><input name="bulanan[]" <?php if($modelsadmin->getTotalDibayarPerBulan($x['id_tagihan'], 'jun', $x['tag_jun']) == $x['tag_jun']): ?> disabled <?php endif; ?> class="child_bulanan" type="checkbox" value="<?php echo $x['tag_jun'].'|juni'; ?>"></td>
                            <td <?php if($x['tipe_jun']!=null): ?> style="color:green;" <?php endif; ?>>Juni</td>
                            <td <?php if($x['tipe_jun']!=null): ?> style="color:green;" <?php endif; ?>><?php echo "Rp. ".number_format($x['tag_jun'] ,2,',','.'); ?></td>
                            <td><?php if($x['tgl_jun'] != null){ ?> <input type="date" name="tgl" class="form-control" disabled value="<?php echo $x['tgl_jun'];  ?>"> <?php }else{ ?> - <?php } ?></td>
                            <td <?php if($x['tipe_jun']!=null): ?> style="color:green;" <?php endif; ?>>
                            <?php if($x['tipe_jun'] != null){ ?>
                            <?php echo ucwords($x['tipe_jun']); ?>
                            <?php }else{ ?>
                            -
                            <?php } ?>
                            </td>  
                            
                        </tr>

                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" style="float: right;">Bayar</button>
                </div>
        
            </form>
        
        </div>
      </div>
    </section>
  </div>

  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= $client_key; ?>"></script>
  <script>
    $(document).ready(function(){

        $('#bayar_bulanan').submit(function(e){
            e.preventDefault();
            if($('input[name="bulanan[]"]:checked').length <= 0){
              
                swal('Pilih pembayaran minimal satu');
            
            }else{

                $.ajax({
                    url: "<?= base_url('siswa/bayarbulanan') ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(data){
                        var data = JSON.parse(data);
                        snap.pay(data.snap_token, {
                            onSuccess: function(result){
                                $.ajax({
                                    url: '<?= base_url('siswa/bayarbulanan_update'); ?>',
                                    type: 'POST',
                                    data: $(this).serialize(),
                                    success: function(data){
                                      swal(data)
                                      .then((result) => {
                                          location.reload();
                                      });
                                    }
                                });
                            },
                            onPending: function(result){

                            },
                            onError: function(result){
                            console.log('Error : '+JSON.stringify(result, null, 2));
                            }
                        });
                    },
                    error: function(error){
                        console.log(error);
                    }
                });
                

            };


        });

    });
  </script>
<?= $this->endSection('content'); ?>