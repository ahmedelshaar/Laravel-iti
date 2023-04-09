@extends('layouts.dashboard')

@section('title') Create @endsection

@section('content')
    @include('inc.error')
    <form action="{{route('post.update', $post['id'])}}" method="post" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input  type="text" class="form-control" name="title" value="{{ $post['title'] }}" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3">{{$post['description']}}</textarea>
        </div>

        <div class="mb-3">
            <label  class="form-label">Post Creator</label>
            <select class="form-control" name="posted_by">
                @foreach($users as $user)
                    <option @if($post['posted_by'] == $user->id) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">Image</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
