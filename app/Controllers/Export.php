<?php
namespace App\Controllers;
use App\Models\ModelAdmin;
use App\Models\ModelManajemen;

class Export extends BaseController{

    public function __construct(){
        $model_manajemen = new ModelManajemen();
        $kop_surat= array(
            'data_sekolah' => $model_manajemen->getSekolah()->getResult()
        );
        view_cell('App\Libraries\Widget::footer', ['footer' => "ardhikayoviyanto@gmail.com"]);

        view_cell('App\Libraries\Widget::kop_surat', $kop_surat);

    }

    public function exporttagihanpersiswa(){

        $request = \Config\Services::request();
        $_model = new ModelAdmin();

        $res_bulanan = array();
        $key = 0;

        foreach ($_model->getTagihanBulananSiswa($request->uri->getSegment(3))->getResult() as $x):
            $res_bulanan[$key]['nama_pembayaran'] = $x->nama_pembayaran;
            $res_bulanan[$key]['id_tagihan'] = $x->id_tagihan;
            $res_bulanan[$key]['total_tagihan'] = $x->total_tagihan;
            $res_bulanan[$key]['tahun_ajaran'] = $x->tahun_ajaran;
            $res_bulanan[$key]['total_bayar'] = $_model->getTagihanBulananSiswaDetail($x->id_tagihan);
        
        $key++;
        endforeach;

        $data = array(
            'data_siswa' => $_model->getSiswaBynisJoinKelas($request->uri->getSegment(3))->getResult(),
            'data_bulanan' => $res_bulanan,
            'data_bebas' => $_model->getTagihanBebasSiswa($request->uri->getSegment(3))->getResult()
        );

        echo view('admin/doc/export_persiswa', $data);

    }

    public function export_pertagihanbebas(){

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        if(empty($request->uri->getSegment(3)) || empty($request->uri->getSegment(4))){

            return redirect('admin/pembayaran');

        }else{

            $data = array(
                'nis' => $request->uri->getSegment(3),
                'nama_pembayaran' => $model->getNamaPembayaranByTagihan_Bebas($request->uri->getSegment(4)),
                'nama_siswa' => $model->getNamaSiswa($request->uri->getSegment(3)),
                'informasiTagihan' => $model->getInformasiTagihanBebas($request->uri->getSegment(4))->getResult(),
                'data' => $model->getDataTagihanBebas($request->uri->getSegment(4))->getResult()
            );

            echo view('admin/doc/export_pertagihanbebas.php', $data);

        }

    }

    public function export_pertransaksibebas(){

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        $data = array(
            'nama_pembayaran' => $model->getNamaPembayaranByTagihan_Bebas($request->uri->getSegment(4)),
            'data' => $model->getDataTransaksiBebasPerTransaksi($request->uri->getSegment(3))->getResult(),
            'informasiTagihan' => $model->getInformasiTagihanBebas($request->uri->getSegment(4))->getResult()
        );

        echo view('admin/doc/export_pertransaksibebas.php', $data);

    }

