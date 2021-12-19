<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthSiswa implements FilterInterface{

    public function before(RequestInterface $request, $arguments = null){
        
        if(!session()->get('login_siswa')){
            return redirect()->to('/');
        }

        
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
        
    }

}
?>