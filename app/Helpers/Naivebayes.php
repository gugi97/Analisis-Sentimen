<?php

namespace Naivebayes;

use Sastrawi\Stemmer\StemmerFactory;

class Naivebayes
{
    private $slangs, $stopwords, $stemmer_factory, $stemmer;
    public $datasets, $words, $word_counts, $data_property;
    function __construct($slangs, $stopwords)
    {
        $this->slangs = $slangs;
        $this->stopwords = $stopwords;
        $this->stemmer_factory =  new StemmerFactory();
        $this->stemmer = $this->stemmer_factory->createStemmer();
        $this->datasets = null;
        $this->words = null;
        $this->word_counts = null;
        $this->data_property = [
            'data_total' => 0,
            'data_positif' => 0,
            'data_negatif' => 0
        ];
    }

    public function preprocessing(String $text)
    {
        $regex_url = "/(?:(?:(?:(?:(?:http|https)\:\/\/)|(?:www\.))[a-zA-Z0-9]{1,}(?:[\.\/\-\_][a-zA-Z0-9]{1,}){1,})|(?:[a-zA-Z0-9]{1,}(?:\.[a-zA-Z0-9]{1,}){1,}(?:[\.\/\-\_][a-zA-Z0-9]{1,}){0,}))/";
        $regex_alphabet = "/[^a-z]+/";
        // to lower
        $text = strtolower($text);
        // remove url
        $text = preg_replace($regex_url, ' ', $text);
        // Remove except alphabet
        $text = preg_replace($regex_alphabet, ' ', $text);

        // change slang
        $text = str_replace(array_keys($this->slangs), $this->slangs, $text);

        // Stemming with Sastrawi
        $text = $this->stemmer->stem($text);

        // remove stopword
        $text_explode = explode(' ', $text);
        $text_explode = array_diff($text_explode, $this->stopwords);
        $text = implode(' ', $text_explode);

        // Tokenization
        $text_tokenization = explode(' ', $text);
        $text_tokenization = array_unique($text_tokenization);
        $text = implode(' ', $text_tokenization);
        return $text;
    }

    /**
     * @param $datasets must contain text and label
     *  */
    public function count(array $datasets)
    {
        //mengisi variabel $this->datasets dengan parameter $datasets
        $this->datasets = $datasets;
        $dataset_preprocessed = [];
        foreach ($this->datasets as $dataset) {
            //mengisi array $dataset_preprocessed berdasarkan dataset dengan text yang sudah di preprocessing
            $dataset_preprocessed[] =
                [
                    'text' => $this->preprocessing($dataset['text']),
                    'label' => $dataset['label']
                ];
        }
        $words = [];
        foreach ($dataset_preprocessed as $dataset) {
            //memecah kalimat menjadi perkata dari setiap data pada dataset text
            $text_tokenized = explode(' ', $dataset['text']);
            //menambahkan setiap kata kedalam array
            $words = array_merge($text_tokenized, $words);
        }
        // hanya menyimpan unique $words, jika ada kata yang sama dihilangkan
        $words = array_unique($words);

        //mengisi variabel public $this->words dengan hasil $words
        $this->words = $words;

        $word_count = [];
        foreach ($this->words as $word) {
            //mengisi setiap $word_count[perkata] dengan array pos&neg = 0
            $word_count[$word] = [
                'positif' => 0,
                'negatif' => 0
            ];
            
            foreach ($dataset_preprocessed as $dataset) {
                //jika ada kata pada $dataset['text'] yang sama dengan $word (perkata)
                // print_r($dataset['text']." - ".$word);echo "<br>";
                if (strpos($dataset['text'], $word)) {
                    // echo"MASUK_____| <br>";
                    //jika label $dataset (huruf kecil) sama
                    if (strtolower($dataset['label']) == 'positif') {
                        //tambah satu pada $word_count[perkata] untuk label positif
                        $word_count[$word]['positif'] += 1;
                    } else {
                        //tambah satu pada $word_count[perkata] untuk label negatif
                        $word_count[$word]['negatif'] += 1;
                    }
                }
                // echo"____|KELUAR <br>";
            }
            // echo"<br>";
            
            if ($word_count[$word]['positif'] == 0 && $word_count[$word]['negatif'] == 0) {
                unset($word_count[$word]);
            }
            
        }

        /*memasukan data word_count kedalam variabel public word_count
        dimana berisi array per kata dengan masing-masing count label positif & negatif*/
        $this->word_counts = $word_count;

        //total data dari dataset yang akan diklasifikasikan
        $total_data = count($dataset_preprocessed);

        //mencari dan membandingkan dari dataset yang memiliki kesamaan label positif
        $positif_data = array_intersect(array_column($this->datasets, 'label'), ['Positif']);        
        //menghitung jumlah data yang berlabel positif
        $positif_data = count($positif_data);
        
        //mencari dan membandingkan dari dataset yang memiliki kesamaan label negatif
        $negatif_data = array_intersect(array_column($this->datasets, 'label'), ['Negatif']);
        //menghitung jumlah data yang berlabel negatif
        $negatif_data = count($negatif_data);

        //mengisi variabel data_property berdasarkan count data total, positif, & negatif
        $this->data_property = [
            'data_total' => $total_data,
            'data_positif' => $positif_data,
            'data_negatif' => $negatif_data
        ];
        
        return $this;
    }

