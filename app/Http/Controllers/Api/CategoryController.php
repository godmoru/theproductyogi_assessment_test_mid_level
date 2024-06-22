<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCategoryResource;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Response as Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $categories = PostCategory::paginate(10);
            if (!$categories) {
                return Response::json(['error' =>'Cannot find blog category', 'statusCode:'=>400, 'Status:'=>false]);
            }
            return Response(['success Response: '=>'Categories Retrieved', 'categories:'=>PostCategoryResource::collection($categories), 'statusCode:'=>200, 'Status:'=>true]);
        }catch(\Exception $e){
            return Response::json(['error' =>'Cannot retrieve blog category', 'statusCode:'=>400, 'Status:'=>false]);
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
        $validatedData = $request->validate([
            'description' => 'required|max:255',
            'name' => 'required|unique:post_categories',
        ]);

        $category = PostCategory::create($validatedData);
        return response()->json($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $category = PostCategory::query()->where('id', $id)->first();
            if (is_null($category)) {
                return Response::json(['error Response:' =>'Cnnot find category', 'statusCode: '=>400, 'status:'=>false]);
            }
            return Response::json(['success Response:' =>$category, 'statusCode: '=>200, 'status:'=>true]);

            }catch (\Exception $e){
                return Response::json(['error Response:' =>$e->getMessage(), 'statusCode: '=>400, 'status:'=>false]);
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
                return Response::json(['error Response:' =>'Id cannot be empty', 'statusCode: '=>400, 'status:'=>false]);
            }
            if (empty($params->name)) {
                return Response::json(['error Response:' =>'name cannot be empty', 'statusCode: '=>400, 'status:'=>false]);
            }
            if (empty($params->description)) {
                return Response::json(['error Response:' =>'post body cannot be empty', 'statusCode: '=>400, 'status:'=>false]);
            }
            $category = PostCategory::findOrFail($id);
            if (is_null($category)) {
                return Response::json(['error Response:' =>'Cannot find blog category', 'statusCode:'=>400, 'status:'=>false]);
            }
             $category->update(
                [
                    'name' => $params->name,
                    'description' => $params->description,
                ]
            );
            return Response::json(['success Response: ' =>'Editted '.$category->name, 'statusCode: '=>200, 'status:'=>true]);

        } catch (\Exception $e) {
            return Response::json(['error Response:' =>$e->getMessage(), 'statusCode: '=>400, 'status:'=>false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $category = PostCategory::query()->where('id', $id)->first();
            if (is_null($category)) {
                return Response::json(['error' =>'Cannot find blog category', 400, false]);
            }
            $category->delete();
            return Response::json(['success Response: ' =>'Deleted blog '.$category->name, 'statusCode: '=>200, 'status:'=>true]);

        } catch (\Exception $e) {
            return Response::json(['error Response:' =>$e->getMessage(), 'statusCode: '=>400, 'status:'=>false]);
        }
    }
}
