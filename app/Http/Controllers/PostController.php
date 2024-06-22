<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $param['pageName'] = "Blog Post";
        $param['posts'] = Post::all();
        return view('posts.index', $param);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $param['pageName'] = "New Blog Post";
        $param['posts'] = Post::all();
        return view('posts.new', $param);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validating user's input for correctness
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:posts'],
            'postbody' => ['required', 'string']
        ]);

        try {
            $post = new Post; //assign the post object with the following request coming from the form data
            $post->slug = $request['title'];
            $post->title = $request['title'];
            $post->post = $request['postbody'];
            $post->user_id = Auth::user()->id; //Get the Authenticatd user as the one making the post
            $post->status = 1; //if we want admin to verify or vet the post before making it visible we set the default here as well aside the DB default value for the field.
            $post->save(); //Save a new instance of the post model
            return redirect()->route('blog.index')->with('success', "New blog post successfully created");
        } catch (\Exception $e) {
            // return $e->getMessage();
            return back()->withInput()->with('error', "Blog post was not created");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $param['pageName'] = "New Blog Post";
        $param['posts'] = Post::all();
        $param['comments'] = PostComment::where('post_id', $id)->orderBy('created_at', 'desc')->get();
        $param['post'] = Post::findOrFail($id);
        return view('posts.onepost', $param);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post, $id)
    {
        $param['pageName'] = "Editing Blog Post";
        $param['post'] = Post::find($id);
        return view('posts.edit', $param);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Validating user's input for correctness
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:posts'],
            'postbody' => ['required', 'string']
        ]);

        try {
            $post = Post::find($request['postId']); //assign the post object with the following request coming from the form data
            $post->slug = $request['title'];
            $post->title = $request['title'];
            $post->post = $request['postbody'];
            $post->user_id = Auth::user()->id;
            $post->save(); //Save a new instance of the post model
            return back()->with('success', "Blog post successfully updated");
        } catch (\Exception $e) {
            return back()->withInput()->with('error', "Could not update blog post");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, $id)
    {
        $post = Post::find($id);
        try {
            $post->delete();
            return back()->with('success', "post deleted successfully"); //Notify the user of the successful operation of deleting the post
        } catch (\Exception $e) {
            return back()->with('error', "Couldn't delete this post"); //Custom error instead of using the $e->getMessage()
        }
    }

    public function addcomment(Request $request)
    {

        // dd($request);
        $request->validate([
            'comment' => ['required', 'string'],
        ]); //Validating user submission

        try {
            $comment = new PostComment;
            $comment->post_id = $request['postId'];
            $comment->comment = $request['comment'];
            // $comment->comment_id = $request['commentId'];//Due to time constriants will not implement comment of comment
            $comment->save();
            return back()->with('success', "comment submited successfully");
        } catch (\Exception $e) {
            // return $e->getMessage();
            return back()->withInput()->with('error', "Comment was not created"); //Custom error instead of using the $e->getMessage()
        }
    }
}
