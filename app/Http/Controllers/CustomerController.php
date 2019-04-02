<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Usage;
use App\Models\Cost;
use Session;
use Hash;

class CustomerController extends Controller
{

    public function __construct(){
        $this->middleware('admin',['except' => [
            'index','login','create'
        ]]);
        $this->middleware('customer',['only' => [
          'index'
      ]]);
    }

    public function index(){
        $data = [
            'ahome' => 'active',
            'capt' => 'Dasbor'
        ];

        return view('customer.home', $data);
    }

    public function customer(){
        $customer = Customer::where('status','active')
                ->join('cost','customer.id_cost','=','cost.id')
                ->select('customer.id','customer.name','customer.address','customer.kwh_number','customer.username','cost.power')
                ->get();
        $data = [
            'capt' => 'Data Pengguna',
            'acustomer' => 'active',
            'customer' => $customer,
            'js' => 'js/customer/delete.js'
        ];

        return view('admin.customer.customer', $data);
    }

    public function login(Request $req){
        $this->validate($req,[
            'username' => 'required',
            'password' => 'required'
        ]);

        $customer = Customer::where('username',$req->username);
        if($customer->count() == 0){
            $response = [
                'success' => false,
                'message' => 'Username tidak terdaftar'
            ];
        }else{
            $data = $customer->first();
            if(Hash::check($req->password,$data->password)){
                $session = [
                    'name' => $data->name,
                    'login' => true,
                    'id' => $data->id,
                    'id_level' => $data->id_level,
                    'customer' => true
                ];
                Session::put($session);
                $response = [
                    'success' => true,
                    'message' => 'Berhasil login, Anda akan otomatis pidah halaman'
                ];
            }else{
                $response = [
                    'success' => false,
                    'message' => 'Password salah'
                ];
            }
        }

        return response()->json($response);
    }

    public function add(){
        $data = [
            'capt' => 'Tambah Pengguna',
            'acustomer' => 'active',
            'js' => 'js/customer/add.js',
            'cost' => Cost::all()
        ];

        return view('admin.customer.add', $data);
    }

    public function create(Request $req){
        $this->validate($req,[
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'kwh_number' => 'required|numeric',
            'address' => 'required'
        ]);

        $username = Customer::where('username', $req->username)->count();
        $kwh_number = Customer::where('kwh_number', $req->kwh_number)->count();
        if($username){
            $response = [
                'success' => false,
                'message' => 'Username sudah dipakai!'
            ];
        }else{
            if($kwh_number){
                $response = [
                    'success' => false,
                    'message' => 'No. KWH sudah dipakai!'
                ];
            }else{
                Customer::create([
                    'name' => $req->name,
                    'username' => $req->username,
                    'password' => Hash::make($req->password),
                    'kwh_number' => $req->kwh_number,
                    'address' => $req->address,
                    'id_cost' => $req->id_cost,
                    'status' => 'active'
                ]);
                $response = [
                    'success' => true,
                    'message' => 'Sukses tambah pengguna!',
                    'redirect' => '/admin/customer'
                ];
            }
        }

        return response()->json($response);
    }

    public function edit($id){
        $customer = Customer::where('customer.id', $id)
                ->join('cost','cost.id','=','customer.id_cost')
                ->select('customer.id','customer.name','customer.username','customer.kwh_number','customer.address','cost.power','cost.id as cid')
                ->first();
    
        $notSelectCost = Cost::where('id','!=',$customer->cid)->get();
        $data = [
            'capt' => 'Edit Pengguna',
            'acustomer' => 'active',
            'js' => 'js/customer/edit.js',
            'customer' => $customer,
            'cost' => $notSelectCost
        ];

        if($customer){
            return view('admin.customer.edit', $data);
        }else{
            return redirect()->route('customer');
        }
    }

    public function update(Request $req,$id){
        $this->validate($req,[
            'name' => 'required',
            'address' => 'required'
        ]);
        $user = Customer::findOrFail($id);
        $user->name = $req->name;
        $user->address = $req->address;
        $user->id_cost = $req->id_cost;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Sukses edit pengguna',
            'redirect' => '/admin/customer'
        ]);
    }

    public function delete($id){
        $bill = Usage::where('id_customer', $id)
            ->where('bill.status','n')
            ->join('bill','bill.id_usage','=','usage.id')
            ->count();
         
        if($bill > 0){
            $response = [
                'success' => false,
                'message' => 'pengguna masih mempunyai tagihan'
            ];
        }else{
            $customer = Customer::findOrFail($id);
            $customer->status = 'delete';
            $customer->save();

            $response = [
                'success' => true,
                'message' => 'Sukses delete pengguna'
            ];
        }
        
        return response()->json($response);
    }
}