<?php
namespace App\Controllers;
use App\Models\ModelAdmin;
use Veritrans_Config;
use Veritrans_Snap;

class Midtrans extends BaseController{

    public function __construct(){

        Veritrans_Config::$serverKey = getenv('MIDTRANS_SERVER_KEY');
        Veritrans_Config::$isProduction = false;
        Veritrans_Config::$isSanitized = true;
        Veritrans_Config::$is3ds = true;        
    }

    public function getsnaptokenTagihanBebas(){

        $models = new ModelAdmin();

        foreach ($models->getTagihanByid_bebas($_POST['id_tagihan'])->getResult() as $x):
            
            $params = [
                'transaction_details' => [
                    'order_id' => rand(0, 1000),
                    'gross_amount' => $x->total_tagihan - $models->getTotalDibayarTagihanBebas($_POST['id_tagihan']),
                ],
                'item_details' => [
                    [
                        'id' => $x->id_tagihan,
                        'price' => $x->total_tagihan - $models->getTotalDibayarTagihanBebas($_POST['id_tagihan']),
                        'quantity' => 1,
                        'name' => $x->nama_pembayaran,
                    ],
                ],
                'customer_details' => [
                    'first_name' => $x->nama_siswa,
                    'address' => $x->alamat,
                    'phone' => $x->no_hp,
                    'email' => 'spptesting@sch.id'
                ]
            ];

        endforeach;

        $snap_token = Veritrans_Snap::getSnapToken($params);

        echo json_encode(['snap_token' => $snap_token]);

    }

    public function getsnaptokenTagihanBulanan(){

        $models = new ModelAdmin();
        $arr_tagihan = array();
        $items_detail = array();
        $gross_amount = 0;

        foreach (@$_POST['bulanan'] as $x){

            $arr_tagihan[] = explode('|', $x)[0];

        }

        foreach($arr_tagihan as $x){
            $gross_amount = $gross_amount + $x;
        }

        foreach (@$_POST['bulanan'] as $x){

            $items_detail[] = [
                'id' => rand(0, 1000),
                'price' => explode('|', $x)[0],
                'quantity' => 1,
                'name' => 'Tagihan '.ucfirst(explode('|', $x)[1])
            ];

        }

        foreach($models->getSiswaByNis(@$_SESSION['login_siswa'])->getResult() as $x){

            $params = [
                'transaction_details' => [
                    'order_id' => rand(0, 1000),
                    'gross_amount' => $gross_amount,
                ],
                'item_details' => $items_detail,
                'customer_details' => [
                    'first_name' => $x->nama_siswa,
                    'address' => $x->alamat,
                    'phone' => $x->no_hp,
                    'email' => 'spptesting@sch.id'
                ]
            ];

        }

        $snap_token = Veritrans_Snap::getSnapToken($params);

        echo json_encode(['snap_token' => $snap_token]);    
    }

    public function tagihanbulananupdate(){

        $models = new ModelAdmin();
        $arr_tagihan = array();
        $arr_bulanan = array();

        foreach (@$_POST['bulanan'] as $x){

            $arr_tagihan[] = explode('|', $x)[0];
            $arr_bulanan[] = explode('|', $x)[1];

        }

        for($i=0; $i<count($arr_bulanan); $i++){

            $data = array(
                'tipe_pembayaran' => 'transfer',
                'tgl' => date('Y-m-d'),
                'id_tagihan' => $_POST['id_tagihan'],
                'total_bayar' => $arr_tagihan[$i],
                'bulan' => strtolower(substr($arr_bulanan[$i], 0, 3))
            );

            $models->bayartagihanbulanan($data);

        }

        for($i=0; $i<count($arr_bulanan); $i++){

            $data = array(
                'sta_'.strtolower(substr($arr_bulanan[$i], 0, 3)) => 'Y'
            );

            $models->updateTagihanBulanan($_POST['id_tagihan'], $data);

        }
        
        echo json_encode('Pembayaran Berhasil Terkonfirmasi');

    }

    public function tagihanbebasupdate(){

        $models = new ModelAdmin();

        foreach ($models->getTagihanByid_bebas($_POST['id_tagihan'])->getResult() as $x):
            
            $total_bayar = $x->total_tagihan - $models->getTotalDibayarTagihanBebas($_POST['id_tagihan']);

        endforeach;


        $data = array(
            'id_tagihan' => $_POST['id_tagihan'],
            'tipe_pembayaran' => 'transfer',
            'tgl' => date('Y-m-d'),
            'status_bayar' => 'lunas',
            'total_bayar' => $total_bayar,
        );

        $models->bayartagihanbebas($data);

        echo json_encode('Pembayaran Berhasil');

    }

}