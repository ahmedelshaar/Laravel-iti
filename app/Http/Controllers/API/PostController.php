<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::with('user')->orderBy('id', 'Desc')->paginate(15);
        return PostResource::collection($allPosts);
    }

    public function show(int $id)
    {
        $post = Post::where('id', $id)->with('user')->first();
        return new PostResource($post);
    }

    public function store(PostStoreRequest $request)
    {
        $post = null;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $post = Post::with('user')->create($request->except('_token', 'image') + ['image' => $imageName]);
        }else{
            $post = Post::with('user')->create($request->except('_token'));
        }
        return new PostResource($post);
    }

}
