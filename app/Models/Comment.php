<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Collections\CommentCollection;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_name',
        'content',
        'parent_id'
    ];

    public function newCollection(array $models = [])
    {
        return new CommentCollection($models);
    }
}
