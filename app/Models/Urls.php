<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Urls extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'crawled',
        'depth'
    ];
}
