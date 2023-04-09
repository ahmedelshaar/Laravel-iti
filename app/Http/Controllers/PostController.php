<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allPosts = Post::with('user')->orderBy('id', 'Desc')->paginate(15);

        return view('posts.index',[
            'posts' => $allPosts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::select('id', 'name')->get();
        return view('posts.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            Post::create($request->except('_token', 'image') + ['image' => $imageName]);
        }else{
            Post::create($request->except('_token'));
        }
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $post = Post::where('id', $id)->with('user')->first();
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $post = Post::where('id', $id)->first();
        if(!$post) {
            return redirect()->route('post.index');
        }
        $users = User::select('id', 'name')->get();
        return view('posts.edit', ['post' => $post, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, int $id)
    {
        $post = Post::where('id', $id)->first();
        if(!$post) {
            return redirect()->route('post.index');
        }
        if($request->hasFile('image')) {
            $oldImage = public_path('images') . '/' . $post->image;
            if(file_exists($oldImage)) {
                @unlink($oldImage);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $post->update($request->except('_token', 'image') + ['image' => $imageName]);
        }else{
            $post->update($request->all());
        }
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $post = Post::where('id', $id)->first();
        $oldImage = public_path('images') . '/' . $post?->image;
        if(file_exists($oldImage)) {
            @unlink($oldImage);
        }
        $post?->delete();
        return redirect()->route('post.index');
    }

    public function storeComment(Request $request, int $id)
    {
        $post = Post::where('id', $id)->first();
        $post?->comments()->create($request->all());
        return redirect()->route('post.show', ['post' => $id]);
    }

    public function deleteComment(int $commentId)
    {
        Comment::where('id', $commentId)->delete();
        return redirect()->back();
    }

    public function updateComment(Request $request, int $commentId)
    {
        Comment::where('id', $commentId)->update([
            'body' => $request->body,
        ]);
        return redirect()->back();
    }
}
