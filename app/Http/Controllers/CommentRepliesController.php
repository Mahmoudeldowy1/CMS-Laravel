<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function createReply()
    {
        $user = Auth::user();
        CommentReply::create([
            'comment_id'=> request('post_id'),
            'author'=> $user->name,
            'email'=> $user->email,
            'body'=> request('body'),
            'file'=>$user->avatar,
        ]);

        session()->flash('reply_message','Your Reply has been submitted and it is waiting moderation');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        $replies = $comment->replies->all();

        return view('admin.comments.replies.show',['replies'=>$replies]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentReply $reply)
    {
        $reply->update(request()->all());

        if (request('is_active') == 0){

            session()->flash('action_reply','Reply was Unapproved');

        }else {
            session()->flash('action_reply','Reply was approved');
        }


        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentReply $reply)
    {
        $reply->delete();

        session()->flash('deleted_reply','Comment was Reply');
        return back();
    }
}
