<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabelingController extends Controller
{
    public function index()
    {
        $testing = DB::table('dataset_kotor')->where('datatype', '0')->get();
        $training = DB::table('dataset_kotor')->where('datatype', '1')->get();
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
        $data = Dataset::all();
        $data_bersih = DatasetBersih::all();

        if (count($data_bersih) < 1) {
            return redirect()->back()->with('warning', 'Do Preprocessing First');
        }

        $positif = PositifWord::all();
        foreach ($positif as $result) {
            $kamusPositif[] = $result->word;
        };

        $negatif = NegatifWord::all();
        foreach ($negatif as $result) {
            $kamusNegatif[] = $result->word;
        };

        $i = 0;
        foreach ($data as $result) {
            //menampung nilai skor pertweet
            $skor = 0;
            $kata = explode(" ", ($data_bersih[$i]['tweet']));

            for ($j = 0; $j < count($kata); $j++) {
                if (in_array($kata[$j], $kamusPositif)) {
                    $skor++;
                }
                if (in_array($kata[$j], $kamusNegatif)) {
                    $skor--;
                }
            }
            $i = $i + 1;

            if ($skor > 0) {
                $result->manual_label = 'positif';
                $result->save();
            } elseif ($skor < 0) {
                $result->manual_label = 'negatif';
                $result->save();
            }else{
                continue;
            }
            
        }
        return redirect()->back()->with('success', 'Data Saved');
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

        $dataset = Dataset::where('id_tweet', $id)->first();

        $dataset->manual_label = $request->input('label');

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
