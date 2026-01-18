<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full mb-6">
                        <tbody>
                            <tr class="border-b border-gray-200">
                                <td class="px-6 py-4 font-semibold w-1/4">Title</td>
                                <td class="px-6 py-4">{{ $post->title }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="px-6 py-4 font-semibold">Slug</td>
                                <td class="px-6 py-4">{{ $post->slug }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="px-6 py-4 font-semibold">Body</td>
                                <td class="px-6 py-4">{{ $post->body }}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="mt-6 flex gap-4">
                        <a href="{{ route('posts.index') }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">← Back to Posts</a>
                        <a href="{{ route('posts.edit', $post) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>