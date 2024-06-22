<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Response as Response;


class PostController extends Controller
{

    // use Response;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $posts = Post::paginate(10);
            return PostResource::collection($posts);
            // return Response::json([$posts, 200, true]);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            $validated = $request->validate([
                'title' => 'required|string|unique:posts|min:5|max:100',
                'postbody' => 'required|string|min:5|max:2000',
                'category' => 'required|integer|max:30'
            ]);
        try{
            // Create slug from title provide
            $validated['slug'] = Str::slug($validated['title'], '-');

            // Create and save post with validated data
            $post = Post::create($validated);
            //Return the post Resource in json response
            return response()->json($post);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $post = new PostResource(Post::findOrFail($id));
                if (is_null($post)) {
                    return Response::json(['error Response:' =>'Cnnot find blog', 400, false]);
                }
            return Response::json(['post:'=>$post, 'statusCode: '=>200, 'status:'=>true]);

            }catch (\Exception $e){
                return Response::json(['error Response:'=>'Post not found', 400, false]);
            }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $params = json_decode($request->getContent());
            if (empty($params->id)) {
                return Response::json(['error Response:' =>'Id cannot be empty', 'statusCode: '=>400, 'status:'=>true]);
            }
            if (empty($params->title)) {
                return Response::json(['error Response:' =>'Title cannot be empty', 'statusCode: '=>400, 'status:'=>true]);
            }
            if (empty($params->postbody)) {
                return Response::json(['error Response:' =>'post body cannot be empty', 'statusCode: '=>400, 'status:'=>true]);
            }
            $post = Post::findOrFail($id);
            if (is_null($post)) {
                return Response::json(['error Response:' =>'Cannot find blog', 'statusCode: '=>400, 'status:'=>true]);
            }
             $post->update(
                [
                    'title' => $params->title,
                    'post' => $params->postbody,
                ]
            );
            return Response::json(['success Response:' =>'Successfully edited post', 'post'=>$post, 'statusCode: '=>200, 'status:'=>true]);

        } catch (\Exception $e) {
            return Response::json(['error Response:' =>$e->getMessage(), 'statusCode: '=>400, 'status:'=>true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $post = Post::query()->where('id', $id)->first();
            if (is_null($post)) {
                return Response::json(['error' =>'Cannot find blog post', 400, false]);
            }
            $post->delete();
            return Response::json(['success Response: ' =>'Deleted blog '.$post->title, 'statusCode: '=>200, 'status:'=>true]);

        } catch (\Exception $e) {
            return Response::json(['error Response:' =>$e->getMessage(), 'statusCode: '=>400, 'status:'=>true]);
        }
    }
}
