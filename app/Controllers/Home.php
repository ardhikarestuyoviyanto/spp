<?php
namespace App\Controllers;

use App\Models\ModelLogin as ModelsModelLogin;
use CodeIgniter\Models\ModelLogin;
use App\Models\ModelManajemen;
use App\Models\ModelAdmin;

class Home extends BaseController{
	private $session;

	public function __construct(){
		$this->session = \Config\Services::session();
	}

	public function index(){
		view_cell('App\Libraries\Widget::title', ['title'=>"Sistem Pembayaran Sekolahan"]);

		$model = new ModelManajemen();

		$data = array(
			'data_sekolah' => $model->getSekolah()->getResult()
		);

		return view('login/portal', $data);
	}

	public function loginsiswa(){
		view_cell('App\Libraries\Widget::title', ['title'=>"Login Siswa"]);
		$data = array(
			'number_1' => rand(1, 10),
			'number_2' => rand(1, 10)
		);
		return view('login/siswa', $data);
	}

	public function login_siswa(){
		$model = new ModelsModelLogin();
		$request = service('request');
		helper('cookie');

		$hasil = $request->getPost('number_1') + $request->getPost('number_2');

		if($hasil == $request->getPost('captcha')){

			foreach ($model->loginsiswa($request->getPost('nis'))->getResult() as $x):

				if(password_verify($request->getPost('password'), $x->password) && $request->getPost('nis') == $x->nis){
				
					if($request->getPost('remember_siswa') != null){

						set_cookie("remember_siswa", $request->getPost('nis'), time()+ (10 * 365 * 24 * 60 * 60));

						$data = array(
							'login_siswa' => $request->getPost('nis'),
							'nama_siswa' => $x->nama_siswa
						);

						$session = session();
						$session->set($data);

						return redirect('siswa/home');

					}else{

						set_cookie("remember_siswa", "");

						$data = array(
							'login_siswa' => $request->getPost('nis'), 
							'nama_siswa' => $x->nama_siswa
						);

						$session = session();
						$session->set($data);

						return redirect('siswa/home');
					}

					break;
				
				}

			endforeach;

			$this->session->setFlashdata('error', "Username Atau Password Salah");
			return redirect('auth/loginsiswa');

		}else{
			$this->session->setFlashdata('error', "Captcha Anda Salah");
			return redirect('auth/loginsiswa');

		}
	}

	public function loginadmin(){
		view_cell('App\Libraries\Widget::title', ['title'=>"Login Admin"]);
		$data = array(
			'number_1' => rand(1, 10),
			'number_2' => rand(1, 10)
		);
		return view('login/admin', $data);
	}

	public function login_admin(){
		$model = new ModelsModelLogin();
		$request = service('request');
		helper('cookie');

		$hasil = $request->getPost('number_1') + $request->getPost('number_2');

		if($hasil == $request->getPost('captcha')){

			foreach ($model->getDataAdmin()->getResult() as $x):

				if(password_verify($request->getPost('password'), $x->password) && $request->getPost('username') == $x->username){
				
					if($request->getPost('remember') != null){

						set_cookie("remember", $request->getPost('username'), time()+ (10 * 365 * 24 * 60 * 60));

						$data = array(
							'login_admin' => $request->getPost('username'),
							'nama_admin' => $x->nama
						);

						$session = session();
						$session->set($data);

						return redirect('admin/home');

					}else{

						set_cookie("remember", "");

						$data = array(
							'login_admin' => $request->getPost('username')
						);

						$session = session();
						$session->set($data);

						return redirect('admin/home');
					}

					break;
				
				}

			endforeach;

			$this->session->setFlashdata('error', "Username Atau Password Salah");
			return redirect('auth/loginadmin');

		}else{
			$this->session->setFlashdata('error', "Captcha Anda Salah");
			return redirect('auth/loginadmin');

		}

	}

	public function logout(){
		$session = session();
		$session->destroy();
		return redirect('/');
	}

	//--------------------------------------------------------

	public function carisiswa(){

		view_cell('App\Libraries\Widget::title', ['title'=>"Sistem Pembayaran Sekolahan"]);

        $model = new ModelAdmin();

        if(isset($_GET['siswa'])){

            $data = array(
                'data_siswa' => $model->getSiswaBynisJoinKelas($_GET['siswa'])->getResult(),
                'data_bulanan' => $model->getDataTagihan_bulanBynis($_GET['siswa'])->getResult(),
                'data_bebas' => $model->getTagihanBebasSiswa($_GET['siswa'])->getResult()
            );

            echo view('login/carisiswa_data', $data);


        }else{

			return view('login/carisiswa');

        }



	}

}
