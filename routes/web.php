<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Route::resource('testingkotor', 'DatasetTestingKotorController');
Route::resource('trainingkotor', 'DatasetTrainingKotorController');

Route::resource('slangword', 'SlangWordController');
Route::resource('stopword', 'StopWordController');

Route::resource('preprocessing', 'PreprocessingController');