<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['user_id', 'category_id', 'title', 'body', 'status', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shortBody()
    {
        return Str::limit(strip_tags(nl2br($this->body)), 90);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
