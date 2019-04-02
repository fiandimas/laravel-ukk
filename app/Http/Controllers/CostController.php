<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cost;
use App\Models\Customer;

class CostController extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $data  =[
            'capt' => 'Data Tarif',
            'acost' => 'active',
            'js' => 'js/cost/delete.js',
            'cost' => Cost::all()
        ];

        return view('admin.cost.cost', $data);
    }

    public function create(Request $req){
        $this->validate($req,[
            'cost' => 'required|numeric',
            'power' => 'required|numeric'
        ]);

        $cost = Cost::where('power', $req->power)->count();
        if($cost){
            $response = [
                'success' => false,
                'message' => 'Daya sudah ada'
            ];
        }else{
            Cost::create([
                'power' => $req->power,
                'cost' => $req->cost,
            ]);

            $response = [
                'success' => true,
                'message' => 'Sukses tambah daya',
                'redirect' => '/admin/cost'
            ];
        }

        return response()->json($response);
    }

    public function edit($id){
        $cost = Cost::findOrFail($id);
        $data = [
            'capt' => 'Edit Tarif',
            'acost' => 'active',
            'js' => 'js/cost/edit.js',
            'cost' => $cost
        ];

        return view('admin.cost.edit', $data);
    }

    public function update(Request $req,$id){
        $this->validate($req,[
            'cost' => 'required|numeric'
        ]);

        $cost = Cost::find($id);
        $cost->cost = $req->cost;
        $cost->save();

        return response()->json([
            'success' => true,
            'message' => 'Sukses edit tarif',
            'redirect' => '/admin/cost'
        ]);
    }

    public function delete($id){
        $cost = Customer::where('id_cost', $id)->count();
        if($cost){
            $response = [
                'success' => false,
                'message' => 'Tarif masih dipakai!'
            ];
        }else{
            Cost::find($id)->delete();
            $response = [
                'success' => true,
                'message' => 'Sukses hapus tarif'  
            ];
        }

        return response()->json($response);
    }
}
