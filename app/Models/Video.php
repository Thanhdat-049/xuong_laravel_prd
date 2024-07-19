<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function ratings()
    {
        return $this->morphMany('App\Models\Rating', 'rateable');
    }
}