    public function setDataProperty(array $word_count, int $data_total, int $data_positif, int $data_negatif)
    {
        $this->word_counts = $word_count;
        $this->data_property = [
            'data_total' => $data_total,
            'data_positif' => $data_positif,
            'data_negatif' => $data_negatif
        ];
        return $this;
    }

    /**
     * @param $text this function require word counts
     *  */
    public function calculate(String $text)
    {
        $total_data = $this->data_property['data_total'];
        $positif_data = $this->data_property['data_positif'];
        $negatif_data = $this->data_property['data_negatif'];
        $positif_prob = $positif_data / $total_data;
        $negatif_prob = $negatif_data / $total_data;

        $text_tokenized = explode(' ', $text);
        
        $word_count = array_intersect_key($this->word_counts, array_flip($text_tokenized));
        dd($word_count);
        // document probability
        $doc_positif_prob = 1;
        $doc_negatif_prob = 1;
        $doc_prob = 1;
        foreach ($word_count as $key => $item) {
            $doc_prob *= (($item['positif'] + $item['negatif']) / $total_data);
            $doc_positif_prob *= (($item['positif']) / $positif_data);
            $doc_negatif_prob *= (($item['negatif']) / $negatif_data);
        }
        $doc_sent_positif_prob = ($doc_positif_prob * $positif_prob) / $doc_prob;
        $doc_sent_negatif_prob = ($doc_negatif_prob * $negatif_prob) / $doc_prob;

        $sum_of_result = $doc_sent_negatif_prob + $doc_sent_positif_prob;
        $res_positif_prob = $doc_sent_positif_prob / $sum_of_result;
        $res_negatif_prob = $doc_sent_negatif_prob / $sum_of_result;

        return [
            'label' => $res_positif_prob >= $res_negatif_prob ? 'positif' : 'negatif',
            'positif' => $res_positif_prob,
            'negatif' => $res_negatif_prob,
        ];
    }

    /**
     *
     * @param $actual_predict must contain array with key actual and predict
     * */
    function confusion_matrix(array $actual_predict)
    {
        // clockwise'
        $total_data = count($actual_predict);
        $TP = 0; //actual positif predict positif
        $FP = 0; //actual negatif predict positif
        $TN = 0; //actual negatif predict negatif
        $FN = 0; //actual positif predict negatif

        foreach ($actual_predict as $item) {
            if ($item['actual'] == 'positif' && $item['predict'] ==  'positif') {
                $TP += 1;
            }
            if ($item['actual'] == 'negatif' && $item['predict'] ==  'positif') {
                $FP += 1;
            }
            if ($item['actual'] == 'negatif' && $item['predict'] ==  'negatif') {
                $TN += 1;
            }
            if ($item['actual'] == 'positif' && $item['predict'] ==  'negatif') {
                $FN += 1;
            }
        }
        $res = [
            'accuracy' => 0,
            'recall' => 0,
            'precision' => 0,
            'f1' => 0
        ];
        try {
            $res['accuracy'] = ($TP + $TN) / $total_data;
        } catch (\Throwable $th) {
        }

        try {
            $res['recall'] = $TP / ($TP + $FN);
        } catch (\Throwable $th) {
        }

        try {
            $res['precision'] = $TP / ($TP + $FP);
        } catch (\Throwable $th) {
        }
        try {
            $res['f1'] = 2 * (($res['precision'] * $res['recall']) / ($res['precision'] + $res['recall']));
        } catch (\Throwable $th) {
        }
        return $res;
    }
}
