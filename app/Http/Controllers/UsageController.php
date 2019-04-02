<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Usage;
use App\Models\Bill;
use App\Models\Month;

class UsageController extends Controller
{
    
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $usage = Customer::where('status','active')
                ->join('cost','cost.id','=','customer.id_cost')
                ->select('customer.id','customer.name','customer.kwh_number','cost.cost')
                ->get();

        $data = [
            'capt' => 'Data Penggunaan',
            'ausage' => 'active',
            'usage' => $usage,
        ];

       return view('admin.usage.usage', $data);
    }

    public function detail($id){
        $usage = Usage::where('id_customer', $id)->get();
        $customer = Customer::where('id',$id)->where('status','delete')->count();
        if($customer == 0){
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
            
            $data = [
                'capt' => 'Data Penggunaan',
                'ausage' => 'active',
                'usage' => $usage,
                'month' => $month
            ];
    
           return view('admin.usage.detail', $data);
        }else{
            return redirect()->route('usage');
        }
    }

    public function add(){
        $customer = Customer::where('status','active')
                ->get();
        $data = [
            'capt' => 'Tambah Penggunaan',
            'ausage' => 'active',
            'customer' => $customer,
            'js' => 'js/usage/add.js'
        ];
        
        return view('admin.usage.add', $data);
    }

    public function getMonthUsage(Request $req){
        $usageMonth = Usage::where('year',$req->year)->where('id_customer',$req->id_customer)->select('month')->get();
        $month = [];
        foreach($usageMonth as $data){
            array_push($month,$data->month);
        }
        $result = Month::whereNotIn('id',$month)->get();
        $html = '';
        foreach($result as $data){
            $html .= '
                <option value="'.$data->id. '">'.$data->name.'</option>
            ';
        }

        return $html;
    }

    public function create(Request $req){
        $this->validate($req,[
            'start_meter' => 'required|numeric',
            'finish_meter' => 'required|numeric'
        ]);
        $finish_meter = $req->finish_meter;
        $start_meter = $req->start_meter;
        if($start_meter >= $finish_meter){
            $response = [
                'success' => false,
                'message' => 'Meter Akhir harus lebih besar dari meter awal!'
            ];
        }else{
            $usage = new Usage();
            $usage->id_customer = $req->id_customer;
            $usage->month = $req->month;
            $usage->year = $req->year;
            $usage->start_meter = $req->start_meter;
            $usage->finish_meter = $req->finish_meter;
            $usage->save();

            $bill = new Bill();
            $bill->id_usage = $usage->id;
            $bill->month = $usage->month;
            $bill->year = $usage->year;
            $bill->total_meter = $usage->finish_meter - $usage->start_meter;
            $bill->status = 'n';
            $bill->save();

            $response = [
                'success' => true,
                'message' => 'Sukses tambah penggunaan',
                'redirect' => '/admin/usage'
            ];
        }

        return response()->json($response);
    }
}
