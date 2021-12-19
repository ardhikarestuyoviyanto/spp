<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelAdmin extends Model{

    public function simpantahunajar($data){
        $build = $this->db->table('tahun_ajaran');
        $build->insert($data);
    }

    public function getahunajarbytahun($tahun){
        $build = $this->db->table('tahun_ajaran')
                ->where('tahun_ajaran', $tahun);
        return $build->countAllResults();
    }

    public function getTahunajar(){
        $build = $this->db->table('tahun_ajaran');
        $build->orderBy('tahun_ajaran', "ASC");
        return $build->get();
    }

    public function edittahunajar($id, $data){
        $build = $this->db->table('tahun_ajaran');
        $build->where('id', $id);
        $build->update($data);
    }

    public function getTahunajarbyid($id){
        $build = $this->db->table('tahun_ajaran')
                ->where('id', $id);
        return $build->get();
    }

    public function hapusTahunajar($id){
        $build = $this->db->table('tahun_ajaran');
        $build->where('id', $id);
        $build->delete();
    }

    //----------------------------------------------------------------

    public function tambahkelas($data){
        $build = $this->db->table('kelas');
        $build->insert($data);
    }

    public function getKelas(){
        return $this->db->table('kelas')->orderBy('nama_kelas', "ASC")->get();
    }
    
    public function getKelasByid($id){
        $build = $this->db->table('kelas');
        $build->where('id_kelas', $id);
        return $build->get();

    }

    public function hapuskelas($id){
        $build = $this->db->table('kelas');
        $build->where('id_kelas', $id);
        $build->delete();
    }

    public function editkelas($id, $data){
        $build = $this->db->table('kelas');
        $build->where('id_kelas', $id);
        $build->update($data);
    }

    //--------------------------------------------------------------------

    public function tambahsiswa($data){
        $build = $this->db->table('siswa');
        $build->insert($data);
    }

    public function getSiswaByNis($nis){
        $build = $this->db->table('siswa');
        $build->where('nis', $nis);
        return $build->get();
    }

    public function getSiswa(){
        $build = $this->db->table('siswa');
        $build->join('kelas', 'siswa.id_kelas=kelas.id_kelas');
        $build->orderBy('nisn', "DESC");
        return $build->get();
    }

    public function editsiswa($nis, $data){
        $build = $this->db->table('siswa');
        $build->where('nis', $nis);
        $build->update($data);
    }

    public function hapussiswa($nis){
        $build = $this->db->table('siswa');
        $build->where('nis', $nis);
        $build->delete();
    }

    public function Filtersiswa($status, $kelas){
        $build = $this->db->table('siswa');
        $build->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        $build->where('status', $status);
        $build->where('nama_kelas', $kelas);
        $build->orderBy('nisn', "DESC");
        return $build->get();
    }

    public function getNamaSiswa($nis){
        $build = $this->db->table('siswa');
        $build->where('nis', $nis);
        $res = $build->get();

        foreach ($res->getResult() as $x):
            return $x->nama_siswa;
        endforeach;
    }

    //--------------------------------------------------------------------

    public function tambahpos($data){
        $build = $this->db->table('pembayaran');
        $build->insert($data);
    }

    public function getpos(){
        $build = $this->db->table('pembayaran');
        $build->orderBy('tahun_ajaran', "DESC");
        return $build->get();
    }

    public function getposByid($id){
        $build = $this->db->table('pembayaran');
        $build->where('id_pembayaran', $id);
        return $build->get();
    }

    public function editpos($id, $data){
        $build = $this->db->table('pembayaran');
        $build->where('id_pembayaran', $id);
        $build->update($data);
    }

    public function hapuspos($id){
        $build = $this->db->table('pembayaran');
        $build->where('id_pembayaran', $id);
        $build->delete();
    }

    public function filterpos($tahunajar){
        $build = $this->db->table('pembayaran');
        $build->where('tahun_ajaran', $tahunajar);
        return $build->get();
    }

    //--------------------------------------------------------------------

    public function getSiswaByKelas($id_kelas){
        $build = $this->db->table('siswa');
        $build->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        $build->where('siswa.id_kelas', $id_kelas);
        return $build->get();
    }

    public function getSiswaByNamaKelas($nama_kelas){
        $build = $this->db->table('siswa');
        $build->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        $build->where('nama_kelas', $nama_kelas);
        return $build->get();
    }

    public function prosesKenaikanKelas($data, $nis){
        $build = $this->db->table('siswa');
        $build->where('nis', $nis);
        $build->update($data);
    }

    public function getSiswaBelumLulus($id_kelas){
        $build = $this->db->table('siswa');
        $build->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        $build->where('siswa.id_kelas', $id_kelas);
        $build->where('status', "T");
        $build->orWhere('status', "P");
        return $build->get();
    }

    public function prosesKelulusan($data, $nis){
        $build = $this->db->table('siswa');
        $build->where('nis', $nis);
        $build->update($data);
    }

    //--------------------------------------------------------------------
    public function getNamaPembayaran($id_pembayaran){
        $build = $this->db->table('pembayaran');
        $build->where('id_pembayaran', $id_pembayaran);
        foreach ($build->get()->getResult() as $x):
            return $x->nama_pembayaran;
        endforeach;
    }

    public function getTahunAjaran($id_pembayaran){
        $build = $this->db->table('pembayaran');
        $build->where('id_pembayaran', $id_pembayaran);
        foreach ($build->get()->getResult() as $x):
            return $x->tahun_ajaran;
        endforeach;
    }

    public function getTipePembayaran($id_pembayaran){
        $build = $this->db->table('pembayaran');
        $build->where('id_pembayaran', $id_pembayaran);
        foreach ($build->get()->getResult() as $x):
            return $x->tipe_pembayaran;
        endforeach;
    }

    public function getNamaPembayaranByTagihan_Bulanan($id_tagihan){
        $build = $this->db->table('pembayaran');
        $build->join('tagihan_bulanan', 'tagihan_bulanan.id_pembayaran = pembayaran.id_pembayaran');
        $build->where('id_tagihan', $id_tagihan);
        foreach ($build->get()->getResult() as $x):
            return $x->nama_pembayaran;
        endforeach;
    }

    public function getNamaPembayaranByTagihan_Bebas($id_tagihan){
        $build = $this->db->table('pembayaran');
        $build->join('tagihan_bebas', 'tagihan_bebas.id_pembayaran = pembayaran.id_pembayaran');
        $build->where('id_tagihan', $id_tagihan);
        foreach ($build->get()->getResult() as $x):
            return $x->nama_pembayaran;
        endforeach;
    }

    //--------------------------------------------------------------------
    public function SimpanTagihan_bebas($data){
        $build = $this->db->table('tagihan_bebas');
        $build->insert($data);
    }

    public function SimpanTagihan_bulanan($data){
        $build = $this->db->table('tagihan_bulanan');
        $build->insert($data);
    }

    //--------------------------------------------------------------------
    // Mendapatkan Data Tagihan Siswa ( Bulanan dan Bebas)
    //--------------------------------------------------------------------
    public function getDataTagihan_bebas($id_pembayaran, $id_kelas){
        $build = $this->db->table('siswa');
        $build->join('tagihan_bebas','siswa.nis=tagihan_bebas.nis');
        $build->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        $build->where('id_pembayaran', $id_pembayaran);
        $build->where('siswa.id_kelas', $id_kelas);
        return $build->get();
    }

    public function getDataTagihan_bulanan($id_pembayaran, $id_kelas){
        $build = $this->db->table('siswa');
        $build->join('tagihan_bulanan', 'siswa.nis=tagihan_bulanan.nis');
        $build->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        $build->where('id_pembayaran', $id_pembayaran);
        $build->where('siswa.id_kelas', $id_kelas);
        return $build->get();
    }
    

    //--------------------------------------------------------------------
    // Mendapatkan Data Tagihan Siswa Bebas
    //--------------------------------------------------------------------
    public function getTagihanByid_bebas($id_tagihan){
        $build = $this->db->table('pembayaran');
        $build->join('tagihan_bebas', 'tagihan_bebas.id_pembayaran = pembayaran.id_pembayaran');
        $build->join('siswa', 'siswa.nis = tagihan_bebas.nis');
        $build->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        $build->where('id_tagihan', $id_tagihan);
        return $build->get();
    }

    public function updateTagihanBebas($id_tagihan, $data){
        $build = $this->db->table('tagihan_bebas');
        $build->where('id_tagihan', $id_tagihan);
        $build->update($data);
    }

    public function hapusTagihanBebas($id_tagihan){
        $build = $this->db->table('tagihan_bebas');
        $build->where('id_tagihan', $id_tagihan);
        $build->delete();
    }

    //--------------------------------------------------------------------
    // Mendapatkan Data Tagihan Siswa Bulanan
    //--------------------------------------------------------------------
    public function getTagihanByid_bulanan($id_tagihan){
        $build = $this->db->table('pembayaran');
        $build->join('tagihan_bulanan', 'tagihan_bulanan.id_pembayaran = pembayaran.id_pembayaran');
        $build->join('siswa', 'siswa.nis = tagihan_bulanan.nis');
        $build->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        $build->where('id_tagihan', $id_tagihan);
        return $build->get();
    }

    public function updateTagihanBulanan($id_tagihan, $data){
        $build = $this->db->table('tagihan_bulanan');
        $build->where('id_tagihan', $id_tagihan);
        $build->update($data);
    }

    public function hapusTagihanBulanan($id_tagihan){
        $build = $this->db->table('tagihan_bulanan');
        $build->where('id_tagihan', $id_tagihan);
        $build->delete();
    }
    
    //--------------------------------------------------------------------
    // Mendapatkan Data Siswa By Nis / NISN / Nama Siswa
    //--------------------------------------------------------------------
    public function getSearchSiswa($result){
        $build = $this->db->table('siswa');
        $build->like('nama_siswa', $result);
        $build->orLike('nis', $result);
        $build->orLike('nisn', $result);
        return $build->get();
    }

    public function getSiswaBynisJoinKelas($nis){
        $build = $this->db->table('siswa');
        $build->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        $build->where('nis', $nis);
        return $build->get();
    }

    //--------------------------------------------------------------------
    // Mendapatkan Data Tagihan Bulanan By Nis / NISN / Nama Siswa
    //--------------------------------------------------------------------
    public function getTagihanBulananSiswa($nis){
        $build = $this->db->query("SELECT tagihan_bulanan.`nis`, nisn, nama_siswa, SUM(tag_jan + tag_feb + tag_mar + tag_apr + tag_mei + tag_jun + tag_jul + tag_agu + tag_sep + tag_okt + tag_nov + tag_des) AS total_tagihan,
        tahun_ajaran, nama_pembayaran, tagihan_bulanan.`id_tagihan`, nama_kelas FROM kelas INNER JOIN siswa ON siswa.`id_kelas` = kelas.`id_kelas` INNER JOIN tagihan_bulanan ON siswa.`nis` = tagihan_bulanan.`nis`
        INNER JOIN pembayaran ON tagihan_bulanan.`id_pembayaran` = pembayaran.`id_pembayaran` WHERE tagihan_bulanan.`nis`='$nis' GROUP BY tagihan_bulanan.`id_tagihan`");
        return $build;
    }

    public function getTagihanBulananSiswaDetail($id_tagihan){
        $build = $this->db->table('transaksi_bulanan');
        $build->selectSum('total_bayar');
        $build->where('id_tagihan', $id_tagihan);

        foreach ($build->get()->getResult() as $x):
            return $x->total_bayar;
        endforeach;
    }

    public function getTagihanBebasSiswaDetail($id_tagihan){
        $build = $this->db->table('transaksi_bebas');
        $build->selectSum('total_bayar');
        $build->where('id_tagihan', $id_tagihan);

        foreach ($build->get()->getResult() as $x):
            return $x->total_bayar;
        endforeach;
    }

    
    public function getJumlahTagihanBebas($id_tagihan){
        $build = $this->db->table('tagihan_bebas');
        $build->where('id_tagihan', $id_tagihan);
        foreach ($build->get()->getResult() as $x):
            return $x->total_tagihan;
        endforeach;
    }

    public function getTagihanBebasSiswa($nis){
        $build = $this->db->query("SELECT nis, SUM(total_bayar) AS total_bayar, tahun_ajaran, nama_pembayaran, total_tagihan, tagihan_bebas.`id_tagihan` AS id_tagihan
        FROM pembayaran INNER JOIN tagihan_bebas ON pembayaran.`id_pembayaran` = tagihan_bebas.`id_pembayaran` LEFT JOIN transaksi_bebas ON 
        tagihan_bebas.`id_tagihan` = transaksi_bebas.`id_tagihan` WHERE nis='$nis' GROUP BY tagihan_bebas.`id_tagihan`;");
        
        return $build;
    }

    public function getInformasiTagihanBulanan($id_tagihan){
        $build = $this->db->query("SELECT tagihan_bulanan.`nis`, nisn, no_hp, nama_siswa, SUM(tag_jan + tag_feb + tag_mar + tag_apr + tag_mei + tag_jun + tag_jul + tag_agu + tag_sep + tag_okt + tag_nov + tag_des) AS total_tagihan,
        tahun_ajaran, nama_pembayaran, tagihan_bulanan.`id_tagihan`, nama_kelas FROM kelas INNER JOIN siswa ON siswa.`id_kelas` = kelas.`id_kelas` INNER JOIN tagihan_bulanan ON siswa.`nis` = tagihan_bulanan.`nis`
        INNER JOIN pembayaran ON tagihan_bulanan.`id_pembayaran` = pembayaran.`id_pembayaran` WHERE id_tagihan = '$id_tagihan' GROUP BY tagihan_bulanan.`id_tagihan`");

        return $build;
    }

    public function getDataTagihanBulanan($id_tagihan){
        $build = $this->db->table('tagihan_bulanan');
        $build->where('id_tagihan', $id_tagihan);
        return $build->get();
    }

    public function getDetailTagihanBulanan($id_tagihan, $bulan_start){
        $build = $this->db->query("SELECT *FROM transaksi_bulanan WHERE id_tagihan='$id_tagihan' AND bulan='$bulan_start'");

        if(empty($build->getResult())){

            return array(
                null,
                null
            );

        }else{

            foreach ($build->getResult() as $x):
                return array(
                    $x->tipe_pembayaran,
                    $x->tgl
                ); 
            endforeach;

        }
    }

    public function bayartagihanbulanan($data){
        $build = $this->db->table('transaksi_bulanan');
        $build->insert($data);
    }

    public function batalbayartagihanbulanan($id_tagihan, $bulan_start){
        $build = $this->db->table('transaksi_bulanan');
        $build->where('id_tagihan', $id_tagihan);
        $build->where('bulan', $bulan_start);
        $build->delete();
    }

    public function getInformasiTagihanBebas($id_tagihan){
        $build = $this->db->table('kelas');
        $build->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
        $build->join('tagihan_bebas', 'tagihan_bebas.nis = siswa.nis');
        $build->join('pembayaran', 'pembayaran.id_pembayaran = tagihan_bebas.id_pembayaran');
        $build->where('id_tagihan', $id_tagihan);
        return $build->get();
    }

    public function getDataTagihanBebas($id_tagihan){
        $build = $this->db->table('tagihan_bebas');
        $build->select('tagihan_bebas.id_tagihan, nis, id_pembayaran, total_tagihan, id_transaksi, tipe_pembayaran, tgl, status_bayar, total_bayar');
        $build->join('transaksi_bebas', 'tagihan_bebas.id_tagihan = transaksi_bebas.id_tagihan', 'LEFT');
        $build->where('tagihan_bebas.id_tagihan', $id_tagihan);
        $build->orderBy('id_transaksi', "DESC");
        return $build->get();
    }

    public function bayartagihanbebas($data){
        $build = $this->db->table('transaksi_bebas');
        $build->insert($data);
    }

    public function batalbayartagihanbebas($id_transaksi){
        $build = $this->db->table('transaksi_bebas');
        $build->where('id_transaksi', $id_transaksi);
        $build->delete();
    }

    public function getTagihanBulananMultiBayar($id_tagihan){
        $build = $this->db->table('pembayaran');
        $build->join('tagihan_bulanan', 'tagihan_bulanan.id_pembayaran = pembayaran.id_pembayaran');
        $build->whereIn('id_tagihan', $id_tagihan);
        return $build->get();
    }

    public function getTagihanBebasMultibayar($id_tagihan){
        $build = $this->db->table('pembayaran');
        $build->join('tagihan_bebas', 'tagihan_bebas.id_pembayaran = pembayaran.id_pembayaran');
        $build->whereIn('id_tagihan', $id_tagihan);
        return $build->get();
    }

    public function bayarTagihanBulananMulti($id_tagihan, $data, $tipe_pembayaran){
        $build = $this->db->table('multi_bulanan');
        $build->insert($data);
        //------------------------------
        $build = $this->db->table('transaksi_bulanan');
        $build->where('id_tagihan', $id_tagihan);
        $build->delete();
        //------------------------------
        $data = array(
            'sta_jan' => "Y",
            'sta_feb' => "Y",
            'sta_mar' => "Y",
            'sta_apr' => "Y",
            'sta_mei' => "Y",
            'sta_jun' => "Y",
            'sta_jul' => "Y",
            'sta_agu' => "Y",
            'sta_sep' => "Y",
            'sta_okt' => "Y",
            'sta_nov' => "Y",
            'sta_des' => "Y"
        );

        $build = $this->db->table('tagihan_bulanan');
        $build->where('id_tagihan', $id_tagihan);
        $build->update($data);
        //------------------------------
        $build = $this->db->table('tagihan_bulanan');
        $build->where('id_tagihan', $id_tagihan);
        
        foreach ($build->get()->getResult() as $x):
            $data = array(
                'tipe_pembayaran' => $tipe_pembayaran,
                'tgl' => date('Y-m-d'),
                'id_tagihan' => $x->id_tagihan,
                'total_bayar' => $x->tag_jan,
                'bulan' => 'jan'
            );

            $this->bayartagihanbulanan($data);

            $data = array(
                'tipe_pembayaran' => $tipe_pembayaran,
                'tgl' => date('Y-m-d'),
                'id_tagihan' => $x->id_tagihan,
                'total_bayar' => $x->tag_feb,
                'bulan' => 'feb'
            );

            $this->bayartagihanbulanan($data);

            $data = array(
                'tipe_pembayaran' => $tipe_pembayaran,
                'tgl' => date('Y-m-d'),
                'id_tagihan' => $x->id_tagihan,
                'total_bayar' => $x->tag_mar,
                'bulan' => 'mar'
            );

            $this->bayartagihanbulanan($data);

            $data = array(
                'tipe_pembayaran' => $tipe_pembayaran,
                'tgl' => date('Y-m-d'),
                'id_tagihan' => $x->id_tagihan,
                'total_bayar' => $x->tag_apr,
                'bulan' => 'apr'
            );

            $this->bayartagihanbulanan($data);

            $data = array(
                'tipe_pembayaran' => $tipe_pembayaran,
                'tgl' => date('Y-m-d'),
                'id_tagihan' => $x->id_tagihan,
                'total_bayar' => $x->tag_mei,
                'bulan' => 'mei'
            );

            $this->bayartagihanbulanan($data);

            $data = array(
                'tipe_pembayaran' => $tipe_pembayaran,
                'tgl' => date('Y-m-d'),
                'id_tagihan' => $x->id_tagihan,
                'total_bayar' => $x->tag_jun,
                'bulan' => 'jun'
            );

            $this->bayartagihanbulanan($data);

            $data = array(
                'tipe_pembayaran' => $tipe_pembayaran,
                'tgl' => date('Y-m-d'),
                'id_tagihan' => $x->id_tagihan,
                'total_bayar' => $x->tag_jul,
                'bulan' => 'jul'
            );

            $this->bayartagihanbulanan($data);

            $data = array(
                'tipe_pembayaran' => $tipe_pembayaran,
                'tgl' => date('Y-m-d'),
                'id_tagihan' => $x->id_tagihan,
                'total_bayar' => $x->tag_agu,
                'bulan' => 'agu'
            );

            $this->bayartagihanbulanan($data);

            $data = array(
                'tipe_pembayaran' => $tipe_pembayaran,
                'tgl' => date('Y-m-d'),
                'id_tagihan' => $x->id_tagihan,
                'total_bayar' => $x->tag_sep,
                'bulan' => 'sep'
            );

            $this->bayartagihanbulanan($data);

            $data = array(
                'tipe_pembayaran' => $tipe_pembayaran,
                'tgl' => date('Y-m-d'),
                'id_tagihan' => $x->id_tagihan,
                'total_bayar' => $x->tag_okt,
                'bulan' => 'okt'
            );

            $this->bayartagihanbulanan($data);

            $data = array(
                'tipe_pembayaran' => $tipe_pembayaran,
                'tgl' => date('Y-m-d'),
                'id_tagihan' => $x->id_tagihan,
                'total_bayar' => $x->tag_nov,
                'bulan' => 'nov'
            );

            $this->bayartagihanbulanan($data);

            $data = array(
                'tipe_pembayaran' => $tipe_pembayaran,
                'tgl' => date('Y-m-d'),
                'id_tagihan' => $x->id_tagihan,
                'total_bayar' => $x->tag_des,
                'bulan' => 'des'
            );

            $this->bayartagihanbulanan($data);

        endforeach;
    }

    public function bayarTagihanBebasMulti($id_tagihan, $data, $tipe_pembayaran, $total_bayar){
        $build = $this->db->table('multi_bebas');
        $build->insert($data);
        //------------------------------------
        $build = $this->db->table('transaksi_bebas');
        $build->where('id_tagihan', $id_tagihan);
        $build->delete();
        //--------------------------------------
        $data = array(
            'id_tagihan' => $id_tagihan,
            'tgl' => date('Y-m-d'),
            'tipe_pembayaran' => $tipe_pembayaran,
            'status_bayar' => "lunas",
            'total_bayar' => $total_bayar
        );

        $this->bayartagihanbebas($data);

    }

    public function getRiwayatTagihanMulti_Left($nis){
        $build = $this->db->table('multi_bebas');
        $build->select('multi_bebas.nis, multi_bebas.id_tagihan, multi_bebas.harus_dibayar, multi_bebas.tgl, multi_bebas.kd_tagihan');
        $build->join('multi_bulanan', 'multi_bebas.kd_tagihan = multi_bulanan.kd_tagihan', 'LEFT');
        $build->where('multi_bulanan.nis');
        $build->where('multi_bebas.nis', $nis);
        $build->groupBy('multi_bebas.kd_tagihan');
        $build->orderBy('multi_bebas.id', "DESC");
        return $build->get();
    }

    public function getRiwayatTagihanMulti_Right($nis){
        $build = $this->db->table('multi_bebas');
        $build->select('multi_bulanan.nis, multi_bulanan.id_tagihan, multi_bulanan.harus_dibayar, multi_bulanan.tgl, multi_bulanan.kd_tagihan');
        $build->join('multi_bulanan', 'multi_bebas.kd_tagihan = multi_bulanan.kd_tagihan', 'RIGHT');
        $build->where('multi_bebas.nis');
        $build->where('multi_bulanan.nis', $nis);
        $build->groupBy('multi_bulanan.kd_tagihan');
        $build->orderBy('multi_bulanan.id', "DESC");
        return $build->get();
    }

    public function getRiwayatTagihanMulti_Inner($nis){
        $build = $this->db->table('multi_bebas');
        $build->join('multi_bulanan', 'multi_bebas.kd_tagihan = multi_bulanan.kd_tagihan');
        $build->where('multi_bebas.nis', $nis);
        $build->groupBy('multi_bebas.kd_tagihan');
        $build->orderBy('multi_bebas.id', "DESC");
        return $build->get();
    }

    public function getDetailMultiBebas($kd_tagihan){
        $build = $this->db->table('multi_bebas');
        $build->join('tagihan_bebas', 'multi_bebas.id_tagihan = tagihan_bebas.id_tagihan');
        $build->join('pembayaran', 'pembayaran.id_pembayaran = tagihan_bebas.id_pembayaran');
        $build->where('kd_tagihan', $kd_tagihan);
        return $build->get();
    }

    public function getDetailMultiBulanan($kd_tagihan){
        $build = $this->db->table('multi_bulanan');
        $build->join('tagihan_bulanan', 'multi_bulanan.id_tagihan = tagihan_bulanan.id_tagihan');
        $build->join('pembayaran', 'pembayaran.id_pembayaran = tagihan_bulanan.id_pembayaran');
        $build->where('kd_tagihan', $kd_tagihan);
        return $build->get();
    }

    public function hapustagihanMulti($kd_tagihan){
        $build = $this->db->table('multi_bulanan');
        $build->where('kd_tagihan', $kd_tagihan);
        $build->delete();

        $build = $this->db->table('multi_bebas');
        $build->where('kd_tagihan', $kd_tagihan);
        $build->delete();
    }

    public function getDataTransaksiBebasPerTransaksi($id_transaksi){
        $build = $this->db->table('transaksi_bebas');
        $build->join('tagihan_bebas', 'tagihan_bebas.id_tagihan = transaksi_bebas.id_tagihan');
        $build->where('id_transaksi', $id_transaksi);
        return $build->get();
    }

    public function getDataTransaksiBulananPerTransaksi($id_tagihan, $bulan_start){
        $build = $this->db->table('transaksi_bulanan');
        $build->join('tagihan_bulanan', 'tagihan_bulanan.id_tagihan = transaksi_bulanan.id_tagihan');
        $build->where('transaksi_bulanan.id_tagihan', $id_tagihan);
        $build->where('bulan', $bulan_start);
        return $build->get();
    }

    public function getPembayaranBulanan(){
        $build = $this->db->table('pembayaran');
        $build->where('tipe_pembayaran', "bulanan");
        return $build->get();
    }

    public function getDataPembayaranBulanan($id_kelas, $tahun_ajaran, $id_pembayaran){
        $build = $this->db->table('pembayaran');
        $build->join('tagihan_bulanan', 'tagihan_bulanan.id_pembayaran = pembayaran.id_pembayaran');
        $build->join('siswa', 'siswa.nis = tagihan_bulanan.nis');
        $build->where('tahun_ajaran', $tahun_ajaran);
        $build->where('id_kelas', $id_kelas);
        $build->where('pembayaran.id_pembayaran', $id_pembayaran);
        return $build->get();
    }

    public function cekdatabulanan_rasio($start, $finish, $id_tagihan, $bulan_start){
        $build = $this->db->table('transaksi_bulanan');
        $build->where('id_tagihan', $id_tagihan);
        $build->where('bulan', $bulan_start);
        $build->where('transaksi_bulanan.tgl BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($finish)).'"');

        foreach ($build->get()->getResult() as $x):
            return $x->total_bayar;
        endforeach;
    }


    public function getDetailPembayaranBulanan($id_tagihan, $bulan_start, $start, $finish){
        $build = $this->db->table('transaksi_bulanan');
        $build->where('id_tagihan', $id_tagihan);
        $build->where('bulan', $bulan_start);
        $build->where('transaksi_bulanan.tgl BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($finish)).'"');

        foreach ($build->get()->getResult() as $x):
            return date("d-m-Y", strtotime($x->tgl));
        endforeach;
    }

    public function getPembayaranBebas(){
        $build = $this->db->table('pembayaran');
        $build->where('tipe_pembayaran', "bebas");
        return $build->get();
    }

    public function getPembayaranBebasBykelas($id_kelas, $tahun_ajaran, $id_pembayaran){
        $build = $this->db->table('siswa');
        $build->join('tagihan_bebas', "siswa.nis= tagihan_bebas.nis");
        $build->join('pembayaran', "pembayaran.id_pembayaran= tagihan_bebas.id_pembayaran");
        $build->where('id_kelas', $id_kelas);
        $build->where('tahun_ajaran', $tahun_ajaran);
        $build->where('tagihan_bebas.id_pembayaran', $id_pembayaran);
        return $build->get();

    }

    public function getDetailPembayaranBebas($id_tagihan){
        $build = $this->db->table('transaksi_bebas');
        $build->selectSum('total_bayar', 'total_bayar');
        $build->where('id_tagihan', $id_tagihan);
        $build->groupBy('id_tagihan');
        foreach ($build->get()->getResult() as $x):
            return $x->total_bayar;
        endforeach;
    }

    //tambahan 27 / 06 / 2021

    public function getRekapBebas($id_kelas, $id_pembayaran, $tahun_ajaran, $start, $finish){
        $build = $this->db->table('siswa');
        $build->selectSum('total_bayar', "total_tagihan");
        $build->join('tagihan_bebas', 'tagihan_bebas.nis = siswa.nis');
        $build->join('pembayaran', 'pembayaran.id_pembayaran = tagihan_bebas.id_pembayaran');
        $build->join('transaksi_bebas', 'tagihan_bebas.id_tagihan = transaksi_bebas.id_tagihan');
        $build->where('id_kelas', $id_kelas);
        $build->where('tagihan_bebas.id_pembayaran', $id_pembayaran);
        $build->where('tahun_ajaran', $tahun_ajaran);
        $build->where('transaksi_bebas.tgl BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($finish)).'"');
        $build->groupBy('siswa.id_kelas');

        foreach ($build->get()->getResult() as $x):
            return $x->total_tagihan;
        endforeach;
        
    }

    public function getRekapBulanan($id_kelas, $id_pembayaran, $tahun_ajaran, $start, $finish){

        $build = $this->db->table('siswa');
        $build->selectSum('total_bayar', "total_tagihan");
        $build->join('tagihan_bulanan', 'tagihan_bulanan.nis = siswa.nis');
        $build->join('pembayaran', 'pembayaran.id_pembayaran = tagihan_bulanan.id_pembayaran');
        $build->join('transaksi_bulanan', 'tagihan_bulanan.id_tagihan = transaksi_bulanan.id_tagihan');
        $build->where('id_kelas', $id_kelas);
        $build->where('tagihan_bulanan.id_pembayaran', $id_pembayaran);
        $build->where('tahun_ajaran', $tahun_ajaran);
        $build->where('transaksi_bulanan.tgl BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($finish)).'"');
        $build->groupBy('siswa.id_kelas');

        foreach ($build->get()->getResult() as $x):
            return $x->total_tagihan;
        endforeach;

    }

    public function getRekapBebasDetail($id_kelas, $id_pembayaran, $tahun_ajaran, $start, $finish){
        $build = $this->db->table('siswa');
        $build->select('transaksi_bebas.tgl, nama_siswa, total_bayar');
        $build->join('tagihan_bebas', 'tagihan_bebas.nis = siswa.nis');
        $build->join('pembayaran', 'pembayaran.id_pembayaran = tagihan_bebas.id_pembayaran');
        $build->join('transaksi_bebas', 'tagihan_bebas.id_tagihan = transaksi_bebas.id_tagihan');
        $build->where('id_kelas', $id_kelas);
        $build->where('tagihan_bebas.id_pembayaran', $id_pembayaran);
        $build->where('tahun_ajaran', $tahun_ajaran);
        $build->where('transaksi_bebas.tgl BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($finish)).'"');
        $build->orderBy('transaksi_bebas.tgl', "DESC");
        return $build->get();
    }

    public function getRekapBulananDetail($id_kelas, $id_pembayaran, $tahun_ajaran, $start, $finish){
        $build = $this->db->table('siswa');
        $build->select('transaksi_bulanan.tgl, nama_siswa, total_bayar');
        $build->join('tagihan_bulanan', 'tagihan_bulanan.nis = siswa.nis');
        $build->join('pembayaran', 'pembayaran.id_pembayaran = tagihan_bulanan.id_pembayaran');
        $build->join('transaksi_bulanan', 'tagihan_bulanan.id_tagihan = transaksi_bulanan.id_tagihan');
        $build->where('id_kelas', $id_kelas);
        $build->where('tagihan_bulanan.id_pembayaran', $id_pembayaran);
        $build->where('tahun_ajaran', $tahun_ajaran);
        $build->where('transaksi_bulanan.tgl BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($finish)).'"');
        $build->orderBy('transaksi_bulanan.tgl', "DESC");
        return $build->get();
    }

    public function getNamaKelas($id){
        $build = $this->db->table('kelas');
        $build->where('id_kelas', $id);
        foreach ($build->get()->getResult() as $x):
            return $x->nama_kelas;
        endforeach;
    }

    public function getPembayaranBebasByTahunAjaran($tahun_ajaran){
        $build = $this->db->table('pembayaran');
        $build->where('tahun_ajaran', $tahun_ajaran);
        $build->where('tipe_pembayaran', "bebas");
        return $build->get();
        
    }

    public function getPembayaranBulananByTahunAjaran($tahun_ajaran){
        $build = $this->db->table('pembayaran');
        $build->where('tahun_ajaran', $tahun_ajaran);
        $build->where('tipe_pembayaran', "bulanan");
        return $build->get();
        
    }

    public function detailPembayaranBulanan($nis, $id_pembayaran, $start, $finish){
        $total_bayar = 0;
        $total_tagihan = 0;
        $build = $this->db->table('tagihan_bulanan');
        $build->selectSum('total_bayar', 'total_bayar');
        $build->join('transaksi_bulanan', 'transaksi_bulanan.id_tagihan = tagihan_bulanan.id_tagihan');
        $build->where('nis', $nis);
        $build->where('id_pembayaran', $id_pembayaran);
        $build->where('transaksi_bulanan.tgl BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($finish)).'"');
        $build->groupBy('transaksi_bulanan.id_tagihan');

        foreach ($build->get()->getResult() as $x):
            $total_bayar = $x->total_bayar;
        endforeach;

        $build = $this->db->query("SELECT SUM(tag_jan + tag_feb + tag_mar + tag_apr + tag_mei + tag_jun + tag_jul + tag_agu + tag_sep + tag_okt + tag_nov + tag_des) AS total_tagihan
        FROM tagihan_bulanan WHERE id_pembayaran = '$id_pembayaran' AND nis = '$nis' GROUP BY id_tagihan");

        foreach ($build->getResult() as $x):

            $total_tagihan = $x->total_tagihan;

        endforeach;

        $build = $this->db->query("SELECT *FROM tagihan_bulanan WHERE id_pembayaran = '$id_pembayaran' AND nis = '$nis'");

        $bulan_start = "";
        $bulan_finish = "";

        foreach ($build->getResult() as $x):

            if($x->sta_jul == 'N'){

                $bulan_start = "Jul";

            }else if($x->sta_agu == "N"){

                $bulan_start = "Agu";

            }else if($x->sta_sep == "N"){

                $bulan_start = "Sep";

            }else if($x->sta_okt == "N"){

                $bulan_start = "Okt";

            }else if($x->sta_nov == "N"){

                $bulan_start = "Nov";

            }else if($x->sta_des == "N"){

                $bulan_start = "Des";

            }else if($x->sta_jan == "N"){

                $bulan_start = "Jan";

            }else if($x->sta_feb == "N"){

                $bulan_start = "Feb";

            }else if($x->sta_mar== "N"){

                $bulan_start = "Mar";

            }else if($x->sta_apr == "N"){

                $bulan_start = "Apr";

            }else if($x->sta_mei == "N"){

                $bulan_start = "Mei";

            }else if($x->sta_jun == "N"){

                $bulan_start = "Jun";

            }else{

                $bulan_start = "Lunas";

            }

        endforeach;

        $build = $this->db->query("SELECT *FROM tagihan_bulanan WHERE id_pembayaran = '$id_pembayaran' AND nis = '$nis'");

        foreach ($build->getResult() as $x):

            if($x->sta_jun == "N"){

                $bulan_finish = "Juni";

            }else if($x->sta_mei == "N"){

                $bulan_finish = "Mei";

            }else if($x->sta_apr == "N"){

                $bulan_finish = "Apr";

            }else if($x->sta_mar == "N"){

                $bulan_finish = "Mar";

            }else if($x->sta_feb == "N"){

                $bulan_finish = "Feb";

            }else if($x->sta_jan == "N"){

                $bulan_finish = "Jan";

            }else if($x->sta_des == "N"){

                $bulan_finish = "Des";

            }else if($x->sta_nov == "N"){

                $bulan_finish = "Nov";

            }else if($x->sta_okt== "N"){

                $bulan_finish = "Okt";

            }else if($x->sta_sep == "N"){

                $bulan_finish = "Sep";

            }else if($x->sta_agu == "N"){

                $bulan_finish = "Agu";

            }else if($x->sta_jul == "N"){

                $bulan_finish = "Jul";

            }else{

                $bulan_start = "Lunas";

            }

        endforeach;


        $data = array(
            'total_tagihan' => $total_tagihan,
            'total_bayar' => $total_bayar,
            'bulan_start' => $bulan_start,
            'bulan_finish' => $bulan_finish
        );

        return $data;

    }

    public function detailPembayaranbebas($nis, $id_pembayaran, $start, $finish){
        $total_bayar = 0;
        $total_tagihan = 0;

        $build = $this->db->table('tagihan_bebas');
        $build->selectSum('total_bayar', 'total_bayar');
        $build->join('transaksi_bebas', 'transaksi_bebas.id_tagihan = tagihan_bebas.id_tagihan');
        $build->where('nis', $nis);
        $build->where('id_pembayaran', $id_pembayaran);
        $build->where('transaksi_bebas.tgl BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($finish)).'"');
        $build->groupBy('transaksi_bebas.id_tagihan');

        foreach ($build->get()->getResult() as $x):

            $total_bayar = $x->total_bayar;

        endforeach;

        $build = $this->db->table('tagihan_bebas');
        $build->where('id_pembayaran', $id_pembayaran);
        $build->where('nis', $nis);

        foreach ($build->get()->getResult() as $x):
            $total_tagihan = $x->total_tagihan;
        endforeach;

        $data = array(
            'total_bayar' => $total_bayar,
            'total_tagihan' => $total_tagihan
        );

        return $data;
    }

    public function getpemasukanbebas($start, $finish){
        $build = $this->db->table('pembayaran');
        $build->join('tagihan_bebas', 'pembayaran.id_pembayaran = tagihan_bebas.id_pembayaran');
        $build->join('transaksi_bebas', 'tagihan_bebas.id_tagihan = transaksi_bebas.id_tagihan');
        $build->where('transaksi_bebas.tgl BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($finish)).'"');
        return $build->get();
    }

    public function getpemasukanbulanan($start, $finish){
        $build = $this->db->table('pembayaran');
        $build->join('tagihan_bulanan', 'pembayaran.id_pembayaran = tagihan_bulanan.id_pembayaran');
        $build->join('transaksi_bulanan', 'tagihan_bulanan.id_tagihan = transaksi_bulanan.id_tagihan');
        $build->where('transaksi_bulanan.tgl BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($finish)).'"');
        return $build->get();
    }

    // Tambahan Baru 31 mei 2021

    public function HapusTagihanBulananGlobal($nis, $id_pembayaran){
        $build = $this->db->table('tagihan_bulanan');
        $build->where('id_pembayaran', $id_pembayaran);
        $build->where('nis', $nis);
        $build->delete();
    }

    public function HapusTagihanBebasGlobal($nis, $id_pembayaran){
        $build = $this->db->table('tagihan_bebas');
        $build->where('id_pembayaran', $id_pembayaran);
        $build->where('nis', $nis);
        $build->delete();
    }

    public function TotalBayarTagihanBulanan($nis, $id_pembayaran){
        $build = $this->db->table('tagihan_bulanan');
        $build->selectSum('total_bayar', 'total_bayar');
        $build->join('transaksi_bulanan', 'transaksi_bulanan.id_tagihan = tagihan_bulanan.id_tagihan');
        $build->where('nis', $nis);
        $build->where('id_pembayaran', $id_pembayaran);
        $build->groupBy('transaksi_bulanan.id_tagihan');
        foreach ($build->get()->getResult() as $x):
            return $x->total_bayar;
        endforeach;
    }

    public function LastTransaksiTagihanBulanan($nis, $id_pembayaran){
        $build = $this->db->table('tagihan_bulanan');
        $build->selectMax('transaksi_bulanan.tgl', 'tgl');
        $build->join('transaksi_bulanan', 'transaksi_bulanan.id_tagihan = tagihan_bulanan.id_tagihan');
        $build->where('nis', $nis);
        $build->where('id_pembayaran', $id_pembayaran);
        foreach ($build->get()->getResult() as $x):
            return $x->tgl;
        endforeach;
    }

    public function LastTransaksiTagihanBebas($nis, $id_pembayaran){
        $build = $this->db->table('tagihan_bebas');
        $build->selectMax('transaksi_bebas.tgl', 'tgl');
        $build->join('transaksi_bebas', 'transaksi_bebas.id_tagihan = tagihan_bebas.id_tagihan');
        $build->where('nis', $nis);
        $build->where('id_pembayaran', $id_pembayaran);
        foreach ($build->get()->getResult() as $x):
            return $x->tgl;
        endforeach;
    }

    public function TotalBayarTagihanBebas($nis, $id_pembayaran){
        $build = $this->db->table('tagihan_bebas');
        $build->selectSum('total_bayar', 'total_bayar');
        $build->join('transaksi_bebas', 'transaksi_bebas.id_tagihan = tagihan_bebas.id_tagihan');
        $build->where('nis', $nis);
        $build->where('id_pembayaran', $id_pembayaran);
        $build->groupBy('transaksi_bebas.id_tagihan');
        foreach ($build->get()->getResult() as $x):
            return $x->total_bayar;
        endforeach;
    }


    public function getTagihanBebas(){
        $build = $this->db->table('tagihan_bebas');
        $build->join('siswa', 'siswa.nis = tagihan_bebas.nis');
        return $build->get();
    }

    public function getBayarBebas($nis, $start, $finish){
        $build = $this->db->table('tagihan_bebas');
        $build->selectSum('total_bayar', 'total_bayar');
        $build->join('transaksi_bebas', 'tagihan_bebas.id_tagihan = transaksi_bebas.id_tagihan');
        $build->where('nis', $nis);
        $build->where('transaksi_bebas.tgl BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($finish)).'"');
        foreach ($build->get()->getResult() as $x):
            return $x->total_bayar;
        endforeach;
    }

    public function getTagihanBulanan(){
        $build = $this->db->table('tagihan_bulanan');
        $build->join('siswa', 'siswa.nis = tagihan_bulanan.nis');
        return $build->get();
    }

    public function getBayarBulanan($nis, $start, $finish){
        $build = $this->db->table('tagihan_bulanan');
        $build->selectSum('total_bayar', 'total_bayar');
        $build->join('transaksi_bulanan', 'tagihan_bulanan.id_tagihan = transaksi_bulanan.id_tagihan');
        $build->where('nis', $nis);
        $build->where('transaksi_bulanan.tgl BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($finish)).'"');
        foreach ($build->get()->getResult() as $x):
            return $x->total_bayar;
        endforeach;
    }


    public function getDataTagihan_bulanBynis($nis){
        $build = $this->db->table('siswa');
        $build->join('tagihan_bulanan', 'siswa.nis=tagihan_bulanan.nis');
        $build->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        $build->where('siswa.nis', $nis);
        return $build->get();
    }

}
?>