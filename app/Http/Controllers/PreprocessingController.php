<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\Slangword;
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
        $normalization = $this->normalization();
        $stopword = $this->stopword_removal();

        return view('preprocessing', [
            'data' => $dataset,
            'casefolding' => $casefolding,
            'cleansing' => $cleansing,
            'normalization' => $normalization,
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

    public function normalization()
    {
        // $slangwords = Slangword::all()->mapWithKeys(function ($item, $index) {
        //     return [$item->slang => $item->mean];
        // })->toArray();

        $slangwords = Slangword::all();
        foreach ($slangwords as $row) {
            $slang[]  = $row->slang;
            $mean[] = $row->mean;
        }

        $i = 0;
        $tweet_list = [];
        $result = $this->cleansing();

        foreach ($result as $sts) {
            // Convert SlangWords
            $tweet_string = $sts['tweet_after'];
            $split = explode(' ', $tweet_string);

            foreach ($slang as $index => $slangword) { //14 kali karena slangword ada 14
                foreach ($split as $kata) { //ngulang sebanyak jumlah kata dalam 1 kalimat
                    if ($kata == $slangword) {
                        $tweet_string = str_replace($kata, $mean[$index], $tweet_string);
                    }
                }
            }

            // $tweet_slang = str_replace(array_keys($slangwords), $slangwords, $tweet_string);
            // $sts['tweet_after'] = implode(" ", $tweet_slang);

            $dictTweet = [
                'tweet_before' => $sts['tweet_before'],
                'tweet_after' => $tweet_string,
                'category' => $sts['category'],
            ];
            array_push($tweet_list, $dictTweet);
        }
        return $tweet_list;
    }

    public function stopword_removal()
    {
        $result = $this->normalization();

        //stopword removal - menghapus kata yang tidak penting
        $stemmerFactory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
        $stopword = $stemmerFactory->createStopWordRemover();

        //stimming - mengubah ke kata dasar
        $stemmer = new \Sastrawi\Stemmer\StemmerFactory();
        $stem = $stemmer->createStemmer();

        // $dataStopWord = DB::table('stopword')->orderBy('id')->get('word')->toArray();

        $tweet_list = [];
        foreach ($result as $sts) {
            $outputstopword = $stopword->remove($sts['tweet_after']);
            $outputstem = $stem->stem($outputstopword);

            $dictTweet = [
                'tweet_before' => $sts['tweet_before'],
                'tweet_after' => $outputstem,
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
