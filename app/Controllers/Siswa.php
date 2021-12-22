<?php
namespace App\Controllers;
use App\Models\ModelManajemen;
use App\Models\ModelAdmin;

class Siswa extends BaseController{

    public function __construct(){
        view_cell('App\Libraries\Widget::footer', ['footer' => "ardhikayoviyanto@gmail.com"]);
    }

    public function home(){
        view_cell('App\Libraries\Widget::title', ['title'=>"Selamat Datang Siswa"]);
        view_cell('App\Libraries\Widget::sidebar_siswa', ['sidebar'=>"Dashboard"]);

        $model = new ModelManajemen();

        $data = array(
            'data_sekolah' => $model->getSekolah()->getResult(),
            'nama_kelas' => $model->getNamakelas($_SESSION['login_siswa'])
        );

        echo view('siswa/home/homepage.php', $data);
    }

    public function tagihan(){
        view_cell('App\Libraries\Widget::title', ['title'=>"Tagihan Siswa"]);
        view_cell('App\Libraries\Widget::sidebar_siswa', ['sidebar'=>"Tagihan"]);

        $_model = new ModelAdmin();

        if(isset($_SESSION['login_siswa'])){

            $res_bulanan = array();
            $key = 0;

            foreach ($_model->getTagihanBulananSiswa($_SESSION['login_siswa'])->getResult() as $x):
                $res_bulanan[$key]['nama_pembayaran'] = $x->nama_pembayaran;
                $res_bulanan[$key]['id_tagihan'] = $x->id_tagihan;
                $res_bulanan[$key]['total_tagihan'] = $x->total_tagihan;
                $res_bulanan[$key]['tahun_ajaran'] = $x->tahun_ajaran;
                $res_bulanan[$key]['total_bayar'] = $_model->getTagihanBulananSiswaDetail($x->id_tagihan);
            
            $key++;
            endforeach;

            $data = array(
                'data_siswa' => $_model->getSiswaBynisJoinKelas($_SESSION['login_siswa'])->getResult(),
                'data_bulanan' => $res_bulanan,
                'data_bebas' => $_model->getTagihanBebasSiswa($_SESSION['login_siswa'])->getResult(),
                'client_key' => getenv('MIDTRANS_CLIENT_KEY')
            );

            echo view('siswa/keuangan/tagihan', $data);


        }else{

            redirect('/');

        }

    }

    public function detailtagihanbulanan(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Tagihan Bulanan Siswa"]);
        view_cell('App\Libraries\Widget::sidebar_siswa', ['sidebar'=>"Tagihan"]);

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        if(empty(@$_SESSION['login_siswa'])){

            return redirect('siswa/tagihan');

        }else{

            $result = array();
            $key = 0;


            foreach ($model->getDataTagihanBulanan($request->uri->getSegment(3))->getResult() as $x):
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
                'nis' => @$_SESSION['login_siswa'],
                'nama_pembayaran' => $model->getNamaPembayaranByTagihan_Bulanan($request->uri->getSegment(3)),
                'nama_siswa' => $model->getNamaSiswa(@$_SESSION['login_siswa']),
                'informasiTagihan' => $model->getInformasiTagihanBulanan($request->uri->getSegment(3))->getResult(),
                'data' => $result,
                'id_tagihan' => $request->uri->getSegment(3),
                'client_key' => getenv('MIDTRANS_CLIENT_KEY')
            );

            echo view('siswa/keuangan/detailtagihanbulanan', $data);

        }

    }

}
?>