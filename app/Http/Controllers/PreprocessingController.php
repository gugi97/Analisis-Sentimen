<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\Slangword;
use App\Models\DatasetBersih;
use App\Models\Preprocessing;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Sastrawi\Stemmer\StemmerFactory;
use \Sastrawi\StopWordRemover\StopWordRemoverFactory;

class PreprocessingController extends Controller
{
    public function index(Request $request)
    {
        $dataset = Dataset::all();
        $filtering = $this->filtering();
        $stemming = $this->stemming();

        return view('preprocessing', [
            'dataset' => $dataset,
            'filtering' => $filtering,
            'stemming' => $stemming,
        ]);
    }

    public function show($id)
    {
    }

    public function filtering()
    {
        $result = Dataset::all();

        $slangwords = Slangword::all();
        foreach ($slangwords as $row) {
            $slang[]  = $row->slang;
            $mean[] = $row->mean;
        }

        $i = 0;
        $tweet_list = [];
        foreach ($result as $sts) {
            /***** CASEFOLDING */
            //Removing Unicode: menghilangkan pengkodean karakter
            $sts_decode = iconv('ASCII', 'UTF-8//IGNORE', $sts->tweet);
            //mengubah kata menjadi lowercase
            $sts_lower = strtolower($sts_decode);

            /**** CLEANSING */
            //remove words that begin with http, @ mentions, '#' symbol, and number [0-9]
            $sts_removechar = preg_replace('/http\S+|@\S+|#\S+|\d+/i', '', $sts_lower);
            //keep letters only & remove punctuation
            $sts_removepunc = preg_replace('/[^a-z]+/i', ' ', $sts_removechar);
            //remove single character
            $sts_removesingle = preg_replace('/(^| ).(( ).)*( |$)/', ' ',  $sts_removepunc);
            //remove whitespace
            $sts_removespace = trim($sts_removesingle);
            $sts_removespace = preg_replace('/\s+/i', ' ', $sts_removespace);
            //removing retweet
            $sts_cleansing = preg_replace('/^(RT|rt)( @\w*)?[: ]/i', '', $sts_removespace);

            /**** NORMALIZATION */
            //memperbaiki ejaan, handling slangword
            $tweet_string = $sts_cleansing;

            //amp -> " "
            $tweet_string = preg_replace('/\s(amp*)\s/i', ' ', $tweet_string);

            // memecah kalimat menjadi kumpulan kata (token)
            $split = explode(' ', $tweet_string);
            // pengecekan slangword
            foreach ($slang as $index => $slangword) { //diulang sebanyak jumlah list slangword
                foreach ($split as $index_2 => $kata) { //diulang sebanyak jumlah kata(token) dalam 1 kalimat
                    if ($kata == $slangword) {
                        //mereplace kata slang menjadi ejaan yang baku
                        $split[$index_2] = $mean[$index];
                    }
                }
                $tweet_string = implode(" ", $split);
            }

            $dictTweet = [
                'id_tweet' => $sts->id_tweet,
                'user' => $sts->user,
                'tweet_before' => $sts->tweet,
                'tweet_lower' => $sts_lower,
                'tweet_cleansing' => $sts_cleansing,
                'tweet_normalization' => $tweet_string,
                'date' => $sts->date,
                'category' => $sts->category,
                'datatype' => $sts->datatype,
            ];
            //menghapus row atau tweet yang hanya berisi spasi
            if ($sts_cleansing != ctype_space($sts_cleansing)) {
                array_push($tweet_list, $dictTweet);
            }
        }
        return $tweet_list;
    }

    public function stemming()
    {
        $result = $this->filtering();

        //stopword removal - menghapus kata yang tidak penting
        $stemmerFactory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
        $stopword = $stemmerFactory->createStopWordRemover();

        //stimming - mengubah kata menjadi kata dasar (lemmalization)
        $stemmer = new \Sastrawi\Stemmer\StemmerFactory();
        $stem = $stemmer->createStemmer();

        // $dataStopWord = DB::table('stopword')->orderBy('id')->get('word')->toArray();

        $tweet_list = [];
        foreach ($result as $sts) {
            $outputstopword = $stopword->remove($sts['tweet_normalization']);
            $outputstem = $stem->stem($outputstopword);

            $dictTweet = [
                'id_tweet' => $sts['id_tweet'],
                'user' => $sts['user'],
                'tweet_before' => $sts['tweet_before'],
                'tweet_lower' => $sts['tweet_lower'],
                'tweet_cleansing' => $sts['tweet_cleansing'],
                'tweet_normalization' => $sts['tweet_normalization'],
                'tweet_stemming' => $outputstem,
                'date' => $sts['date'],
                'category' => $sts['category'],
                'datatype' => $sts['datatype'],
            ];
            if ($outputstem != ctype_space($outputstem)) {
                array_push($tweet_list, $dictTweet);
            }
        }
        return $tweet_list;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $result = $this->stemming();

        foreach ($result as $sts) {
            $a = DB::table('dataset_bersih')
                ->where('id_tweet', $sts['id_tweet'])->insertOrIgnore([
                    'id_tweet' => $sts['id_tweet'],
                    'user' => $sts['user'],
                    'tweet' => $sts['tweet_stemming'],
                    'date' => $sts['date'],
                    'category' => $sts['category'],
                    'datatype' => $sts['datatype'],
                ]);
        }
        return redirect()->back()->with('success', 'Data Saved');
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
