@extends('layouts.app')

@section('title') Create @endsection

@section('content')
    <form action="{{route('post.update', $post['id'])}}" method="post">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input  type="text" class="form-control" value="{{ $post['title'] }}" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea class="form-control"  rows="3">{{$post['description']}}</textarea>
        </div>

        <div class="mb-3">
            <label  class="form-label">Post Creator</label>
            <select class="form-control">
                <option @if($post['posted_by'] == "Ahmed") selected @endif value="1">Ahmed</option>
                <option @if($post['posted_by'] == "Mohamed") selected @endif value="2">Mohamed</option>
            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
