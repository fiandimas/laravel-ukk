<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usage;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Payment;
use Session;

class BillController extends Controller
{

    public function __construct(){
        $this->middleware('admin',['except' => [
            'index','pay'
        ]]);
        $this->middleware('customer',['only' => [
            'index','pay'
        ]]);
    }

    public function index(){
        $bill = Usage::where('id_customer',Session::get('id'))
            ->join('customer','customer.id','=','usage.id_customer')
            ->join('bill','usage.id','=','bill.id_usage')
            ->join('cost','customer.id_cost','=','cost.id')
            ->leftJoin('payments','bill.id','=','payments.id_bill')
            ->select('bill.id','bill.month','bill.year','bill.status','bill.total_meter','payments.image','cost.cost')
            ->orderBy('bill.created_at','DESC')
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
            'capt' => 'Tagihan',
            'abill' => 'active',
            'js' => 'js/bill/upload.js',
            'bill' => $bill,
            'month' => $month,
            'status' => $status
        ];

        return view('customer.bill.bill', $data);
    }

    public function pay(Request $req){
        $this->validate($req,[
            'image' => 'required|image'
        ]);
        $payment = Payment::where('id_bill', $req->id_bill);
        $image = $req->file('image');
        $imageName = time().'-'.$image->getClientOriginalName();
        $imagePath = public_path('/images/customer/bills');
        $image->move($imagePath,$imageName);
        if($payment->count() == 0){
            $bill = Bill::where('bill.id',$req->id_bill)
                ->join('usage','usage.id','=','bill.id_usage')
                ->join('customer','customer.id','=','usage.id_customer')
                ->join('cost','cost.id','=','customer.id_cost')
                ->select('bill.month','bill.year','bill.total_meter','cost.cost','bill.status')
                ->first();
            
            $pay = new Payment();
            $pay->id_bill = $req->id_bill;
            $pay->date_pay = Date('Y-m-d');
            $pay->month = $bill->month;
            $pay->year = $bill->year;
            $pay->cost_admin = 5000;
            $pay->total_pay = $bill->total_meter * $bill->cost + 5000;
            $pay->status = 'p';
            $pay->image = $imageName;
            $pay->save();

            $bill->status = 'p';
            $bill->save();
            $response = [
                'success' => true,
                'message' => 'Sukses upload bukti pembayaran'
            ];
        }else{
            $data = $payment->first();
            $data->image = $imageName;
            $data->status = 'p';
            $data->save();

            $bill = Bill::findOrFail($req->id_bill);
            $bill->status = 'p';
            $bill->save();
            $response = [
                'success' => true,
                'message' => 'Sukses upload bukti pembayaran'
            ];
        }

        return response()->json($response);
    }

    public function detail($id){
        $customer = Customer::where('id',$id)->where('status','active')->count();
        if($customer == 0){
            return redirect()->route('usage');
        }else{
            $bill = Usage::where('id_customer',$id)->join('bill','bill.id_usage','=','usage.id')->get();
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
                'capt' => 'Daftar Tagihan',
                'ausage' => 'active',
                'bill' => $bill,
                'month' => $month
            ];

            return view('admin.bill.bill', $data);
        }
    }
}
