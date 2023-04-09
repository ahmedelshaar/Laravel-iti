@extends('layouts.dashboard')

@section('title') Show @endsection

@section('content')
    <h1>Post Details <a class="btn btn-primary" href="{{ route('post.edit', $post['id']) }}">Edit</a></h1>
    <br/>
    <img src="{{ asset('images/' . $post->image) }}" alt="" class="w-50 d-block mx-auto">
    <div class="card mt-4">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post['title']}}</h5>
            <p class="card-text">Description: {{$post['description']}}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">{{$post['user']['name']}}</h5>
        </div>
    </div>

    <h2>Comments</h2>

    <div class="card mt-4 text-center">
        <div class="card-header">
            <h1>Comments</h1>
        </div>
        <div class="card-body">
            @if ($post->comments->count() > 0)
                @foreach ($post->comments as $comment)
                    <div class="commentContainer">
                        <input type="hidden" name="commentId" class="commentId" value="{{ $comment->id }}">
                        <p class="card-text fs-3">{{ $comment->body }}</p>
                        <a class="btn btn-primary" data-bs-toggle="modal"  data-bs-target="#updateModal{{ $comment->id }}">Edit</a>
                        <form action="{{ route('post.comment.delete', $comment->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                    <div class="modal fade" id="updateModal{{ $comment->id }}" tabindex="-1"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Comment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="{{ route('post.comment.update', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="text" class="form-control" name="body"
                                               value="{{ $comment->body }}">
                                    </div>
                                    <div class="modal-footer ">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="card-text">No comments</p>
            @endif
        </div>
    </div>
    <div class="card mt-4 text-center">
        <div class="card-header">
            <h1>Add Comment</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('post.comment.store', $post->id) }}" method="POST">
                @csrf
                <div class="form-outline">
                    <textarea class="form-control" id="" name="body" rows="4"></textarea>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-success fs-3">
                        Comment
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
