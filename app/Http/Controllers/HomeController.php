<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $testing_kotor = DB::table('dataset_kotor')->where('datatype', '0')->count();
        $training_kotor = DB::table('dataset_kotor')->where('datatype', '1')->count();
        $data_indihome = DB::table('dataset_kotor')->where('category', 'indihome')->count();
        $data_firstmedia = DB::table('dataset_kotor')->where('category', 'firstmedia')->count();

        return view('home', [
            'testing' => $testing_kotor,
            'training' => $training_kotor,
            'indihome' => $data_indihome,
            'firstmedia' => $data_firstmedia,
        ]);
    }
}
