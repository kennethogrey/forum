<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function topic(){
        return $this->hasMany(Topic::class);
    }

    public function post(){
        return $this->hasMany(Post::class);
    }
}
