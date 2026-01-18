@extends('blog.template')
@section('title', $post->title)
@section('content')
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('blog.index') }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Blog Posts
        </a>
    </div>

    <!-- Article -->
    <article class="bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden">
        <!-- Gradient Header -->
        <div class="h-3 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
        
        <!-- Article Content -->
        <div class="p-8 md:p-12">
            <!-- Title -->
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                {{ $post->title }}
            </h1>
            
            <!-- Author Info -->
            <div class="flex items-center mb-8 pb-8 border-b border-gray-200 dark:border-gray-700">
                <div class="w-14 h-14 rounded-full bg-gradient-to-r from-indigo-400 to-purple-400 flex items-center justify-center text-white font-bold text-lg">
                    {{ strtoupper(substr($post->user->name, 0, 2)) }}
                </div>
                <div class="ml-4">
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $post->user->name }}</p>
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $post->created_at->format('F j, Y') }}
                        <span class="mx-2">•</span>
                        {{ $post->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
            
            <!-- Article Body -->
            <div class="prose prose-lg dark:prose-invert max-w-none">
                <div class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed whitespace-pre-wrap">
                    {{ $post->body }}
                </div>
            </div>
        </div>
        
        <!-- Footer Actions -->
        <div class="bg-gray-50 dark:bg-gray-900 px-8 py-6 border-t border-gray-200 dark:border-gray-700">
            <div class="flex justify-between items-center">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    More Articles
                </a>
                
                @auth
                    @if(auth()->id() === $post->user_id)
                        <div class="flex gap-3">
                            <a href="{{ route('posts.edit', $post) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium">
                                Edit Post
                            </a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </article>
@endsection