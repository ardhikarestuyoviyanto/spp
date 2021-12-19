<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelLogin extends Model{

    public function getDataAdmin(){
        $build = $this->db->table('admin');
        return $build->get();
    }

    public function getDataSiswa(){
        $build = $this->db->table('siswa');
        return $build->get();
    }

    public function loginsiswa($nis){
        $build = $this->db->table('siswa');
        $build->where('nis', $nis);
        return $build->get();
    }

}
?>