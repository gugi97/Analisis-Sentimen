<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatasetBersih;
use App\Models\Dataset;

use Phpml\Metric\Accuracy;
use Illuminate\Support\Facades\DB;
use Phpml\Classification\NaiveBayes;
use Phpml\Tokenization\WordTokenizer;
use Phpml\Tokenization\WhitespaceTokenizer;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class KlasifikasiController extends Controller
{
    public function index()
    {
        $label_null = Dataset::where('manual_label', NULL)->get();
        $data_testing_kotor = Dataset::where('datatype', '0')->get();
        $data_training_bersih = DatasetBersih::where('datatype', '1')->get();
        $data_testing_bersih = DatasetBersih::where('datatype', '0')->get();

        $x = NULL; //flag warning
        if ($label_null->count() == 0) {
            if ($data_training_bersih->count() > 0 && $data_testing_bersih->count() > 0) {
                $this->klasifikasi();
                $x = 'aman';
                return view('klasifikasi', [
                    'data_bersih' => $data_testing_bersih,
                    'data_kotor' => $data_testing_kotor,
                    'x' => $x,
                ]);
            } else {
                // echo 'isi dataset kurang training/testing';
                $x = 'dataset';
                return view('klasifikasi', [
                    'data_bersih' => $data_testing_bersih,
                    'data_kotor' => $data_testing_kotor,
                    'x' => $x,
                ]);
            }
        } else {
            $x = 'label';
            return view('klasifikasi', [
                'data_bersih' => $data_testing_bersih,
                'data_kotor' => $data_testing_kotor,
                'x' => $x,
            ]);
        }
    }

    public function klasifikasi()
    {
        // Memanggil dataset training
        $data_training_bersih = DatasetBersih::where('datatype', '1')->get();
        foreach ($data_training_bersih as $data) {
            $tweet[]  = $data->tweet;
        }

        // Memanggil dataset testing
        $data_testing_bersih = DatasetBersih::where('datatype', '0')->get();
        foreach ($data_testing_bersih as $data) {
            $id_tweet[] = $data->id_tweet;
            $test_tweet[]  = $data->tweet;
            $predict_label[]  = $data->label;
        }

        // Memanggil dataset kotor
        $dataset_kotor = Dataset::where('datatype', '1')->get();
        foreach ($dataset_kotor as $data) {
            $manual_label[] = $data->manual_label;
        }

        // Bring Data to wrap words with WordTokenizer()
        $tokenize = new WordTokenizer();
        // inisialisasi fungsi token counter
        $vectorizer = new TokenCountVectorizer($tokenize);

        // Convert it to WordVector (Build the dictionary)
        $vectorizer->fit($tweet);
        $vocabulary = $vectorizer->getVocabulary();

        /* Transform the provided text samples into a vectorized list.
        menghitung term frequency per document (tweet) dari kumpulan token berdasarkan semua tweet */
        $tweet_transform = $tweet;
        $vectorizer->transform($tweet_transform);

        // **** Apply the Tf-idf Transformer ****
        // Once WordVector is obtained, use TF-IDF to search for keywords in the Document.
        $transformer = new TfIdfTransformer($tweet_transform);
        // menghitung weight per document (tweet) dengan rumus w=tf*log(D/df)
        $transformer->transform($tweet_transform);

        // untuk menyimpan bobot tf-idf setiap tweet ke dalam array
        //     $i = 0;
        //     while ($i < count($tweet)) {
        //         $bobot[] = number_format((array_sum($tweet[$i])), 3, '.', '');
        //         $i++;
        //     }

        // **** Bring the results into Naive Bayes with the original Label created ****
        // Initialize classifier
        $classifier = new NaiveBayes();
        // Train classifier
        $classifier->train($tweet_transform, $manual_label);

        //menguji model dengan test tweet
        $vectorizer->transform($test_tweet);
        $transformer->transform($test_tweet);

        //Make a predict to get the result
        $result = $classifier->predict($test_tweet);

        foreach ($id_tweet as $key => $value) {
            $a = DatasetBersih::where('id_tweet', $id_tweet[$key])->first();
            $a->predict_label = $result[$key];
            $a->save();
        }

        //**** Test the Classifier’s Accuracy ****
        //Compare the Result value with Expect Label to calculate the Accuracy
        // $accurcay = Accuracy::score($arr_actualLabels, $arr_predictedLabels);

        //menyimpan nilai bobot pertweet
        //     foreach ($id_tweet as $key => $value) {
        //         $a = DatasetBersih::where('id_tweet', $id_tweet[$key])->first();
        //         $a->weight = $bobot[$key];
        //         $a->save();
        //     }
    }
}