    public function export_pertagihanbulanan(){

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        if(empty($request->uri->getSegment(3)) || empty($request->uri->getSegment(4))){

            return redirect('admin/pembayaran');

        }else{

            $result = array();
            $key = 0;

            foreach ($model->getDataTagihanBulanan($request->uri->getSegment(4))->getResult() as $x):
                $result[$key]['id_tagihan'] = $x->id_tagihan;
                $result[$key]['tag_jan'] = $x->tag_jan;
                $result[$key]['tag_feb'] = $x->tag_feb;
                $result[$key]['tag_mar'] = $x->tag_mar;
                $result[$key]['tag_apr'] = $x->tag_apr;
                $result[$key]['tag_mei'] = $x->tag_mei;
                $result[$key]['tag_jun'] = $x->tag_jun;
                $result[$key]['tag_jul'] = $x->tag_jul;
                $result[$key]['tag_agu'] = $x->tag_agu;
                $result[$key]['tag_sep'] = $x->tag_sep;
                $result[$key]['tag_okt'] = $x->tag_okt;
                $result[$key]['tag_nov'] = $x->tag_nov;
                $result[$key]['tag_des'] = $x->tag_des;

                $DetailJan = $model->getDetailTagihanBulanan($x->id_tagihan, 'jan');
                $DetailFeb = $model->getDetailTagihanBulanan($x->id_tagihan, 'feb');
                $DetailMar = $model->getDetailTagihanBulanan($x->id_tagihan, 'mar');
                $DetailApr = $model->getDetailTagihanBulanan($x->id_tagihan, 'apr');
                $DetailMei = $model->getDetailTagihanBulanan($x->id_tagihan, 'mei');
                $DetailJun = $model->getDetailTagihanBulanan($x->id_tagihan, 'jun');
                $DetailJul = $model->getDetailTagihanBulanan($x->id_tagihan, 'jul');
                $DetailAgu = $model->getDetailTagihanBulanan($x->id_tagihan, 'agu');
                $DetailSep = $model->getDetailTagihanBulanan($x->id_tagihan, 'sep');
                $DetailOkt = $model->getDetailTagihanBulanan($x->id_tagihan, 'okt');
                $DetailNov = $model->getDetailTagihanBulanan($x->id_tagihan, 'nov');
                $DetailDes = $model->getDetailTagihanBulanan($x->id_tagihan, 'des');

                $result[$key]['tipe_jan'] = $DetailJan[0];
                $result[$key]['tgl_jan'] = $DetailJan[1];

                $result[$key]['tipe_feb'] = $DetailFeb[0];
                $result[$key]['tgl_feb'] = $DetailFeb[1];

                $result[$key]['tipe_mar'] = $DetailMar[0];
                $result[$key]['tgl_mar'] = $DetailMar[1];

                $result[$key]['tipe_apr'] = $DetailApr[0];
                $result[$key]['tgl_apr'] = $DetailApr[1];

                $result[$key]['tipe_mei'] = $DetailMei[0];
                $result[$key]['tgl_mei'] = $DetailMei[1];

                $result[$key]['tipe_jun'] = $DetailJun[0];
                $result[$key]['tgl_jun'] = $DetailJun[1];

                $result[$key]['tipe_jul'] = $DetailJul[0];
                $result[$key]['tgl_jul'] = $DetailJul[1];

                $result[$key]['tipe_agu'] = $DetailAgu[0];
                $result[$key]['tgl_agu'] = $DetailAgu[1];

                $result[$key]['tipe_sep'] = $DetailSep[0];
                $result[$key]['tgl_sep'] = $DetailSep[1];

                $result[$key]['tipe_okt'] = $DetailOkt[0];
                $result[$key]['tgl_okt'] = $DetailOkt[1];

                $result[$key]['tipe_nov'] = $DetailNov[0];
                $result[$key]['tgl_nov'] = $DetailNov[1];

                $result[$key]['tipe_des'] = $DetailDes[0];
                $result[$key]['tgl_des'] = $DetailDes[1];

                $key++;
            endforeach;

            $data = array(
                'nis' => $request->uri->getSegment(3),
                'nama_pembayaran' => $model->getNamaPembayaranByTagihan_Bulanan($request->uri->getSegment(4)),
                'nama_siswa' => $model->getNamaSiswa($request->uri->getSegment(3)),
                'informasiTagihan' => $model->getInformasiTagihanBulanan($request->uri->getSegment(4))->getResult(),
                'data' => $result,
            );

            echo view('admin/doc/export_pertagihanbulanan.php', $data);

        }

    }

    public function export_pertransaksibulanan(){
        $request = \Config\Services::request();
        $model = new ModelAdmin();

        $data = array(
            'nama_pembayaran' => $model->getNamaPembayaranByTagihan_Bulanan($request->uri->getSegment(3)),
            'data' => $model->getDataTransaksiBulananPerTransaksi($request->uri->getSegment(3), $request->uri->getSegment(4))->getResult(),
            'informasiTagihan' => $model->getInformasiTagihanBulanan($request->uri->getSegment(3))->getResult()
        );

        echo view('admin/doc/export_pertransaksibulanan.php', $data);
    }

