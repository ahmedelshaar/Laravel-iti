<?php

namespace App\Http\Controllers;

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
        $allPosts = Post::with('user')->paginate(15);

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
    public function store(Request $request)
    {
        Post::create($request->all());
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
    public function update(Request $request, int $id)
    {
        $post = Post::where('id', $id)->first();
        $post?->update($request->all());
        return redirect()->route('post.show', ['post' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $post = Post::where('id', $id)->first();
        $post?->delete();
        return redirect()->route('post.index');
    }
}
