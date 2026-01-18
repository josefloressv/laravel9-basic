@extends('blog.template')
@section('content')
    <h1>Blog Posts</h1>
    <ul>
    @foreach ($posts as $post)
        <li>
            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
        </li>
    @endforeach
    </ul>
    {{ $posts->links() }}
@endsection
