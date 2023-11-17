<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment_text',
        'post_id',
        'user_id'
    ];
    public function replies()
    {
        return $this->hasMany(reply::class)->latest();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function likers()
    {
        return $this->belongsToMany(User::class);
    }
}
