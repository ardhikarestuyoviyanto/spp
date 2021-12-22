<?php
namespace App\Controllers;
use App\Models\ModelAdmin;
use Twilio\Rest\Client;
use App\Models\ModelManajemen;
use Exception;

class Admin extends BaseController{

    public function __construct(){
        view_cell('App\Libraries\Widget::footer', ['footer' => "ardhikayoviyanto@gmail.com"]);
    }

    public function home(){
        view_cell('App\Libraries\Widget::title', ['title'=>"Selamat Datang Admin"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Dashboard"]);

        $model = new ModelManajemen();

        $data = array(
            'data_sekolah' => $model->getSekolah()->getResult(),
            'user_aktif' => $model->getUserAktif(),
            'siswa_aktif' => $model->getSiswaAktif(),
            'siswa_lulus' => $model->getSiswaLulus(),
            'pemasukan' => $model->pemasukan()
        );

        echo view('admin/home/homepage.php', $data);
    }

    // ---------------------------------------------------------------------------------------------------------------
    // Controller Tahun ajaran
    //----------------------------------------------------------------------------------------------------------------

    public function tahunajar(){
        view_cell('App\Libraries\Widget::title', ['title'=>"Tahun Ajaran - Master Data"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Tahun Ajaran"]);
        $model = new ModelAdmin();
        $data = array(
            'data' => $model->getTahunajar()->getResult()
        );
        echo view('admin/home/tahunajar', $data);
    }

    public function tambahtahunajar(){
        view_cell('App\Libraries\Widget::title', ['title'=>"Tambah Tahun Ajaran - Master Data"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Tahun Ajaran"]);

        echo view('admin/home/tambahtahunajar');
    }

    public function tambahtahunajar_action(){
        $model = new ModelAdmin();
        $request = \Config\Services::request();
        
        if($request->isAJAX()){

            $data = array(
                'tahun_ajaran' => $request->getPost('tahun_ajaran')
            );

            if($model->getahunajarbytahun($request->getPost('tahun_ajaran')) == 0){

                $model->simpantahunajar($data);

                echo json_encode('Tahun Ajar Baru Berhasil disimpan');

            }else{

                echo json_encode('Ups, tahun ajaran yang anda masukkan sudah ada');

            }

        }

    }

    public function edittahunajar(){
        $model = new ModelAdmin();
        $request = \Config\Services::request();

        view_cell('App\Libraries\Widget::title', ['title'=>"Edit Tahun Ajaran - Master Data"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Tahun Ajaran"]);

        if(!empty($request->uri->getSegment(3))){

            $data = array(
                'data' => $model->getTahunajarbyid($request->uri->getSegment(3))->getResult()
            );

            echo view('admin/home/edittahunajar', $data);

        }else{

            $this->tahunajar();

        }

    }

    public function edittahunajar_action(){
        $model = new ModelAdmin();
        $request = \Config\Services::request();

        if($request->isAJAX()){

            $data = array(
                'tahun_ajaran' => $request->getPost('tahun_ajaran'),
                'status_tahunajar' => $request->getPost('status_tahunajar')
            );
    
            $model->edittahunajar($request->getPost('id'), $data);

            echo json_encode('Tahun Ajar Baru Berhasil diperbaruhi');

        }

    }

    public function hapustahunajar(){
        $model = new ModelAdmin();
        $request = \Config\Services::request();
        $model->hapusTahunajar($request->uri->getSegment(3));
        $this->tahunajar();
    }

    // ---------------------------------------------------------------------------------------------------------------
    // Controller Data Siswa
    //----------------------------------------------------------------------------------------------------------------

    public function datasiswa(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Data Siswa - Master Data"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Data Siswa"]);

        $model = new ModelAdmin();

        if(isset($_GET['status']) && isset($_GET['kelas'])){

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'siswa' => $model->Filtersiswa($_GET['status'], urldecode($_GET['kelas']))->getResult()
            );

        }else{

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'siswa' => $model->getSiswa()->getResult()
    
            );

        }

        echo view('admin/masterdata/datasiswa', $data);

    }

    public function tambahsiswa(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Tambah Siswa - Master Data"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Data Siswa"]);

        $model = new ModelAdmin();

        $data = array(
            'kelas' => $model->getKelas()->getResult(),
        );

        echo view('admin/masterdata/tambahsiswa', $data);

    }

    public function editsiswa(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Edit Siswa - Master Data"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Data Siswa"]);

        $model = new ModelAdmin();
        $request = \Config\Services::request();

        $data = array(
            'data' => $model->getSiswaByNis($request->uri->getSegment(3))->getResult(),
            'kelas' => $model->getKelas()->getResult()
        );

        echo view('admin/masterdata/editsiswa', $data);

    }

    public function hapussiswa(){

        $model = new ModelAdmin();
        $request = \Config\Services::request();
        $model->hapussiswa($request->uri->getSegment(3));
        return redirect('admin/datasiswa');
    }

    public function tambahsiswa_action(){

        $model = new ModelAdmin();
        $request = \Config\Services::request();

        if(empty($model->getSiswaByNis($request->getPost('nis'))->getResult())){

            $data = array(
                'nis' => $request->getPost('nis'),
                'nisn' => $request->getPost('nisn'),
                'nama_siswa' => $request->getPost('nama_siswa'),
                'jenis_kelamin' => $request->getPost('jenis_kelamin'),
                'agama' => $request->getPost('agama'),
                'id_kelas' => $request->getPost('id_kelas'),
                'nama_ortu' => $request->getPost('nama_ortu'),
                'no_hp' => $request->getPost('no_hp'),
                'alamat' => $request->getPost('alamat'),
                'password' => password_hash($request->getPost('password'), PASSWORD_DEFAULT),
                'status' => "T"
            );
    
            $model->tambahsiswa($data);
    
            echo json_encode('Daata Berhasil Disimpan');

        }else{

            echo json_encode('Nisn Sudah digunakan');

        }
        

    }

