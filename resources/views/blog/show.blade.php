@extends('blog.template')
@section('content')
    <h1>Blog Show</h1>
    <div>
        <h2>{{ $post->title }}</h2>
        <h3>{{ $post->slug }}.</h3>
        <p>{{ $post->body }}.</p>
    </div>
    <p><a href="{{ route('blog.index') }}">Back to Blog Posts</a></p>
@endsection