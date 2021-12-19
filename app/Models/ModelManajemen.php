<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelManajemen extends Model{

    public function getUser(){
        $build = $this->db->table('admin');
        $build->orderBy('nama', "ASC");
        return $build->get();
    }

    public function tambahUser($data){
        $build = $this->db->table('admin');
        $build->insert($data);
    }

    public function hapusUser($username){
        $build = $this->db->table('admin');
        $build->where('username', $username);
        $build->delete();
    }

    public function getUserByusername($username){
        $build = $this->db->table('admin');
        $build->where('username', $username);
        return $build->get();
    }

    public function editUser($id, $data){
        $build = $this->db->table('admin');
        $build->where('id', $id);
        $build->update($data);
    }

    public function getSekolah(){
        $build = $this->db->table('setting');
        return $build->get();
    }

    public function updateSekolah($data){
        $build = $this->db->table('setting');
        $build->update($data);
    }

    public function getUserAktif(){
        $build = $this->db->table('admin');
        return $build->countAllResults();
    }

    public function getSiswaAktif(){
        $build = $this->db->table('siswa');
        $build->where('status', "T");
        return $build->countAllResults();
    }

    public function getSiswaLulus(){
        $build = $this->db->table('siswa');
        $build->where('status', "L");
        return $build->countAllResults();
    }

    public function pemasukan(){
        $build = $this->db->table('transaksi_bulanan');
        $build->selectSum('total_bayar');
        $bulanan =  $build->get();

        $build = $this->db->table('transaksi_bebas');
        $build->selectSum('total_bayar');
        $bebas = $build->get();

        foreach ($bulanan->getResult() AS $x):
            $bulanan_total = $x->total_bayar;
        endforeach;

        foreach ($bebas->getResult() AS $y):
            $bebas_total = $y->total_bayar;
        endforeach;

        return $bulanan_total + $bebas_total;
    }

    public function getNamakelas($nis){
        $build = $this->db->table('kelas');
        $build->join('siswa', 'siswa.id_kelas=kelas.id_kelas');
        $build->where('nis', $nis);
        foreach ($build->get()->getResult() as $x):
            return $x->nama_kelas;
        endforeach;
    }

}
?>