    public function editsiswa_action(){

        $model = new ModelAdmin();
        $request = \Config\Services::request();

        if(!empty($request->getPost('password'))){

            $data = array('password' => password_hash($request->getPost('password'), PASSWORD_DEFAULT));

            $model->editsiswa($request->getPost('nis'), $data);

        }

        $data = array(
            'nisn' => $request->getPost('nisn'),
            'nama_siswa' => $request->getPost('nama_siswa'),
            'jenis_kelamin' => $request->getPost('jenis_kelamin'),
            'agama' => $request->getPost('agama'),
            'id_kelas' => $request->getPost('id_kelas'),
            'nama_ortu' => $request->getPost('nama_ortu'),
            'no_hp' => $request->getPost('no_hp'),
            'alamat' => $request->getPost('alamat'),
            'password' => password_hash($request->getPost('password'), PASSWORD_DEFAULT),
            'status' => $request->getPost('status')
        );

        $model->editsiswa($request->getPost('nis'), $data);

        echo json_encode('Akun Berhasil diupdate');

    }

    public function importdatasiswa(){

        $model = new ModelAdmin();

        require_once(APPPATH.'Libraries/Excel/vendor/autoload.php');

        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if(isset($_FILES['excel']['name']) && in_array($_FILES['excel']['type'], $file_mimes)) {
 
            $arr_file = explode('.', $_FILES['excel']['name']);
            $extension = end($arr_file);
         
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
         
            $spreadsheet = $reader->load($_FILES['excel']['tmp_name']);
             
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            
            for($i = 1;$i < count($sheetData);$i++){
                
                $data = array(

                    'nis' => $sheetData[$i]['1'],
                    'nisn' => $sheetData[$i]['2'],
                    'nama_siswa' => $sheetData[$i]['3'],
                    'jenis_kelamin' => $sheetData[$i]['4'],
                    'agama' => $sheetData[$i]['5'],
                    'id_kelas' => $sheetData[$i]['6'],
                    'nama_ortu' => $sheetData[$i]['7'],
                    'no_hp' => $sheetData[$i]['8'],
                    'alamat' => $sheetData[$i]['9'],
                    'password' => password_hash($sheetData[$i]['10'], PASSWORD_DEFAULT),
                    'status' => $sheetData[$i]['11'],

                );

                $model->tambahsiswa($data);

            }

            echo json_encode('Berhasil Import Data');

        }else{

            echo json_encode('Ekstensi File Salah (harus .xlsx)');

        }

    }

    // ---------------------------------------------------------------------------------------------------------------
    // Controller Data Kelas
    //----------------------------------------------------------------------------------------------------------------

