<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product_menus';
    protected $fillable = [
        'icon',
        'image',
        'description',
        'titlefiture1',
        'fiture1',
        'titlefiture2',
        'fiture2',
        'titlefiture3',
        'fiture3',
        'titlefiture4',
        'fiture4',
        'titlefiture5',
        'fiture5',
        'titlefiture6',
        'fiture6'
    ];
}
