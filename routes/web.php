<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/klasifikasi', 'KlasifikasiController@index')->name('klasifikasi');
Route::get('/akurasi', 'AkurasiController@index')->name('akurasi');
Route::get('/visualisasi', 'VisualisasiController@index')->name('visualisasi');

Route::resource('testingkotor', 'DatasetTestingKotorController');
Route::resource('trainingkotor', 'DatasetTrainingKotorController');

Route::resource('slangword', 'SlangWordController');
Route::resource('stopword', 'StopWordController');
Route::resource('kamus', 'KamusController');
Route::delete('kamus/hapus/{id}', 'KamusController@delete')->name('kamus.delete');;

Route::resource('preprocessing', 'PreprocessingController');
Route::resource('labelling', 'LabelingController');