    public function export_multibayar(){
        $request = \Config\Services::request();
        $model = new ModelAdmin();

        $data = array(
            'data_bulanan' => $model->getDetailMultiBulanan($request->uri->getSegment(3))->getResult(),
            'data_bebas' => $model->getDetailMultiBebas($request->uri->getSegment(3))->getResult(),
            'informasiTagihan' => $model->getSiswaBynisJoinKelas($request->uri->getSegment(4))->getResult()
        );

        echo view('admin/doc/export_multibayar.php', $data);

    }

    public function exportsiswa_pdf(){

        $model = new ModelAdmin();

        if(isset($_GET['kelas'])){

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'siswa' => $model->getSiswaByNamaKelas(urldecode($_GET['kelas']))->getResult()
            );

        }

        echo view('admin/doc/exportsiswa_pdf', $data);

    }

    public function exportsiswa_excel(){

        $model = new ModelAdmin();

        if(isset($_GET['kelas'])){

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'siswa' => $model->getSiswaByNamaKelas(urldecode($_GET['kelas']))->getResult()
            );

        }

        echo view('admin/doc/exportsiswa_excel', $data);

    }

    public function exportbulanan_kelas(){

        $model = new ModelAdmin();

        if(isset($_GET['kelas']) && isset($_GET['tahun']) && isset($_GET['pembayaran'])){

            $data = array(
                'kelas' => $model->getKelasByid($_GET['kelas'])->getResult(),
                'pembayaran' => $model->getNamaPembayaranByTagihan_Bulanan($_GET['pembayaran']),
                'data' => $model->getDataPembayaranBulanan($_GET['kelas'], urldecode($_GET['tahun']), $_GET['pembayaran'])->getResult()
            );

            if($_GET['type'] == "pdf"){

                echo view('admin/doc/exportbulanan_kelas', $data);


            }else{

                echo view('admin/doc/exportbulanan_kelas_excel', $data);

            }


        }


    }

    public function export_laplain(){

        $model = new ModelAdmin();

        if(isset($_GET['kelas']) && isset($_GET['tahun']) && isset($_GET['pembayaran'])){

            $data = array(
                'kelas' => $model->getNamaKelas($_GET['kelas']),
                'tahun_ajaran' => $model->getTahunajar()->getResult(),
                'pembayaran' => $model->getPembayaranBebas()->getResult(),
                'data' => $model->getPembayaranBebasBykelas($_GET['kelas'], $_GET['tahun'], $_GET['pembayaran'])->getResult(),
                'namapembayaran' => $model->getNamaPembayaran($_GET['pembayaran'])
            );

            if($_GET['type'] == "pdf"){
                
                echo view('admin/doc/export_laplain', $data);

            }else{

                echo view('admin/doc/export_laplain_excle', $data);

            }

        }

    }

    public function export_rekap_bebas(){

        $model = new ModelAdmin();

        if(isset($_GET['tahun']) && isset($_GET['pembayaran'])){

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'namapembayaran' => $model->getNamaPembayaran($_GET['pembayaran'])
            );

                
            echo view('admin/doc/export_rekap', $data);

            
        }

    }

    public function export_rekap_bulanan(){

        $model = new ModelAdmin();

        if(isset($_GET['tahun']) && isset($_GET['pembayaran'])){

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'namapembayaran' => $model->getNamaPembayaran($_GET['pembayaran'])
            );

                
            echo view('admin/doc/export_rekap_bulanan', $data);

            
        }

    }

    //tambahan

    public function export_rekap_det_bebas(){

        $model = new ModelAdmin();

        if(isset($_GET['kelas']) && isset($_GET['tahun']) && isset($_GET['pembayaran'])){

            $data = array(
                'data' => $model->getRekapBebasDetail($_GET['kelas'], $_GET['pembayaran'], $_GET['tahun'], $_GET['start'], $_GET['finish'])->getResult(),
                'namapembayaran' => $model->getNamaPembayaran($_GET['pembayaran']),
                'kelas' => $model->getSiswaByKelas($_GET['kelas'])->getResult()
            );

            echo view('admin/doc/export_rekap_det_bebas', $data);

        }

    }

    public function export_rekap_det_bulanan(){

        $model = new ModelAdmin();

        if(isset($_GET['kelas']) && isset($_GET['tahun']) && isset($_GET['pembayaran'])){

            $data = array(
                'data' => $model->getRekapBulananDetail($_GET['kelas'], $_GET['pembayaran'], $_GET['tahun'], $_GET['start'], $_GET['finish'])->getResult(),
                'namapembayaran' => $model->getNamaPembayaran($_GET['pembayaran']),
                'kelas' => $model->getSiswaByKelas($_GET['kelas'])->getResult(),
            );

            echo view('admin/doc/export_rekap_det_bulanan', $data);

        }

    }

    public function export_lap_wali_kelas(){

        $model = new ModelAdmin();

        if(isset($_GET['kelas']) && isset($_GET['tahun']) && isset($_GET['type'])){

            $data = array(
                'siswa' => $model->getSiswaByKelas($_GET['kelas'])->getResult(),
                'bebas' => $model->getPembayaranBebasByTahunAjaran($_GET['tahun'])->getResult(),
                'bulanan' => $model->getPembayaranBulananByTahunAjaran($_GET['tahun'])->getResult(),
                'namakelas' => $model->getNamaKelas($_GET['kelas']),
                'kelas' => $model->getKelas()->getResult(),
                'tahun_ajaran' => $model->getTahunajar()->getResult()
            );

            if($_GET['type'] == "show"){

                view_cell('App\Libraries\Widget::title', ['title'=>"Laporan Pembayaran Per Kelas - Laporan"]);
                view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"LapWali"]);

                echo view('admin/export/lapwalikelas', $data);

            }else

            if($_GET['type'] == "pdf"){

                echo view('admin/doc/export_rekap_wali_pdf', $data);


            }else{

                echo view('admin/doc/export_rekap_wali_excel', $data);

            }


        }

    }

    public function exportkartu(){

        $request = \Config\Services::request();
        $_model = new ModelAdmin();

        $res_bulanan = array();
        $key = 0;

        foreach ($_model->getTagihanBulananSiswa($request->uri->getSegment(3))->getResult() as $x):
            $res_bulanan[$key]['nama_pembayaran'] = $x->nama_pembayaran;
            $res_bulanan[$key]['id_tagihan'] = $x->id_tagihan;
            $res_bulanan[$key]['total_tagihan'] = $x->total_tagihan;
            $res_bulanan[$key]['tahun_ajaran'] = $x->tahun_ajaran;
            $res_bulanan[$key]['total_bayar'] = $_model->getTagihanBulananSiswaDetail($x->id_tagihan);
        
        $key++;
        endforeach;

        $data = array(
            'data_siswa' => $_model->getSiswaBynisJoinKelas($request->uri->getSegment(3))->getResult(),
            'data_bulanan' => $res_bulanan,
            'data_bebas' => $_model->getTagihanBebasSiswa($request->uri->getSegment(3))->getResult()
        );

        echo view('admin/doc/export_kartu', $data);


    }

    public function export_pemasukan_pdf(){

        $model = new ModelAdmin();

        if(isset($_GET['start']) && isset($_GET['finish'])){

            $data = array(
                'bebass' => $model->getTagihanBebas()->getResult(),
                'bulanann' => $model->getTagihanBulanan()->getResult(),
                'siswa' => $model->getSiswa()->getResult()
            );

            if($_GET['type'] == "prev"){

                view_cell('App\Libraries\Widget::title', ['title'=>"Pemasukan - Laporan"]);
                view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"pemasukan"]);

                echo view('admin/export/pemasukan', $data);

            }else

            if($_GET['type'] == "pdf"){

                echo view('admin/doc/export_pemasukan_pdf', $data);


            }else{

                echo view('admin/doc/export_pemasukan_excel', $data);

            }


        }

    }

}
?>