<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //relate post model to category model
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
