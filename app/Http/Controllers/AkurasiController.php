<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatasetBersih;
use App\Models\Dataset;
use Illuminate\Support\Facades\DB;

class AkurasiController extends Controller
{
    public function index() {
        $data = DB::table('dataset_bersih')
                ->join('dataset_kotor', 'dataset_bersih.id_tweet', '=', 'dataset_kotor.id_tweet')
                ->select('dataset_bersih.predict_label', 'dataset_kotor.manual_label')
                ->get();

        $result = $this->akurasi($data);
        $result = collect ($result);
        
        return view('akurasi', [
            'result' => $result,
        ]);
    }

    public function akurasi($actual_predict)
    {
        $total_data = count($actual_predict);
        
        $TP = 0; //actual positif predict positif
        $FP = 0; //actual negatif predict positif
        $TN = 0; //actual negatif predict negatif
        $FN = 0; //actual positif predict negatif

        foreach ($actual_predict as $item) {
            if ($item->manual_label == 'positif' && $item->predict_label ==  'positif') {
                $TP += 1;
            }
            if ($item->manual_label == 'negatif' && $item->predict_label ==  'positif') {
                $FP += 1;
            }
            if ($item->manual_label == 'negatif' && $item->predict_label ==  'negatif') {
                $TN += 1;
            }
            if ($item->manual_label == 'positif' && $item->predict_label ==  'negatif') {
                $FN += 1;
            }
        }
        $res = [
            'accuracy' => 0,
            'recall' => 0,
            'precision' => 0,
            'f1' => 0,
            'tp' => $TP,
            'fp' => $FP,
            'tn' => $TN,
            'fn' => $FN,
        ];
        try {
            $res['accuracy'] = (($TP + $TN) / $total_data) * 100;
        } catch (\Throwable $th) {
        }

        try {
            $res['recall'] = ($TP / ($TP + $FN)) * 100;
        } catch (\Throwable $th) {
        }

        try {
            $res['precision'] = ($TP / ($TP + $FP)) * 100;
        } catch (\Throwable $th) {
        }
        try {
            $res['f1'] = 2 * (($res['precision'] * $res['recall']) / ($res['precision'] + $res['recall']));
        } catch (\Throwable $th) {
        }
        
        return $res;
    }
}
