<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use App\Imports\DatasetImport;
use Maatwebsite\Excel\Facades\Excel;

class DatasetTestingKotorController extends Controller
{
    public function index()
    {
        $dataset = Dataset::where('datatype', '0')->get();

        $array_indihome = array('category' => 'indihome', 'datatype' => '0');
        $arrayf_firstmedia = array('category' => 'firstmedia', 'datatype' => '0');
        $data_indihome = DB::table('dataset_kotor')->where($array_indihome)->count();
        $data_firstmedia = DB::table('dataset_kotor')->where($arrayf_firstmedia)->count();

        return view('testing_kotor', [
            'data' => $dataset,
            'indihome' => $data_indihome,
            'firstmedia' => $data_firstmedia,
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
