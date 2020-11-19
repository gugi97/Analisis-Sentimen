<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    use HasFactory;

    protected $table = "dataset_kotor";
    public $timestamps = false;

    protected $fillable = ['id_tweet', 'user', 'tweet', 'date', 'category', 'datatype'];
}
