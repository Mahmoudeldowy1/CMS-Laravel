<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{

    public function index()
    {
        $posts = Post::paginate(5);
        return view('admin.posts.index', compact('posts'));
    }


    public function show(Post $post)
    {
        $comments = $post->comments()->whereIsActive(1)->get();
        return view('blog-post', compact('post','comments'));
    }

    public function create()
    {
//        $this->authorize('create',Post::class);

        $categories = Category::all();
        return view('admin.posts.create' , compact('categories'));
    }

    public function store()
    {

//        $this->authorize('create',Post::class);

        $inputs = request()->validate([
            'title'      => 'required | min:8 | max:255',
            'post_image' => 'file',
            'body'       => 'required',
            'category_id'=>'required'
        ]);

        if (request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth::user()->posts()->create($inputs);

        session()->flash('post-created-message','Post with title'.$inputs['title'] . 'was created');

        return redirect()->route('post.index');

    }

    public function edit(Post $post)
    {

//        $this->authorize('view',$post);
        $categories = Category::all();

       return view('admin.posts.edit',[
           'post'=>$post,
           'categories'=>$categories
           ]);
    }

    public function update(Post $post)
    {

        $inputs = request()->validate([
            'title'      => 'required | min:8 | max:255',
            'post_image' => 'file',
            'body'       => 'required',
            'category_id'=>'required'
        ]);

        if (request('post_image')){
            $post->post_image = $inputs['post_image'] = request('post_image')->store('images');
        }

        $post->title = $inputs['title'];
        $post->body  = $inputs['body'];

//        $this->authorize('update',$post);

        auth::user()->posts()->save($post);

        session()->flash('post-updated-message','Post was Updated');

        return redirect()->route('post.index');
    }


    public function destroy(Post $post)
    {
//        $this->authorize('delete',$post);

        $post->delete();

        session()->flash('post-deleted-message','Post was Deleted');

        return back();
    }

}
