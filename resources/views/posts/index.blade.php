@extends('layouts.app')

@section('title') Index @endsection

@section('content')
    <div class="text-center">
        <a href="{{route('post.create')}}"><button type="button" class="mt-4 btn btn-success">Create Post</button></a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            <tr>
                <td>{{$post['id']}}</td>
                <td>{{$post['title']}}</td>
                <td>{{$post['posted_by']}}</td>
                <td>{{$post['created_at']}}</td>
                <td>
                    <a href="{{ route('post.show', $post['id']) }}" class="btn btn-info">View</a>
                    <a href="{{ route('post.edit', $post['id']) }}" class="btn btn-primary">Edit</a>
                    <form method="POST" action="{{ route('post.destroy', $post['id']) }}" class="d-inline">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                    </form>
                </td>
            </tr>

        @endforeach


        </tbody>
    </table>

@endsection


@section('scripts')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">

        $('form').click(function(event) {
            var form =  $(this).closest("form");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
