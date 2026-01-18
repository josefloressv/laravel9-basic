@extends('blog.template')
@section('title', 'Blog Posts')
@section('content')
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-4">Blog Posts</h1>
        <p class="text-xl text-gray-600 dark:text-gray-400">Explore our latest articles and stories</p>
    </div>

    @if($posts->count() > 0)
        <!-- Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach ($posts as $post)
                <article class="group bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl cursor-pointer">
                    <a href="{{ route('blog.show', $post->slug) }}" class="block">
                        <!-- Gradient Header -->
                        <div class="h-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                        
                        <!-- Card Content -->
                        <div class="p-6">
                            <!-- Author Info -->
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-400 to-purple-400 flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr($post->user->name, 0, 2)) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $post->user->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            
                            <!-- Post Title -->
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-3 line-clamp-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition">
                                {{ $post->title }}
                            </h2>
                            
                            <!-- Post Excerpt -->
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
                                {{ Str::limit($post->body, 120) }}
                            </p>
                            
                            <!-- Read More Link -->
                            <span class="inline-flex items-center text-indigo-600 dark:text-indigo-400 group-hover:text-indigo-800 dark:group-hover:text-indigo-300 font-semibold text-sm transition">
                                Read More
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </span>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-600 dark:text-gray-400 text-lg">No posts available yet. Check back soon!</p>
        </div>
    @endif
    
    <style>
        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .line-clamp-3 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
    </style>
@endsection
