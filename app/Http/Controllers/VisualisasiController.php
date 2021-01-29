<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatasetBersih;
use Phpml\Tokenization\WordTokenizer;
use Phpml\Tokenization\WhitespaceTokenizer;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\FeatureExtraction\TokenCountVectorizer;

class VisualisasiController extends Controller
{
    public function index()
    {
        $arraypos_indihome = array('category' => 'indihome', 'datatype' => '0', 'predict_label' => 'positif');
        $arrayneg_indihome = array('category' => 'indihome', 'datatype' => '0', 'predict_label' => 'negatif');
        $arraynet_indihome = array('category' => 'indihome', 'datatype' => '0', 'predict_label' => 'netral');
        $indihome_positif = DatasetBersih::where($arraypos_indihome)->get();
        $indihome_negatif  = DatasetBersih::where($arrayneg_indihome)->get();
        $indihome_netral  = DatasetBersih::where($arraynet_indihome)->get();

        $label_indihome = [
            'label_positif' => count($indihome_positif),
            'label_negatif' => count($indihome_negatif),
            'label_netral' => count($indihome_netral),
        ];

        $arraypos_firstmedia = array('category' => 'firstmedia', 'datatype' => '0', 'predict_label' => 'positif');
        $arrayneg_firstmedia = array('category' => 'firstmedia', 'datatype' => '0', 'predict_label' => 'negatif');
        $arraynet_firstmedia = array('category' => 'firstmedia', 'datatype' => '0', 'predict_label' => 'netral');
        $firstmedia_positif = DatasetBersih::where($arraypos_firstmedia)->get();
        $firstmedia_negatif = DatasetBersih::where($arrayneg_firstmedia)->get();
        $firstmedia_netral = DatasetBersih::where($arraynet_firstmedia)->get();

        $label_firstmedia = [
            'label_positif' => count($firstmedia_positif),
            'label_negatif' => count($firstmedia_negatif),
            'label_netral' => count($firstmedia_netral),
        ];

        $tweet_indihome = DatasetBersih::where(['category' => 'indihome', 'datatype' => '0'])->get();
        $tweet_firstmedia = DatasetBersih::where(['category' => 'firstmedia', 'datatype' => '0'])->get();
        
        //mencari frequency token indihome
        $text_indihome = [];
        foreach ($tweet_indihome as $twt) {
            $text_indihome[] = $twt->tweet;
        };

        $token1 = [];
        foreach ($text_indihome as $txt) {
            $token_indihome = explode(' ', $txt);
            $token1 = array_merge($token_indihome, $token1);
        }
        $count_token_indihome = array_count_values($token1);
        arsort($count_token_indihome);
        $hasil_indihome = array_slice($count_token_indihome, 0, 10, true);

        //mencari frequency token firstmedia
        $text_firstmedia = [];
        foreach ($tweet_firstmedia as $twt) {
            $text_firstmedia[] = $twt->tweet;
        };

        $token2 = [];
        foreach ($text_firstmedia as $txt) {
            $token_firstmedia = explode(' ', $txt);
            $token2 = array_merge($token_firstmedia, $token2);
        }
        $count_token_firstmedia = array_count_values($token2);
        arsort($count_token_firstmedia);
        $hasil_firstmedia = array_slice($count_token_firstmedia, 0, 10, true);
        
        return view('visualisasi', [
            'label_indihome' => $label_indihome,
            'label_firstmedia' => $label_firstmedia,
            'hasil_indihome' => $hasil_indihome,
            'hasil_firstmedia' => $hasil_firstmedia
        ]);
    }
}
