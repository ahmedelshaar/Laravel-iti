@extends('layouts.app')

@section('title') Create @endsection

@section('content')
    <form method="post" action="{{ route('post.store') }}">
        {{ csrf_field() }}
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input  type="text" class="form-control" name="title" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label  class="form-label">Post Creator</label>
            <select class="form-control" name="posted_by">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
