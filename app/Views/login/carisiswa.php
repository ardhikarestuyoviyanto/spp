<?php echo $this->include('partisi/head'); ?>
<style>
.card-login:hover {
  background-color: #051702;
  box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
  color: #dfdfdc;
}
.card-login, .card-visimisi{
  color : #051702;
  background-color: #f7f7f7;
}
.title{
  color: dimgray;
  font-size: 39px;
  font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}
</style>
<body class="hold-transition sidebar-collapse layout-top-nav" style="background-color:#0a240a;">
<div class="wrapper" >

  <nav class="main-header navbar navbar-expand-md fixed-top" style="background-color:#051702;">
    <div class="container">
      <a href="<?php echo base_url() ?>" class="navbar-brand" style="color:white;">
        <img src="https://www.smkngudo.sch.id/wp-content/uploads/2021/02/logo-smkn-gudo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Smk Percobaan</span>
      </a>
    </div>
  </nav>

  <div class="content mt-5" >
    <br>
      <div class="container">

        <div class="card mt-3">
            <div class="card-header bg-success">
                Cek Tagihan
                <a href="<?php echo base_url('/'); ?>" type="button" class="btn btn-sm btn-success active" style="float:right;">Kembali</a>
            </div>
            <div class="card-body">
            <form action="<?php echo base_url('home/carisiswa'); ?>" method="get">
                <div class="form-group justify-content-center row">
                    <label class="col-sm-2 mt-2 mb-2 col-form-label">NIS / NISN / Nama</label>
                    <div class="col-sm-6 mt-2 mb-2">
                        <select class="form-control select2bs4" style="width: 100%;" name="siswa" required>
                            <option value="">- pilih Siswa-</option>
                        </select>
                    </div>
                    <div class="col-sm-3 mt-2 mb-2">
                        <button type="submit" class="btn btn-success">Cari Siswa</button>
                    </div>
                </div>
            </form>
            </div>
        </div>

    </div>
    <footer class="main-footer text-center fixed-bottom" style="background-color:#051702; color:white;">
    <strong>Copyright &copy; 2021 Sistem Informasi Pembayaran Sekolah
  </footer>
</div>
  </div>

<?php echo $this->include('partisi/js_login'); ?>
<script src="<?php echo base_url('plugins/select2/js/select2.full.min.js') ?>"></script>
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
</body>
</html>