<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\level;
use Session;
use Hash;
use App\Models\Payment;
use DB;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('admin',['except' => [
            'login','index'
        ]]);
    }

    public function index(){
        if(Session::get('id_level') == 1 || Session::get('id_level') == 2){
            $level = [
                1 => 'Manager',
                2 => 'Teller'
            ];
            $data = [
                'capt' => 'Dasbor',
                'ahome' => 'active',
                'level' => $level
            ];
            return view('admin.home', $data);
        }else{
            return redirect('/admin/login');
        }
    }

    public function login(Request $req){
        $this->validate($req,[
            'username' => 'required',
            'password' => 'required'
        ]);

        $admin = Admin::where('username',$req->username);
        if($admin->count() == 0){
            $response = [
                'success' => false,
                'message' => 'Akun tidak terdaftar'
            ];
        }else{
            $data = $admin->first();
            if(Hash::check($req->password,$data->password)){
                $session = [
                    'name' => $data->name,
                    'login' => true,
                    'id' => $data->id,
                    'id_level' => $data->id_level,
                ];
                Session::put($session);
                $response = [
                    'success' => true,
                    'message' => 'Berhasil login!',
                    'redirect' => '/admin'
                ];
            }else{
                $response = [
                    'success' => false,
                    'message' => 'Password salah!'
                ];
            }
        }

        return response()->json($response);
    }

    public function admin(){
        $admin = Admin::join('level','admin.id_level','=','level.id')
                    ->select('admin.id','admin.name as aname','level.name as lname','admin.username')
                    ->get();

        $data = [
            'capt' => 'Data Admin',
            'aadmin' => 'active',
            'admin' => $admin,
            'js' => 'js/admin/delete.js',
            'level' => DB::select('call getLevel()')
        ];

        return view('admin.admin.admin', $data);
    }

    public function add(){
        $data = [
            'capt' => 'Tambah Admin',
            'aadmin' => 'active',
            'js' => 'js/admin/add.js',
            
        ];

        return view('admin.admin.add', $data);
    }

    public function create(Request $req){
        $this->validate($req,[
            'name' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = Admin::where('username', $req->username)->count();

        if($username){
            $response = [
                'success' => false,
                'message' => 'Username sudah terpakai!'
            ];
        }else{
            Admin::create([
                'name' => $req->name,
                'username' => $req->username,
                'password' => Hash::make($req->password),
                'id_level' => $req->id_level
            ]);

            $response = [
                'success' => true,
                'message' => 'Sukses tambah admin',
                'redirect' => '/admin/admin'
            ];
        }

        return response()->json($response);
    }

    public function edit($id){
        $admin =  Admin::findOrFail($id);
        $level = Level::where('id', $admin->id_level)->first();
        $levelNotSelect = Level::where('id','!=',$level->id)->first();
        if($admin){
            $data = [
                'capt' => 'Edit Admin',
                'aadmin' => 'active',
                'admin' => $admin,
                'level' => $level,
                'levelNotSelect' => $levelNotSelect,
                'js' => 'js/admin/edit.js'
            ];

            return view('admin.admin.edit', $data);
        }
    }

    public function update(Request $req,$id){
        $this->validate($req,[
            'name' => 'required',
        ]);

        $admin = Admin::find($id);
        $admin->name = $req->name;
        $admin->id_level = $req->id_level;
        $admin->save();

        $response = [
            'redirect' => '/admin/admin'
        ];

        return response()->json($response);
        
    }

    public function delete($id){
        $data = Payment::where('id_admin', $id)->count();
        if($data > 0){
            $response = [
                'success' => false,
                'message' => 'Gagal hapus admin'
            ];
        }else{
            $admin = Admin::find($id);
            $admin->delete();

            $response = [
                'success' => true,
                'message' => 'Sukses hapus admin',
                'redirect' => '/admin/admin'
            ];
        }

        return response()->json($response);
    }
}
