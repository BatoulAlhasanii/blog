<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\Comment\CreateCommentRequest;

class CommentController extends Controller
{
    public function index()
    {
        $grouped_comments = Comment::orderBy('id', 'desc')
            ->get()
            ->groupByParent();
        
        return response()->json(['grouped_comments' => $grouped_comments]); 
    }

    public function store(CreateCommentRequest $request)
    {
        $comment = Comment::create($request->validated());

        return response()->json([
            'message' => 'Comment Created Successfully',
            'comment' => $comment
        ], 201); 
    }
}
