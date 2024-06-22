<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostComment;
use App\Models\Tag;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'post',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function tags(){
        return $this->hasMany(Tag::class);
    }

}