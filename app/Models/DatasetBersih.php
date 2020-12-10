<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatasetBersih extends Model
{
    use HasFactory;

    protected $table = "dataset_bersih";
    public $timestamps = false;

    protected $fillable = ['id_tweet', 'user', 'tweet', 'date', 'category', 'datatype'];
}
