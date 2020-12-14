<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use App\Imports\DatasetImport;
use Maatwebsite\Excel\Facades\Excel;

class DatasetTrainingKotorController extends Controller
{
    public function index()
    {
        $dataset = Dataset::where('datatype', '1')->get();

        $array_indihome = array('category' => 'indihome', 'datatype' => '1');
        $arrayf_firstmedia = array('category' => 'firstmedia', 'datatype' => '1');
        $data_indihome = DB::table('dataset_kotor')->where($array_indihome)->get();
        $indihome = DB::table('dataset_kotor')->where($array_indihome)->count();
        $data_firstmedia = DB::table('dataset_kotor')->where($arrayf_firstmedia)->get();
        $firstmedia = DB::table('dataset_kotor')->where($arrayf_firstmedia)->count();

        return view('training_kotor', [
            'data' => $dataset,
            'data_indihome' => $data_indihome,
            'data_firstmedia' => $data_firstmedia,
            'indihome' => $indihome,
            'firstmedia' => $firstmedia,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //VALIDASI
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');
        // membuat nama file unik
        $nama_file = $file->getClientOriginalName();
        // upload ke folder file_dataset di dalam folder public
        $file->move('file_dataset', $nama_file);

        // import data
        Excel::import(new DatasetImport, public_path('/file_dataset/' . $nama_file));
    
        return redirect()->back()->with(['success' => 'Upload success']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
