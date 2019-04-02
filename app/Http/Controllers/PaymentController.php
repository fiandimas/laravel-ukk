<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Bill;
use Session;

class PaymentController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $payment = Payment::where('payments.status','!=','y')
            ->join('bill','bill.id','=','payments.id_bill')
            ->join('usage','usage.id','=','bill.id_usage')
            ->join('customer','customer.id','=','usage.id_customer')
            ->join('cost','cost.id','=','customer.id_cost')
            ->select('payments.id','customer.name','kwh_number','total_meter','cost_admin','total_pay','cost.power','payments.status','image','date_pay')
            ->get();
        $status = [
            'n' => 'Belum Bayar',
            'p' => 'Pending',
            'r' => 'Ditolak',
            'y' => 'Lunas'
        ];
        $data = [
            'capt' => 'Verifikasi Pembayaran',
            'apayment' => 'active',
            'payment' => $payment,
            'status' => $status,
            'js' => 'js/payment/verif.js'
        ];
    
        return view('admin.payment.payment', $data);
    }

    public function accept($id){
        $payment = Payment::findOrFail($id);
        $payment->status = 'y';
        $payment->id_admin = Session::get('id');
        $payment->save();

        $bill = Bill::findOrFail($payment->id_bill);
        $bill->status = 'y';
        $bill->save();

        return response()->json([
            'success' => true,
            'message' => 'Sukses accept pembayaran'
        ]);
    }

    public function reject($id){
        $payment = Payment::findOrFail($id);
        $payment->status = 'r';
        $payment->id_admin = Session::get('id');
        $payment->save();

        $bill = Bill::findOrFail($payment->id_bill);
        $bill->status = 'r';
        $bill->save();

        return response()->json([
            'success' => true,
            'message' => 'Sukses reject pembayaran'
        ]);
    }
}
