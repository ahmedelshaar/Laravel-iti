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
                @foreach($users as $user)
                    <option @if($post['posted_by'] == $user->id) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
