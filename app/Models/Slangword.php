<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slangword extends Model
{
    use HasFactory;

    protected $table = "slangword";
    public $timestamps = false;
}
