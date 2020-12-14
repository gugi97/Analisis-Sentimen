<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatasetBersih;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Tokenization\WordTokenizer;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Illuminate\Support\Facades\DB;

class TfidfController extends Controller
{
    public function index()
    {
        $a = $this->pembobotan();
        // return view('tfidf');
    }

    public function pembobotan()
    {
        //memanggil dataset training
        $dataset = DatasetBersih::where('datatype', '1')->get();
        // foreach ($dataset as $data) {
        //     $tweet[]  = $data->tweet;
        // }

        $tweet = [
            'saya lagi makan nasi goreng',
            'nasi uduk saya suka makan',
        ];

        //inisialisasi fungsi token counter
        $vectorizer = new TokenCountVectorizer(new WordTokenizer());
        
        // Build the dictionary.
        $vectorizer->fit($tweet);
        
        // Transform the provided text samples into a vectorized list.
        $vectorizer->transform($tweet);

        //inisialisasi fungsi tfidf transformer
        // $tfIdfTransformer = new TfIdfTransformer();

        // $tfIdfTransformer->fit($tweet);
        // $tfIdfTransformer->transform($tweet);
        
        print_r($tweet);

        // $i = 0;
        // while($i < count($tweet)){
        //     $bobot[] = (array_sum($tweet[$i]));
        //     $i++;
        // }

        // foreach ($dataset as $data) {
        //     $a = DB::table('dataset_bersih')
        //     ->where('id_tweet', $data['id_tweet'])->insertOrIgnore([
        //         'weight' => $bobot,
        //     ]);
        // }

        return $tweet;
    }


}
