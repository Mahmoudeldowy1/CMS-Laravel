<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comments.index', ['comments'=>$comments]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $user = Auth::user();
        $inputs = [
            'post_id'=> request('post_id'),
            'author'=> $user->name,
            'email'=> $user->email,
            'body'=> request('body'),
            'file'=>$user->avatar,

        ];

        Comment::create($inputs);

        session()->flash('message_comment','Your message has been submitted and it is waiting moderation');

        return back();

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {

        $post = Post::findOrFail($id);

        $comments = $post->comments;

       return view('admin.comments.show',['comments'=>$comments]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Comment $comment)
    {
        $comment->update(request()->all());

        if (request('is_active') == 0){

            session()->flash('action_comment','Comment was Unapproved');

        }else {
            session()->flash('action_comment','Comment was approved');
        }


        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        session()->flash('deleted_comment','Comment was Deleted');
        return back();
    }
}
