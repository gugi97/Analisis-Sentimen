<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Illuminate\Http\Request;
use App\Models\Preprocessing;
use \Sastrawi\Stemmer\StemmerFactory;
use \Sastrawi\StopWordRemover\StopWordRemoverFactory;

class PreprocessingController extends Controller
{
    public function index()
    {
        $dataset = Dataset::all();
        $casefolding = $this->casefolding();
        $cleansing = $this->cleansing();
        $stopword = $this->stopword_removal();

        return view('preprocessing', [
            'data' => $dataset,
            'casefolding' => $casefolding,
            'cleansing' => $cleansing,
            'stopword' => $stopword,
        ]);
    }

    public function casefolding()
    {
        $result = Dataset::all();
        $tweet_list = [];
        foreach ($result as $sts) {
            //Removing Unicode: menghilangkan pengkodean karakter
            $sts_decode = iconv('ASCII', 'UTF-8//IGNORE', $sts->tweet);
            $dictTweet = [
                'tweet_before' => $sts->tweet,
                'tweet_after' => strtolower($sts_decode),
                'category' => $sts->category,
            ];
            array_push($tweet_list, $dictTweet);
        }
        return $tweet_list;
    }

    public function cleansing()
    {
        $result = $this->casefolding();

        $tweet_list = [];
        foreach ($result as $sts) {
            //remove words that begin with http, @ mentions, '#' symbol, and number [0-9]
            $tweet = preg_replace('/http\S+|@\S+|#\S+|\d+/i', '', $sts['tweet_after']);

            //keep letters only & remove punctuation
            $tweet = preg_replace('/[^a-z]+/i', ' ', $tweet);

            //remove single character
            $tweet = preg_replace('/(^| ).(( ).)*( |$)/', ' ', $tweet);

            //remove whitespace
            $tweet = trim($tweet);
            $tweet = preg_replace('/\s+/i', ' ', $tweet);

            //removing retweet
            $retweet = preg_replace('/^(RT|rt)( @\w*)?[: ]/i', '', $tweet);


            $dictTweet = [
                'tweet_before' => $sts['tweet_before'],
                'tweet_after' => $retweet,
                'category' => $sts['category'],
            ];
            if ($dictTweet['tweet_after'] != ctype_space($dictTweet['tweet_after'])) {
                array_push($tweet_list, $dictTweet);
            }
        }
        return $tweet_list;
    }

    public function stopword_removal()
    {
        $result = $this->cleansing();

        $stemmerFactory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
        $stopword = $stemmerFactory->createStopWordRemover();

        // $dataStopWord = DB::table('stopword')->orderBy('id')->get('word')->toArray();

        $tweet_list = [];
        foreach ($result as $sts) {
            $outputstopword = $stopword->remove($sts['tweet_after']);

            $dictTweet = [
                'tweet_before' => $sts['tweet_before'],
                'tweet_after' => $outputstopword,
                'category' => $sts['category'],
            ];
            array_push($tweet_list, $dictTweet);
        }
        return $tweet_list;
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
        //
    }

    public function destroy($id)
    {
        //
    }
}
