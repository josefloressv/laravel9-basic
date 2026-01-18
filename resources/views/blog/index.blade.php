@extends('blog.template')
@section('content')
    <h1>Blog</h1>
    @foreach ($posts as $post)
        <div>
            <h2>{{ $post["title"] }}</h2>
            <p>{{ $post["summary"] }}.</p>
            <a href="{{ route('blog.show', $post) }}">Read more</a>
        </div>
    @endforeach
@endsection
