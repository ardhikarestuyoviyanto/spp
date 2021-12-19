<?php
namespace App\Libraries;
class Widget{

    public function title($params){
        return view('partisi/head', $params);
    }

    public function footer($params){
        return view('partisi/footer', $params);
    }

    public function sidebar($params){
        return view('partisi/sidebar_admin', $params);
    }

    public function sidebar_siswa($params){
        return view('partisi/sidebar_siswa', $params);
    }

    public function kop_surat($data){
        return view('admin/doc/kop_surat', $data);
    }

}
?>