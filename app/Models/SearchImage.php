<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchImage extends Model
{
    protected $table = 'search_images';

    protected $fillable = ['image_data'];
}
