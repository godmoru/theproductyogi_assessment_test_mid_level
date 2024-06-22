<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\Tag;

class PostComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'comment_id',
        'comment',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function tags(){
        return $this->hasMany(Tag::class);
    }
}
