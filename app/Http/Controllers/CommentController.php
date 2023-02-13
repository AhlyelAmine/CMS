<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Post;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store','destroy');
       // $this->authorizeResource(User::class, 'user');
    }

       /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post,$id)
    {
        $comment= Comment::findOrFail($id);
        $this->authorize("delete", $comment);
        $comment->delete();
        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request,Post $post)
    {
          
        $post->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id
        ]);

        return redirect()->back();
    }
  
}
