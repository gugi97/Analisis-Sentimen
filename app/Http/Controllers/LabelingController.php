<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatasetBersih;
use Illuminate\Support\Facades\DB;

class LabelingController extends Controller
{
    public function index()
    {
        $testing = DB::table('dataset_bersih')->where('datatype', '0')->get();
        $training = DB::table('dataset_bersih')->where('datatype', '1')->get();
        return view('labeling', [
            'testing' => $testing,
            'training' => $training,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
        if (!$request->id) {
            $message = [
                'error' => 'Tweet tidak ditemukan'
            ];
            return redirect('/labelling')->with($message);
        }

        $dataset = DatasetBersih::where('id_tweet',$id)->first();

        $dataset->label = $request->input('label');

        if ($dataset->save()) {
            $message = [
                'success' => 'Berhasil mengubah label tweet'
            ];
            return redirect()->back()->with($message);
        } else {
            $message = [
                'error' => 'Gagal mengubah label tweet'
            ];
            return redirect()->back()->with($message);
        }

        return redirect()->back()->with('success', 'Data Update');
    }

    public function destroy($id)
    {
        //
    }
}
