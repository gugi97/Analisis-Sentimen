<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatasetBersih;

use Phpml\Metric\Accuracy;
use Illuminate\Support\Facades\DB;
use Phpml\Classification\NaiveBayes;
use Phpml\Tokenization\WordTokenizer;
use Phpml\Tokenization\WhitespaceTokenizer;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\FeatureExtraction\TokenCountVectorizer;

class KlasifikasiController extends Controller
{
    public function index()
    {
        $this->klasifikasi();
        
        // return view('tfidf');
    }

    public function klasifikasi()
    {
        // Memanggil dataset training
        $data_training = DatasetBersih::where('datatype', '1')->get();
        foreach ($data_training as $data) {
            $id_tweet[] = $data->id_tweet;
            $tweet[]  = $data->tweet;
            $label[]  = $data->label;
        }

        // Bring Data to wrap words with WordTokenizer ()
        $tokenize = new WordTokenizer();
        // inisialisasi fungsi token counter
        $vectorizer = new TokenCountVectorizer($tokenize);
        
        // Convert it to WordVector (Build the dictionary)
        $vectorizer->fit($tweet);
        $vocabulary = $vectorizer->getVocabulary();
        
        // Transform the provided text samples into a vectorized list.
        // menghitung term frequency per document (tweet) dari kumpulan token berdasarkan semua tweet
        $tweet_transform = $tweet;
        $vectorizer->transform($tweet_transform);

        // **** Apply the Tf-idf Transformer ****
        // Once WordVector is obtained, use TF-IDF to search for keywords in the Document.
        $transformer = new TfIdfTransformer($tweet_transform);
        // menghitung weight per document (tweet) dengan rumus w=tf*log(D/df)
        $transformer->transform($tweet_transform);

        //     $i = 0;
        //     while ($i < count($tweet)) {
        //         $bobot[] = number_format((array_sum($tweet[$i])), 3, '.', '');
        //         $i++;
        //     }

        // **** Bring the results into Naive Bayes with the original Label created ****
        // Initialize classifier
        $classifier = new NaiveBayes();
        // Train classifier
        $classifier->train($tweet_transform, $label);

        // Memanggil dataset testing
        $datatest = DatasetBersih::where('datatype', '0')->get();
        foreach ($datatest as $data) {
            $Test_tweet[]  = $data->tweet;
            $Actual_label[]  = $data->label;
        }

        $vectorizer->transform($Test_tweet);
        $transformer->transform($Test_tweet);

        //Make a predict to get the result
        $result = $classifier->predict($arr_testset);
        var_dump($result);

        //**** Test the Classifier’s Accuracy ****
        //Compare the Result value with Expect Label to calculate the Accuracy
        $accurcay = Accuracy::score($arr_actualLabels, $arr_predictedLabels);

    //menyimpan nilai bobot pertweet
    //     foreach ($id_tweet as $key => $value) {
    //         $a = DatasetBersih::where('id_tweet', $id_tweet[$key])->first();
    //         $a->weight = $bobot[$key];
    //         $a->save();
    //     }
    }
}
