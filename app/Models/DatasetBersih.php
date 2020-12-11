<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatasetBersih extends Model
{
    use HasFactory;

    protected $table = "dataset_bersih";
    public $timestamps = false;

    protected $primaryKey = "id_tweet" ;

    protected $fillable = ['id_tweet', 'user', 'tweet', 'date', 'category', 'datatype', 'label'];
}
