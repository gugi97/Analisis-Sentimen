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
                ->select('dataset_bersih.predict_label', 'dataset_bersih.datatype', 'dataset_kotor.manual_label')
                ->where('dataset_bersih.datatype', 0)
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

        // TA   FA1  FA2 TAA
        // FB1  TB   FB2 TAB
        // FC1  FC2  TC  TAC
        // TPA  TPB  TPC
        //row 1
        $TA = 0; //actual positif predict positif (TRUE)
        $FA1 = 0; //actual positif predict negatif
        $FA2 = 0; //actual positif predict netral
        $TAA = 0; //total actual A
        //row 2
        $FB1 = 0; //actual negatif predict positif
        $TB = 0; //actual negatif predict negatif (TRUE)
        $FB2 = 0; //actual negatif predict netral
        $TAB = 0; //total actual B
        //row 3
        $FC1 = 0; //actual netral predict positif
        $FC2 = 0; //actual netral predict negatif
        $TC = 0; //actual netral predict netral (TRUE)
        $TAC = 0; //total actual C
        //row 4
        $TPA = 0; //total predict A
        $TPB = 0; //total predict B
        $TPC = 0; //total predict C

        foreach ($actual_predict as $item) {
            //row 1
            if ($item->manual_label == 'positif' && $item->predict_label ==  'positif') {
                $TA += 1;
            }
            if ($item->manual_label == 'positif' && $item->predict_label ==  'negatif') {
                $FA1 += 1;
            }
            if ($item->manual_label == 'positif' && $item->predict_label ==  'netral') {
                $FA2 += 1;
            }
            //row 2
            if ($item->manual_label == 'negatif' && $item->predict_label ==  'positif') {
                $FB1 += 1;
            }
            if ($item->manual_label == 'negatif' && $item->predict_label ==  'negatif') {
                $TB += 1;
            }
            if ($item->manual_label == 'negatif' && $item->predict_label ==  'netral') {
                $FB2 += 1;
            }
            //row 3
            if ($item->manual_label == 'netral' && $item->predict_label ==  'positif') {
                $FC1 += 1;
            }
            if ($item->manual_label == 'netral' && $item->predict_label ==  'negatif') {
                $FC2 += 1;
            }
            if ($item->manual_label == 'netral' && $item->predict_label ==  'netral') {
                $TC += 1;
            }           
        }
        //actual
        $TAA = $TA + $FA1 + $FA2;
        $TAB = $FB1 + $TB + $FB2;
        $TAC = $FC1 + $FC2 + $TC;
        //predict
        $TPA = $TA + $FB1 + $FC1;
        $TPB = $FA1 + $TB + $FC2;
        $TPC = $FA2 + $FB2 + $TC;

        //recall
        if($TA != 0){
            $recPositif = number_format(($TA/($TPA)), 2, '.', ',');
        }else{
            $recPositif = 0;
        }
        if($TB != 0){
            $recNegatif = number_format(($TB/($TPB)), 2, '.', ',');;
        }else{
            $recNegatif = 0;
        }
        if($TC != 0){
            $recNetral = number_format(($TC/($TPC)), 2, '.', ',');
        }else{
            $recNetral = 0;
        }

        //precision
        if($TA != 0){
            $precPositif = number_format(($TA/($TAA)), 2, '.', ',');
        }else{
            $precPositif = 0;
        }
        if($TB != 0){
            $precNegatif = number_format(($TB/($TAB)), 2, '.', ',');
        }else{
            $precNegatif = 0;
        }
        if($TC != 0){
            $precNetral = number_format(($TC/($TAC)), 2, '.', ',');
        }else{
            $precNetral = 0;
        }

        $res = [
            'recNetral' => $recNetral,
            'recNegatif' => $recNegatif,
            'recPositif' => $recPositif,
            'precNetral' => $precNetral,
            'precNegatif' => $precNegatif,
            'precPositif' => $precPositif,
            'accuracy' => 0,
            'recall' => 0,
            'precision' => 0,
            'f1' => 0,
            'TA' => $TA,
            'FA1' => $FA1,
            'FA2' => $FA2,
            'FB1' => $FB1,
            'TB' => $TB,
            'FB2' => $FB2,
            'FC1' => $FC1,
            'FC2' => $FC2,
            'TC' => $TC,
            'TAA' => $TAA,
            'TAB' => $TAB,
            'TAC' => $TAC,
            'TPA' => $TPA,
            'TPB' => $TPB,
            'TPC' => $TPC,
            'TOTAL' => $total_data,
        ];
        try {
            $TA = $TA+$TB+$TC;
            $res['accuracy'] = round(($TA / $total_data) * 100, 2);
        } catch (\Throwable $th) {
        }

        try {            
            // $res['recall'] = ($TA / ($TA + $FA1)) * 100;
            $res['recall'] = round((($recPositif + $recNegatif + $recNetral)/3) * 100, 2);
        } catch (\Throwable $th) {
        }

        try {
            // $res['precision'] = ($TA / ($TA + $FB1)) * 100;
            $res['precision'] = round((($precPositif + $precNegatif + $precNetral)/3) * 100, 2);
        } catch (\Throwable $th) {

        }
        // try {
        //     $res['f1'] = 2 * (($res['precision'] * $res['recall']) / ($res['precision'] + $res['recall']));
        // } catch (\Throwable $th) {
        // }
        
        return $res;
    }
}
