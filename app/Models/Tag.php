<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\PostComment;

class Tag extends Model
{
    use HasFactory;

    public function post(){
        return $this->belongsToManyThrough(Post::class);
    }

    public function comment(){
        return $this->belongsToManyThrough(PostComment::class);
    }
}
