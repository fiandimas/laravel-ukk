<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;

class LevelController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    
    public function index(){
        $level = Level::all();
        $data = [
            'capt' => 'Data Level',
            'alevel' => 'active',
            'level' => $level
        ];

        return view('admin.level.level', $data);
    }
}
