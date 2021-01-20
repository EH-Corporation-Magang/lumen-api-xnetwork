<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DigitalAds extends Model
{
    protected $fillable = [
        'image', 'title', 'subtitle', 'description'
    ];
}
