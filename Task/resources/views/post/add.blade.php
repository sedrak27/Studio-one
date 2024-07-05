@extends('layout')

@section('content')
    <div class="container">
        <h1>Add Post</h1>
        <form action="{{ url('/posts' . (@$post ? ('/' . $post->id) : '' )) }}" method="POST">
            @if(isset($post))
                @method('PUT')
            @endif
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $post->title ?? old('title') }}" autocomplete="title" autofocus>
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Content</label>
                <textarea id="description" class="form-control @error('content') is-invalid @enderror" name="content" autocomplete="content" autofocus>{{ $post->content ?? old('content') }}</textarea>
                @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($post) ? 'Edit' : 'Add' }}</button>
        </form>
    </div>
@endsection
