<?= $this->extend('admin/portal'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pembayaran Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Pembayaran Siswa</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                <div class="card-header">
                  Filter Siswa
                </div>
                <div class="card-body">
                    <div class="container">
                        <form action="<?php echo base_url('admin/pembayaran') ?>" method="get">
                        <div class="form-group justify-content-center row">
                            <label class="col-sm-2 mt-2 mb-2 col-form-label">NIS / NISN / Nama</label>
                            <div class="col-sm-6 mt-2 mb-2">
                                <select class="form-control select2bs4" style="width: 100%;" name="siswa" required>
                                    <option value="">- pilih Siswa-</option>
                                </select>
                            </div>
                            <div class="col-sm-3 mt-2 mb-2">
                                <button type="submit" class="btn btn-info">Cari Siswa</button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

      </div>
    </section>
  </div>

  <script>
    $(document).ready(function(){
        $('.select2bs4').select2({
        theme: 'bootstrap4',
        minimumInputLength: 1,
           allowClear: true,
           placeholder: 'Masukkan NISN/NIS/Nama Siswa',
           ajax: {
              dataType: 'json',
              url: '<?php echo base_url('Admin/getSiswaSearchLimit') ?>',
              delay: 250,
              data: function(params) {
                return {
                  search: params.term
                }
              },
              processResults: function (data) {
                var results = [];

                $.each(data, function(index, item){
                    results.push({
                        id : item.nis,
                        text : item.nis+" - "+item.nama_siswa
                    });
                });

                return{
                    results : results
                }
            },
          }
        
        })
    });
  </script>
<?= $this->endSection('content'); ?>