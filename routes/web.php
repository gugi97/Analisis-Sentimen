<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/tfidf', 'TfidfController@index')->name('tfidf');

Route::resource('testingkotor', 'DatasetTestingKotorController');
Route::resource('trainingkotor', 'DatasetTrainingKotorController');

Route::resource('slangword', 'SlangWordController');
Route::resource('stopword', 'StopWordController');

Route::resource('preprocessing', 'PreprocessingController');
Route::resource('labelling', 'LabelingController');