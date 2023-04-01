<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allPosts = [
            [
                'id' => 1,
                'title' => 'Laravel',
                'description' => 'hello laravel',
                'posted_by' => 'Ahmed',
                'created_at' => '2023-04-01 10:00:00',
            ],

            [
                'id' => 2,
                'title' => 'PHP',
                'description' => 'hello php',
                'posted_by' => 'Mohamed',
                'created_at' => '2023-04-01 10:00:00',
            ],

            [
                'id' => 3,
                'title' => 'Javascript',
                'description' => 'hello javascript',
                'posted_by' => 'Mohamed',
                'created_at' => '2023-04-01 10:00:00',
            ],
        ];

        return view('posts.index',[
            'posts' => $allPosts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = [
            'id' => 3,
            'title' => 'Javascript',
            'description' => 'hello javascript',
            'posted_by' => 'Mohamed',
            'created_at' => '2023-04-01 10:00:00',
        ];

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $post = [
            'id' => 3,
            'title' => 'Javascript',
            'description' => 'hello javascript',
            'posted_by' => 'Mohamed',
            'created_at' => '2023-04-01 10:00:00',
        ];

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        return redirect()->route('post.show', ['post' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return redirect()->route('post.index');
    }
}
