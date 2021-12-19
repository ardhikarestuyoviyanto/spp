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
                'data_bebas' => $_model->getTagihanBebasSiswa($_SESSION['login_siswa'])->getResult()
            );

            echo view('siswa/keuangan/tagihan', $data);


        }else{

            redirect('/');

        }

    }

}
?>