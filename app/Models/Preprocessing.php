<?php

namespace App\Models;

use App\Models\Dataset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\VarDumper\Cloner\Data;

class Preprocessing extends Model
{
    use HasFactory;

    protected $table = "dataset_bersih";
    public $timestamps = false;

    protected $fillable = ['id_tweet', 'user', 'tweet', 'date', 'category', 'datatype'];

}
