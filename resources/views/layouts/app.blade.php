@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Posts</h1>
    @can('create posts')
        <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
    @endcan

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>
                        @can('edit posts')
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                        @endcan
                        @can('delete posts')
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
