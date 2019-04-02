<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Session;

class HistoryController extends Controller
{

    public function index(){
        if(Session::get('login')){
            if(Session::get('id_level') == 1 || Session::get('id_level') == 2){
                $history = Payment::join('bill','bill.id','=','payments.id_bill')
                    ->leftJoin('admin','admin.id','=','payments.id_admin')
                    ->join('usage','usage.id','=','bill.id_usage')
                    ->join('customer','customer.id','=','usage.id_customer')
                    ->join('cost','cost.id','=','customer.id_cost')
                    ->select('date_pay','cost_admin','total_pay','image','payments.status','total_meter','bill.month','bill.year','admin.name','power','customer.name as cname','kwh_number')
                    ->orderBy('payments.created_at','DESC')
                    ->get();
                $month = [
                    1 => 'Januari',
                    2 => 'Februari',
                    3 => 'Maret',
                    4 => 'April',
                    5 => 'Mei',
                    6 => 'Juni',
                    7 => 'Juli',
                    8 => 'Agustus',
                    9 => 'September',
                    10 => 'Oktober',
                    11 => 'November',
                    12 => 'Desember'
                ];
                $status = [
                    'n' => 'Belum Bayar',
                    'p' => 'Pending',
                    'r' => 'Ditolak',
                    'y' => 'Lunas'
                ];
                $data = [
                    'capt' => 'History Penggunaan',
                    'ahistory' => 'active',
                    'history' => $history,
                    'month' => $month,
                    'status' => $status
                ];

                return view('admin.history.history', $data);
            }else{
                abort('403');
            }
        }else{
            return redirect('/admin/login');
        }
    }
}