    public function datakelas(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Data Kelas - Master Data"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Data Kelas"]);

        $model = new ModelAdmin();

        $data = array(
            'data' => $model->getKelas()->getResult()
        );

        echo view('admin/masterdata/datakelas', $data);

    }

    public function tambahkelas(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Tambah Kelas - Master Data"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Data Kelas"]);

        echo view('admin/masterdata/tambahkelas');

    }


    public function tambahkelas_action(){

        $model = new ModelAdmin();
        $request = \Config\Services::request();

        if($request->isAJAX()){

            $data = array(
                'nama_kelas' => $request->getPost('nama_kelas')
            );

            $model->tambahkelas($data);

            echo json_encode('Tambah Kelas Berhasil');

        }

    }

    public function editkelas(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Edit Kelas - Master Data"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Data Kelas"]);

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        if(!empty($request->uri->getSegment(3))){

            $data = array(
                'data' => $model->getKelasByid($request->uri->getSegment(3))->getResult()
            );

            echo view('admin/masterdata/editkelas', $data);

        }else{

            $this->datakelas();

        }

    }

    public function hapusKelas(){
        $model = new ModelAdmin();
        $request = \Config\Services::request();
        $model->hapuskelas($request->uri->getSegment(3));
        $this->datakelas();
    }

    public function editkelas_action(){

        $request = \Config\Services::request();
        $model = new ModelAdmin();   

        if($request->isAJAX()){

            $data = array(
                'nama_kelas' => $request->getPost('nama_kelas')
            );

            $model->editkelas($request->getPost('id'), $data);

            echo json_encode('Data Berhasil diperbaruhi');

        }

    }


    // ---------------------------------------------------------------------------------------------------------------
    // Controller Keuangan
    //----------------------------------------------------------------------------------------------------------------

    public function pos(){
        
        view_cell('App\Libraries\Widget::title', ['title'=>"Pos Bayar - Keuangan"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Pos Bayar"]);

        $model = new ModelAdmin();

        if(isset($_GET['tahun'])){

            if($_GET['tahun'] == "all"){

                $data = array(
                    'tahun_ajaran' => $model->getTahunajar()->getResult(),
                    'data' => $model->getpos()->getResult()
                );

            }else{

                $data = array(
                    'tahun_ajaran' => $model->getTahunajar()->getResult(),
                    'data' =>  $model->filterpos(urldecode($_GET['tahun']))->getResult()
                );

            }

        }else{

            $data = array(
                'tahun_ajaran' => $model->getTahunajar()->getResult(),
                'data' => $model->getpos()->getResult()
            );

        }

        echo view('admin/keuangan/pembayaran', $data);

    }

    public function tambahpos(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Tambah Pos - Keuangan"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Pos Bayar"]);

        $model = new ModelAdmin();

        $data = array(
            'tahun_ajaran' => $model->getTahunajar()->getResult()
        );

        echo view('admin/keuangan/tambahpos', $data);

    }

    public function tambahpos_action(){

        $model = new ModelAdmin();
        $request = \Config\Services::request();

        $data = array(
            'nama_pembayaran' => $request->getPost('nama_pembayaran'),
            'tanggal' => date('Y-m-d H:i:s'),
            'tahun_ajaran' => $request->getPost('tahun_ajaran'),
            'tipe_pembayaran' => $request->getPost('tipe_pembayaran')
        );

        $model->tambahpos($data);

        echo json_encode('Pembayaran Baru Berhasil Disimpan');

    }

    public function editpos(){

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        view_cell('App\Libraries\Widget::title', ['title'=>"Edit Pos - Keuangan"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Pos Bayar"]);

        $data = array(
            'data' => $model->getposByid($request->uri->getSegment(3))->getResult(),
            'tahun_ajaran' => $model->getTahunajar()->getResult()
        );

        echo view('admin/keuangan/editpos', $data);

    }

    public function editpos_action(){

        $model = new ModelAdmin();
        $request = \Config\Services::request();

        $data = array(
            'nama_pembayaran' => $request->getPost('nama_pembayaran'),
            'tahun_ajaran' => $request->getPost('tahun_ajaran'),
            'tipe_pembayaran' => $request->getPost('tipe_pembayaran')
        );

        $model->editpos($request->getPost('id_pembayaran'), $data);

        echo json_encode('Data Berhasil Diupdate');

    }

    public function hapuspos(){
        $model = new ModelAdmin();
        $request = \Config\Services::request();
        $model->hapuspos($request->uri->getSegment(3));
       
        return redirect('admin/pos');
    }

    // ---------------------------------------------------------------------------------------------------------------
    // Controller Pindah Kelas
    //----------------------------------------------------------------------------------------------------------------

    public function kenaikankelas(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Kenaikan Kelas - Master Data"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Kenaikan Kelas"]);

        $model = new ModelAdmin();

        if(isset($_GET['kelas'])){

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'data' => $model->getSiswaByKelas($_GET['kelas'])->getResult(),
            );

        }else{

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
            );

        }

        echo view('admin/masterdata/kenaikan', $data);

    }

    public function kenaikankelas_action(){

        $model = new ModelAdmin();
        $request = \Config\Services::request();

        $data = array(
            'id_kelas' => $request->getPost('tujuan_kelas')
        );

        foreach ($request->getPost('nis') as $res):
            
            $model->prosesKenaikanKelas($data, $res);

        endforeach;

        echo json_encode('Siswa Berhasil Dipindahkan');

    }

    // ---------------------------------------------------------------------------------------------------------------
    // Controller Kelulusan Siswa
    //----------------------------------------------------------------------------------------------------------------

    public function kelulusan(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Kelulusan - Master Data"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Kelulusan"]);

        $model = new ModelAdmin();

        if(isset($_GET['kelas'])){

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'data' => $model->getSiswaBelumLulus($_GET['kelas'])->getResult(),
            );

        }else{

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
            );

        }

        echo view('admin/masterdata/kelulusan', $data);

    }
    
    public function kelulusan_action(){

        $model = new ModelAdmin();
        $request = \Config\Services::request();

        $data = array(
            'status' => "L"
        );

        if(empty($request->getPost('nis'))){

            echo json_encode('Pilih Minimal Satu Siswa');

        }else{

            foreach ($request->getPost('nis') as $res):
                $model->prosesKelulusan($data, $res);
            endforeach;
    
            echo json_encode('Siswa Berhasil Diluluskan');

        }

    }

    // ---------------------------------------------------------------------------------------------------------------
    // Controller Tarif Pembayaran Siswa
    //----------------------------------------------------------------------------------------------------------------

    public function tarif(){

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        view_cell('App\Libraries\Widget::title', ['title'=>"Tarif - Keuangan"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Pos Bayar"]);

        if(empty($request->uri->getSegment(3))){

            return redirect('admin/pos');

        }else{

            if(isset($_GET['kelas'])){

                if($model->getTipePembayaran($request->uri->getSegment(3)) == "bebas"){

                    $data = array(

                        'kelas' => $model->getKelas()->getResult(),
                        'nama_pembayaran' => $model->getNamaPembayaran($request->uri->getSegment(3)),
                        'tahun_ajaran' => $model->getTahunAjaran($request->uri->getSegment(3)),
                        'id_pembayaran' => $request->uri->getSegment(3),
                        'data_siswa' => $model->getDataTagihan_bebas($request->uri->getSegment(3), $_GET['kelas'])->getResult()

                    );

                    echo view('admin/keuangan/tarif_bebas', $data);

                }else{

                    $data = array(

                        'kelas' => $model->getKelas()->getResult(),
                        'nama_pembayaran' => $model->getNamaPembayaran($request->uri->getSegment(3)),
                        'tahun_ajaran' => $model->getTahunAjaran($request->uri->getSegment(3)),
                        'id_pembayaran' => $request->uri->getSegment(3),
                        'data_siswa' => $model->getDataTagihan_bulanan($request->uri->getSegment(3), $_GET['kelas'])->getResult()

                    );

                    echo view('admin/keuangan/tarif_bulanan', $data);
                    
                }


            }else{

                $data = array(
                    'kelas' => $model->getKelas()->getResult(),
                    'nama_pembayaran' => $model->getNamaPembayaran($request->uri->getSegment(3)),
                    'tahun_ajaran' => $model->getTahunAjaran($request->uri->getSegment(3)),
                    'id_pembayaran' => $request->uri->getSegment(3)
                    
                );
                
                echo view('admin/keuangan/tarif', $data);
            }

        }



    }

    public function settingTarif(){

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        view_cell('App\Libraries\Widget::title', ['title'=>"Setting Tarif - Keuangan"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Pos Bayar"]);

        if(empty($request->uri->getSegment(3))){

            return redirect('admin/pos');

        }else{

            if(isset($_GET['kelas'])){

                if($_GET['kelas'] == "all"){

                    $data = array(
                        'kelas' => $model->getKelas()->getResult(),
                        'nama_pembayaran' => $model->getNamaPembayaran($request->uri->getSegment(3)),
                        'tahun_ajaran' => $model->getTahunAjaran($request->uri->getSegment(3)),
                        'id_pembayaran' => $request->uri->getSegment(3),
                        'tipe_pembayaran' => $model->getTipePembayaran($request->uri->getSegment(3)),
                        'data' => $model->getSiswa()->getResult()
                        
                    );

                }else{

                    $data = array(
                        'kelas' => $model->getKelas()->getResult(),
                        'nama_pembayaran' => $model->getNamaPembayaran($request->uri->getSegment(3)),
                        'tahun_ajaran' => $model->getTahunAjaran($request->uri->getSegment(3)),
                        'id_pembayaran' => $request->uri->getSegment(3),
                        'tipe_pembayaran' => $model->getTipePembayaran($request->uri->getSegment(3)),
                        'data' => $model->getSiswaBelumLulus($_GET['kelas'])->getResult()
                        
                    );

                }

            }else{

                $data = array(
                    'kelas' => $model->getKelas()->getResult(),
                    'nama_pembayaran' => $model->getNamaPembayaran($request->uri->getSegment(3)),
                    'tahun_ajaran' => $model->getTahunAjaran($request->uri->getSegment(3)),
                    'id_pembayaran' => $request->uri->getSegment(3),
                    'tipe_pembayaran' => $model->getTipePembayaran($request->uri->getSegment(3))
                    
                );
            }
            
            if($model->getTipePembayaran($request->uri->getSegment(3)) == "bebas"){
    
                echo view('admin/keuangan/settingtarif_bebas', $data);
    
            }else{
    
                echo view('admin/keuangan/settingtarif_bulanan', $data);
    
            }

        }

    }

    public function SimpanTagihan(){

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        if($request->getPost('type') == "bebas"){

            if(empty($request->getPost('nis'))){

                echo json_encode('Pilih Minimal 1 Siswa !');

            }else{

                foreach ($request->getPost('nis') as $res):
                    
                    $data = array(
                        'nis' => $res,
                        'id_pembayaran' => $request->getPost('id_pembayaran'),
                        'total_tagihan' => $request->getPost('total_tagihan')
                    );
                    
                    $model->SimpanTagihan_bebas($data);

                endforeach;

                echo json_encode('Tagihan Baru Berhasil Disimpan');

            }

        }else{
            
            if(empty($request->getPost('id_kelas'))){

                echo json_encode('Pilih Minimal 1 Kelas !');

            }else{

                if($request->getPost('id_kelas') == "all"){

                    foreach ($model->getSiswa()->getResult() as $x):

                        $data = array(

                            'nis' => $x->nis,
                            'id_pembayaran' => $request->getPost('id_pembayaran'),
                            'tag_jan' => $request->getPost('tag_jan'),
                            'tag_feb' => $request->getPost('tag_feb'),
                            'tag_mar' => $request->getPost('tag_mar'),
                            'tag_apr' => $request->getPost('tag_apr'),
                            'tag_mei' => $request->getPost('tag_mei'),
                            'tag_jun' => $request->getPost('tag_jun'),
                            'tag_jul' => $request->getPost('tag_jul'),
                            'tag_agu' => $request->getPost('tag_agu'),
                            'tag_sep' => $request->getPost('tag_sep'),
                            'tag_okt' => $request->getPost('tag_okt'),
                            'tag_nov' => $request->getPost('tag_nov'),
                            'tag_des' => $request->getPost('tag_des'),
                            'sta_jan' => "N",
                            'sta_feb' => "N",
                            'sta_mar' => "N",
                            'sta_apr' => "N",
                            'sta_mei' => "N",
                            'sta_jun' => "N",
                            'sta_jul' => "N",
                            'sta_agu' => "N",
                            'sta_sep' => "N",
                            'sta_okt' => "N",
                            'sta_nov' => "N",
                            'sta_des' => "N"
                        );
                        
                        $model->SimpanTagihan_bulanan($data);

                    endforeach;

                    echo json_encode('Tagihan Baru Berhasil Disimpan , Semua kelas akan menerima tagihan ini');

                }else{

                    foreach ($model->getSiswaBelumLulus($request->getPost('id_kelas'))->getResult() as $res):
                    
                        $data = array(
                            'nis' => $res->nis,
                            'id_pembayaran' => $request->getPost('id_pembayaran'),
                            'tag_jan' => $request->getPost('tag_jan'),
                            'tag_feb' => $request->getPost('tag_feb'),
                            'tag_mar' => $request->getPost('tag_mar'),
                            'tag_apr' => $request->getPost('tag_apr'),
                            'tag_mei' => $request->getPost('tag_mei'),
                            'tag_jun' => $request->getPost('tag_jun'),
                            'tag_jul' => $request->getPost('tag_jul'),
                            'tag_agu' => $request->getPost('tag_agu'),
                            'tag_sep' => $request->getPost('tag_sep'),
                            'tag_okt' => $request->getPost('tag_okt'),
                            'tag_nov' => $request->getPost('tag_nov'),
                            'tag_des' => $request->getPost('tag_des'),
                            'sta_jan' => "N",
                            'sta_feb' => "N",
                            'sta_mar' => "N",
                            'sta_apr' => "N",
                            'sta_mei' => "N",
                            'sta_jun' => "N",
                            'sta_jul' => "N",
                            'sta_agu' => "N",
                            'sta_sep' => "N",
                            'sta_okt' => "N",
                            'sta_nov' => "N",
                            'sta_des' => "N"
                        );
                        
                        $model->SimpanTagihan_bulanan($data);
    
                    endforeach;
    
                    echo json_encode('Tagihan Baru Berhasil Disimpan');

                }

            }
            
        }

    }

    public function HapusGlobalTagihanBulanan(){

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        if(empty($request->getPost('nis'))){

            echo json_encode('Gagal - Pilih Minimal 1 Siswa');

        }else{

            foreach ($request->getPost('nis') as $res):

                $model->HapusTagihanBulananGlobal($res, $request->getPost('id_pembayaran'));
            
            endforeach;

            echo json_encode('Tagihan Berhasil Dihapus');

        }

    }

    public function HapusTagihanBebasGlobal(){

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        if(empty($request->getPost('nis'))){

            echo json_encode('Gagal - Pilih Minimal 1 Siswa');

        }else{

            foreach ($request->getPost('nis') as $res):

                $model->HapusTagihanBebasGlobal($res, $request->getPost('id_pembayaran'));
            
            endforeach;

            echo json_encode('Tagihan Berhasil Dihapus');

        }

    }

    public function edittagihan(){

        $model = new ModelAdmin();
        $request = \Config\Services::request();

        view_cell('App\Libraries\Widget::title', ['title'=>"Edit Tagihan - Keuangan"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Pos Bayar"]);

        if(empty($request->uri->getSegment(3)) || empty($request->uri->getSegment(4))){

            return redirect('admin/pos');

        }else{

            if($model->getTipePembayaran($request->uri->getSegment(3)) == "bebas"){

                $data = array(
                    'nama_pembayaran' => $model->getNamaPembayaran($request->uri->getSegment(3)),
                    'id_pembayaran' => $request->uri->getSegment(3),
                    'data' => $model->getTagihanByid_bebas($request->uri->getSegment(4))->getResult()
                );

                echo view('admin/keuangan/edittarif_bebas', $data);

            }else{

                $data = array(
                    'nama_pembayaran' => $model->getNamaPembayaran($request->uri->getSegment(3)),
                    'id_pembayaran' => $request->uri->getSegment(3),
                    'data' => $model->getTagihanByid_bulanan($request->uri->getSegment(4))->getResult()
                );

                echo view('admin/keuangan/edittarif_bulanan', $data);

            }

        }

    }
    
    public function edittagihanBebas_action(){

        $model = new ModelAdmin();
        $request = \Config\Services::request();

        $data = array(
            'total_tagihan' => $request->getPost('total_tagihan')
        );

        $model->updateTagihanBebas($request->getPost('id_tagihan'), $data);

        echo json_encode('Tagihan Berhasil Di Edit');

    }

    public function hapustagihanBebas(){
        $model = new ModelAdmin();
        $request = \Config\Services::request();

        $id_tagihan = $request->getPost('id_tagihan');

        $model->hapustagihanBebas($id_tagihan);

        echo json_encode('Tagihan Berhasil Dihapus');
    }

    public function edittagihanBulanan_action(){

        $model = new ModelAdmin();
        $request = \Config\Services::request();

        $data = array(
            'tag_jan' => $request->getPost('tag_jan'),
            'tag_feb' => $request->getPost('tag_feb'),
            'tag_mar' => $request->getPost('tag_mar'),
            'tag_apr' => $request->getPost('tag_apr'),
            'tag_mei' => $request->getPost('tag_mei'),
            'tag_jun' => $request->getPost('tag_jun'),
            'tag_jul' => $request->getPost('tag_jul'),
            'tag_agu' => $request->getPost('tag_agu'),
            'tag_sep' => $request->getPost('tag_sep'),
            'tag_okt' => $request->getPost('tag_okt'),
            'tag_nov' => $request->getPost('tag_nov'),
            'tag_des' => $request->getPost('tag_des'),  
        );

        $model->updateTagihanBulanan($request->getPost('id_tagihan'), $data);

        echo json_encode('Tagihan Berhasil diedit');

    }

    public function hapustagihanBulanan(){
        $model = new ModelAdmin();
        $request = \Config\Services::request();

        $id_tagihan = $request->getPost('id_tagihan');

        $model->hapustagihanBulanan($id_tagihan);

        echo json_encode('Tagihan Berhasil Dihapus');
    }

    // ---------------------------------------------------------------------------------------------------------------
    // Controller Tarif Pembayaran Siswa
    //----------------------------------------------------------------------------------------------------------------
    public function pembayaran(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Pembayaran Siswa"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Pembayaran Siswa"]);

        $model = new ModelAdmin();

        if(isset($_GET['siswa'])){

            $res_bulanan = array();
            $key = 0;

            foreach ($model->getTagihanBulananSiswa($_GET['siswa'])->getResult() as $x):
                $res_bulanan[$key]['nama_pembayaran'] = $x->nama_pembayaran;
                $res_bulanan[$key]['id_tagihan'] = $x->id_tagihan;
                $res_bulanan[$key]['total_tagihan'] = $x->total_tagihan;
                $res_bulanan[$key]['tahun_ajaran'] = $x->tahun_ajaran;
                $res_bulanan[$key]['total_bayar'] = $model->getTagihanBulananSiswaDetail($x->id_tagihan);
            
            $key++;
            endforeach;

            $data = array(
                'data_siswa' => $model->getSiswaBynisJoinKelas($_GET['siswa'])->getResult(),
                'data_bulanan' => $res_bulanan,
                'data_bebas' => $model->getTagihanBebasSiswa($_GET['siswa'])->getResult()
            );

            echo view('admin/pembayaran/carisiswa_data', $data);


        }else{

            echo view('admin/pembayaran/carisiswa');

        }


    }

    public function getSiswaSearchLimit(){

        $model = new ModelAdmin();

        $data = array(
            'siswa' => $model->getSearchSiswa($_GET['search'])->getResult()
        );

        $json = array();
        $key = 0;
        foreach ($data['siswa'] as $res){

            $json[$key]['nis'] = $res->nis;
            $json[$key]['nama_siswa'] = $res->nama_siswa;
        
            $key++;
        }

        echo json_encode($json);

    }

    public function bayarbulanan(){
        view_cell('App\Libraries\Widget::title', ['title'=>"Pembayaran Siswa"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Pembayaran Siswa"]);

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
                'id_tagihan' => $request->uri->getSegment(4)
            );

            echo view('admin/pembayaran/bayar_bulanan.php', $data);

        }

    }

    public function bayartagihanbulanan(){

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        $data = array(
            'tipe_pembayaran' => $request->getPost('tipe_pembayaran'),
            'tgl' => $request->getPost('tgl'),
            'id_tagihan' => $request->getPost('id_tagihan'),
            'total_bayar' => $request->getPost('total_bayar'),
            'bulan' => $request->getPost('bulan')
        );

        $model->bayartagihanbulanan($data);

        $data = array(
            'sta_'.$request->getPost('bulan') => 'Y'      
        );

        $model->updateTagihanBulanan($request->getPost('id_tagihan'), $data);

        echo json_encode('Pembayaran Berhasil');

    }

    public function batalbayartagihanbulanan(){

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        $model->batalbayartagihanbulanan($request->getPost('id_tagihan'), $request->getPost('bulan'));

        $data = array(
            'sta_'.$request->getPost('bulan') => 'N'      
        );

        $model->updateTagihanBulanan($request->getPost('id_tagihan'), $data);

        echo json_encode('Hapus Pembayaran Berhasil');


    }

    public function BayarTagihanBulananMulti(){

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        if(empty($request->getPost('bul'))){

            echo json_encode('Gagal - Cheklist Tagihan Salah Satu');

        }else{

            foreach ($request->getPost('bul') as $res):

                $data = array(
                    'tipe_pembayaran' => $request->getPost('tipe_pembayaran'),
                    'tgl' => $request->getPost('tgl'),
                    'id_tagihan' => $request->getPost('id_tagihan'),
                    'total_bayar' => $request->getPost('total_bayar'),
                    'bulan' => $res
                );

                $model->bayartagihanbulanan($data);

                $data = array(
                    'sta_'.$request->getPost('bulan') => 'Y'      
                );
        
                $model->updateTagihanBulanan($request->getPost('id_tagihan'), $data);
        
                echo json_encode('Pembayaran Berhasil');

            endforeach;

        }

    }

    public function bayarbebas(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Pembayaran Siswa"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Pembayaran Siswa"]);

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

            echo view('admin/pembayaran/bayar_bebas.php', $data);

        }
        
    }

    public function bayartagihanbebas(){

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        $data = array(
            'id_tagihan' => $request->getPost('id_tagihan'),
            'tipe_pembayaran' => $request->getPost('tipe_pembayaran'),
            'tgl' => $request->getPost('tgl'),
            'status_bayar' => $request->getPost('status_bayar'),
            'total_bayar' => $request->getPost('total_bayar'),
        );

        $model->bayartagihanbebas($data);

        echo json_encode('Pembayaran Berhasil');

    }

    public function batalbayartagihanbebas(){        
        $model = new ModelAdmin();
        $model->batalbayartagihanbebas($_GET['id_transaksi']);
        return redirect()->to('bayarbebas/'.$_GET['nis'].'/'.$_GET['id_tagihan']);
    }

    // ---------------------------------------------------------------------------------------------------------------
    // Controller Multi Item
    //----------------------------------------------------------------------------------------------------------------
    public function multiitem(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Pembayaran Siswa"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Pembayaran Siswa"]);

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        if(empty($request->getPost('bulanan')) && empty($request->getPost('bebas'))){

            return redirect()->to('pembayaran?siswa='.$request->getpost('nis').'&gagal=true');

        }else{
            $data_bulanan = array();
            $data_bebas = array();

            if(!empty($request->getPost('bulanan'))){

                $key = 0;

                foreach ($model->getTagihanBulananMultiBayar($request->getPost('bulanan'))->getResult() as $x){

                    $total_tagihan = $x->tag_jan + $x->tag_feb + $x->tag_mar + $x->tag_apr + $x->tag_mei + $x->tag_jun + $x->tag_jul + $x->tag_agu + $x->tag_sep + $x->tag_okt + $x->tag_nov + $x->tag_des;

                    $data_bulanan[$key]['tahun_ajaran'] = $x->tahun_ajaran;
                    $data_bulanan[$key]['nama_pembayaran'] = $x->nama_pembayaran;
                    $data_bulanan[$key]['tipe_tagihan'] = $x->tipe_pembayaran;
                    $data_bulanan[$key]['total_tagihan'] = $total_tagihan;
                    $data_bulanan[$key]['sudah_dibayar'] = $model->getTagihanBulananSiswaDetail($x->id_tagihan);
                    $data_bulanan[$key]['tanggungan'] = $total_tagihan - $model->getTagihanBulananSiswaDetail($x->id_tagihan);
                
                    $key++; 
                }

            }else{

                $data_bulanan = null;

            }

            if(!empty($request->getPost('bebas'))){

                $key = 0;

                foreach ($model->getTagihanBebasMultibayar($request->getPost('bebas'))->getResult() as $x):
                    $data_bebas[$key]['tahun_ajaran'] = $x->tahun_ajaran;
                    $data_bebas[$key]['nama_pembayaran'] = $x->nama_pembayaran;
                    $data_bebas[$key]['tipe_tagihan'] = $x->tipe_pembayaran;
                    $data_bebas[$key]['total_tagihan'] = $x->total_tagihan;
                    $data_bebas[$key]['sudah_dibayar'] =  $model->getTagihanBebasSiswaDetail($x->id_tagihan);
                    $data_bebas[$key]['tanggungan'] = $x->total_tagihan - $model->getTagihanBebasSiswaDetail($x->id_tagihan);

                    $key++;

                endforeach;

            }else{

                $data_bebas = null;

            }


            $data = array(
                'data_siswa' => $model->getSiswaBynisJoinKelas($request->getPost('nis'))->getResult(),
                'nama_siswa' => $model->getNamaSiswa($request->getPost('nis')),
                'data_bulanan' => $data_bulanan,
                'data_bebas' => $data_bebas,
                'bulanan' => $request->getPost('bulanan'),
                'bebas' => $request->getPost('bebas')
                
            );

            echo view('admin/pembayaran/multi_item.php', $data);

        }

    }

    public function bayarmultiitem(){

        $request = \Config\Services::request();
        $model = new ModelAdmin();

        $kd_tagihan = $this->randomstring();

        if(!empty($request->getPost('bulanan'))){
            $i = 0;
            $tanggungan_bulanan = $request->getPost('tanggungan_bulanan');
            $sudah_dibayar_bulanan = $request->getPost('sudah_dibayar_bulanan');

            foreach ($request->getPost('bulanan') as $x):

                $data = array(
                    'nis' => $request->getPost('nis'),
                    'id_tagihan' => $x,
                    'harus_dibayar' => $request->getPost('harus_dibayar'),
                    'tgl' => date('Y-m-d'),
                    'tipe_pembayaran' => $request->getPost('tipe_pembayaran'),
                    'kd_tagihan' => $kd_tagihan,
                    'tanggungan' => $tanggungan_bulanan[$i],
                    'sudah_dibayar' => $sudah_dibayar_bulanan[$i]
                );

                $model->bayarTagihanBulananMulti($x, $data, $request->getPost('tipe_pembayaran'));
                
                $i++;
            endforeach;

        }

        if(!empty($request->getPost('bebas'))){

            $i = 0;
            $tanggungan_bebas = $request->getPost('tanggungan_bebas');
            $sudah_dibayar_bebas = $request->getPost('sudah_dibayar_bebas');

            foreach ($request->getPost('bebas') as $x):

                $data = array(
                    'nis' => $request->getPost('nis'),
                    'id_tagihan' => $x,
                    'harus_dibayar' => $request->getPost('harus_dibayar'),
                    'tgl' => date('Y-m-d'),
                    'tipe_pembayaran' => $request->getPost('tipe_pembayaran'),
                    'kd_tagihan' => $kd_tagihan,
                    'tanggungan' => $tanggungan_bebas[$i],
                    'sudah_dibayar' => $sudah_dibayar_bebas[$i]
                );

                $totalbayar = $model->getJumlahTagihanBebas($x);
                $model->bayarTagihanBebasMulti($x, $data, $request->getPost('tipe_pembayaran'), $totalbayar);
                
                $i++;
            endforeach;

        }

        echo json_encode('Pembayaran Berhasil');

    }

    public function getRiwayatTagihanMulti(){
        $request = \Config\Services::request();
        $model = new ModelAdmin();

        $data = array(
            'data_left' => $model->getRiwayatTagihanMulti_Left($request->getPost('nis'))->getResult(),
            'data_right' => $model->getRiwayatTagihanMulti_Right($request->getPost('nis'))->getResult(),
            'data_inner' => $model->getRiwayatTagihanMulti_Inner($request->getPost('nis'))->getResult(),
            'nis' => $request->getPost('nis')
        );

        echo view('admin/pembayaran/modal_riwayat.php', $data);

    }

    public function hapustagihanmulti(){
        $request = \Config\Services::request();
        $model = new ModelAdmin();

        $model->hapustagihanMulti($request->uri->getSegment(3));

        return redirect('admin/pembayaran');
    }

    public function randomstring(){

        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ023456789"; 
        srand((double)microtime()*1000000); 
        $i = 0; 
        $pass = '' ; 
    
        while ($i <= 10) { 
            $num = rand() % 33; 
            $tmp = substr($chars, $num, 1); 
            $pass = $pass . $tmp; 
            $i++; 
        } 
    
        return $pass; 

    }

    // --------------------------------------------------------------

    public function users(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Users Admin"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Users"]);

        $model = new ModelManajemen();

        $data = array(
            'data' => $model->getUser()->getResult()
        );

        echo view('admin/user/data.php', $data);

    }

    public function tambahusers(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Tambah Users"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Users"]);

        echo view('admin/user/tambah.php');

    }

    public function tambahusers_action(){
        $request = \Config\Services::request();
        $model = new ModelManajemen();
        $data = array(
            'nama' => $request->getPost('nama'),
            'email' => $request->getPost('email'),
            'no_hp' => $request->getPost('no_hp'),
            'level' => $request->getPost('level'),
            'username' => $request->getPost('username'),
            'password' => password_hash($request->getPost('password'), PASSWORD_DEFAULT)
        );

        $model->tambahUser($data);

        echo json_encode('Berhasil Disimpan');
    }

    public function hapususer(){
        $request = \Config\Services::request();
        $model = new ModelManajemen();
        $model->hapusUser($request->uri->getSegment(3));

        return redirect('admin/users');
    }

    public function editusers(){
        view_cell('App\Libraries\Widget::title', ['title'=>"Edit Users"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Users"]);

        $request = \Config\Services::request();
        $model = new ModelManajemen();
        $data = array(
            'data' => $model->getUserByusername($request->uri->getSegment(3))->getResult()
        );
        echo view('admin/user/edit.php', $data);
    }

    public function editusers_action(){
        $request = \Config\Services::request();
        $model = new ModelManajemen();

        if(!empty($request->getPost('password'))){

            $data = array(
                'password' => password_hash($request->getPost('password'), PASSWORD_DEFAULT)
            );

            $model->editUser($request->getPost('id'), $data);

        }

        $data = array(
            'nama' => $request->getPost('nama'),
            'email' => $request->getPost('email'),
            'no_hp' => $request->getPost('no_hp'),
            'level' => $request->getPost('level'),
            'username' => $request->getPost('username'),
        );

        $model->editUser($request->getPost('id'), $data);

        echo json_encode('Berhasil diedit');

    }

    // --------------------------------------------------------------

    public function setting(){
        $model = new ModelManajemen();
        view_cell('App\Libraries\Widget::title', ['title'=>"Setting Sekolah"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Sekolah"]);
        $data = array(
            'data' => $model->getSekolah()->getResult()
        );

        echo view('admin/setting/sekolah.php', $data);

    }

    public function updatesetting_action(){
        $model = new ModelManajemen();
        $request = \Config\Services::request();

        $data = array(
            'nama_sekolah' => $request->getPost('nama_sekolah'),
            'alamat' => $request->getPost('alamat'),
            'bendahara' => $request->getPost('bendahara'),
            'sid_twilo' => $request->getPost('sid_twilo'),
            'token_twilo' => $request->getPost('token_twilo'),
            'number_twilo' => $request->getPost('number_twilo'),
            'visi' => $request->getPost('visi'),
            'misi' => $request->getPost('misi'),
            'kepsek' => $request->getPost('kepsek'),
        );

        $model->updateSekolah($data);

        echo json_encode('Berhasil Update');
    }

    public function updatelogo(){

         $request = \Config\Services::request();
        $model = new ModelManajemen();

        $validated = $this->validate([
            'avatar' => [
                'uploaded[logo]',
                'mime_in[logo,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[logo,4096]',
            ],
        ]);

        if($validated){

            $avatar = $request->getFile('logo');

            $avatar->move('dist/img');
            if($request->getPost('type') == "kiri"){
    
                $data = [
                    'logo_kiri' => $avatar->getName()
                ];
    
            }else{
    
                $data = [
                    'logo_kanan' => $avatar->getName()
                ];
    
            }

                
            $model->updateSekolah($data);

            echo json_encode('Berhasil Update');

        }else{

            echo json_encode('Ekstensi Salah');

        }
        

    }

    //------------------------------------------------------------------
    public function lapsiswa(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Laporan Siswa - Laporan"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Laporan Siswa"]);

        $model = new ModelAdmin();

        if(isset($_GET['kelas'])){

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'siswa' => $model->getSiswaByNamaKelas(urldecode($_GET['kelas']))->getResult()
            );

        }else{

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'siswa' => $model->getSiswa()->getResult()
    
            );

        }

        echo view('admin/export/lapsiswa', $data);

    }

    public function lapspp(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Laporan SPP - Laporan"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Laporan SPP"]);

        $model = new ModelAdmin();

        if(isset($_GET['kelas']) && isset($_GET['tahun']) && isset($_GET['pembayaran'])){

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'tahun_ajaran' => $model->getTahunajar()->getResult(),
                'pembayaran' => $model->getPembayaranBulanan()->getResult(),
                'data' => $model->getDataPembayaranBulanan($_GET['kelas'], urldecode($_GET['tahun']), $_GET['pembayaran'])->getResult()
            );

        }else{

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'tahun_ajaran' => $model->getTahunajar()->getResult(),
                'pembayaran' => $model->getPembayaranBulanan()->getResult()
    
            );

        }

        echo view('admin/export/lapspp', $data);

    }

    public function laplain(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Laporan SPP - Laporan"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Laporan Lain"]);

        $model = new ModelAdmin();

        if(isset($_GET['kelas']) && isset($_GET['tahun']) && isset($_GET['pembayaran'])){

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'tahun_ajaran' => $model->getTahunajar()->getResult(),
                'pembayaran' => $model->getPembayaranBebas()->getResult(),
                'data' => $model->getPembayaranBebasBykelas($_GET['kelas'], $_GET['tahun'], $_GET['pembayaran'])->getResult()
            );

        }else{

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'tahun_ajaran' => $model->getTahunajar()->getResult(),
                'pembayaran' => $model->getPembayaranBebas()->getResult()
    
            );

        }

        echo view('admin/export/laplain', $data);

    }

    public function rekap(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Rekapitulasi Pembayaran - Laporan"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Rekap"]);

        $model = new ModelAdmin();

        $data = array(
            'kelas' => $model->getKelas()->getResult(),
            'tahun_ajaran' => $model->getTahunajar()->getResult(),
            'pembayaran_bebas' => $model->getPembayaranBebas()->getResult(),
            'pembayaran_bulanan' => $model->getPembayaranBulanan()->getResult(),
        );

    
        echo view('admin/export/rekap', $data);

    }

    public function rekapdetail(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Rekapitulasi Pembayaran Detail - Laporan"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"Rekap"]);

        $model = new ModelAdmin();

        $data = array(
            'kelas' => $model->getKelas()->getResult(),
            'tahun_ajaran' => $model->getTahunajar()->getResult(),
            'pembayaran_bebas' => $model->getPembayaranBebas()->getResult(),
            'pembayaran_bulanan' => $model->getPembayaranBulanan()->getResult(),
        );

    
        echo view('admin/export/rekapdetail', $data);

    }

    public function lapwalikelas(){


        view_cell('App\Libraries\Widget::title', ['title'=>"Laporan Pembayaran Per Kelas - Laporan"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"LapWali"]);

        $model = new ModelAdmin();

        $data = array(
            'kelas' => $model->getKelas()->getResult(),
            'tahun_ajaran' => $model->getTahunajar()->getResult()
        );

    
        echo view('admin/export/lapwalikelas', $data);


    }

    public function kartutag(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Kartu Tagihan - Laporan"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"kartutag"]);

        $model = new ModelAdmin();

        if(isset($_GET['status']) && isset($_GET['kelas'])){

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'siswa' => $model->Filtersiswa($_GET['status'], urldecode($_GET['kelas']))->getResult()
            );

        }else{

            $data = array(
                'kelas' => $model->getKelas()->getResult(),
                'siswa' => $model->getSiswa()->getResult()
    
            );

        }

        echo view('admin/export/kartutag', $data);

    }

    public function pemasukan(){

        view_cell('App\Libraries\Widget::title', ['title'=>"Pemasukan - Laporan"]);
        view_cell('App\Libraries\Widget::sidebar', ['sidebar'=>"pemasukan"]);

    
        echo view('admin/export/pemasukan');

    }

    //----------------------------------------------------------------------------------------------------------------

    public function NotifikasiSMS(){
        require_once(APPPATH.'Libraries/Twillo/twilio/autoload.php');

        $build = new ModelManajemen();

        try{

            foreach ($build->getSekolah()->getResult() as $x){

                $sid = $x->sid_twilo; 
                $token = $x->token_twilo;
                $no_hp = $x->number_twilo;
                $nama_sekolah = $x->nama_sekolah;
            }
    
            $client = new Client($sid, $token);
    
            $message = $client->messages->create(
              $this->hp($_GET['no_hp']), 
              [
                'from' => $no_hp, 
                'body' => 'Hallo Segera Lunasi Pembayaran '.$_GET['nama_tagihan'].' Sebesar (Rp. '.$_GET['total_tagihan'].'), Terimakasih Keuangan '.$nama_sekolah
              ]
            );
    
            $message->sid;
    
            return redirect('admin/pembayaran');


        }catch(Exception $e){

            dd($e->getMessage());

        }

        
    }

    public function NotifikasiSMSBulanan(){
        require_once(APPPATH.'Libraries/Twillo/twilio/autoload.php');

        $build = new ModelManajemen();
    
        foreach ($build->getSekolah()->getResult() as $x){

            $sid = $x->sid_twilo; 
            $token = $x->token_twilo;
            $no_hp = $x->number_twilo;
            $nama_sekolah = $x->nama_sekolah;
        }

        $client = new Client($sid, $token);

        $message = $client->messages->create(
          $this->hp($_GET['nohp']), 
          [
            'from' => $no_hp, 
            'body' => 'Assalamualaikum Wr.Wb, Harap Segera Menyelesaikan Pembayaran Tagihan '.$_GET['nama_pembayaran'].'* (BULANAN) Anak anda *'.$_GET['nama_siswa'].'* Pada Bulan '.$_GET['bulan'].'Sebesar Rp. '.number_format($_GET['tagihan'] ,2,',','.').' Terima Kasih Keuangan'.$nama_sekolah
          ]
        );

        $message->sid;

        return redirect('admin/pembayaran');
        
    }

    public function hp($nohp) {
        // kadang ada penulisan no hp 0811 239 345
        $nohp = str_replace(" ","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace("(","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace(")","",$nohp);
        // kadang ada penulisan no hp 0811.239.345
        $nohp = str_replace(".","",$nohp);
    
        // cek apakah no hp mengandung karakter + dan 0-9
        if(!preg_match('/[^+0-9]/',trim($nohp))){
            // cek apakah no hp karakter 1-3 adalah +62
            if(substr(trim($nohp), 0, 3)=='+62'){
                $hp = trim($nohp);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif(substr(trim($nohp), 0, 1)=='0'){
                $hp = '+62'.substr(trim($nohp), 1);
            }
        }
        return $hp;
    }


}
?>