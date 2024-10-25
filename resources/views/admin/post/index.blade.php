<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto py-8">
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="flex justify-between px-5 border-b-4 mb-6 pb-6">
                        <h1 class="text-2xl font-bold text-center">Post List</h1>
                        <form method="GET" action="{{ route('admin.post.index') }}" class="flex">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search post..."
                                class="text-blue-500 rounded-md border-blue-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <button type="submit"
                                class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Search</button>
                        </form>
                    </div>
                    @if (auth()->user()->hasRole('admin'))
                        <div class="flex  px-5 mb-6">
                            <a href="{{ route('admin.post.create') }}"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                + Create Post
                            </a>
                        </div>
                    @endif

                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <ul class="divide-y divide-gray-200">
                            @foreach ($posts as $post)
                                <div class="p-3 hover:text-blue-700">
                                    <a href="{{ route('admin.post.show', $post->id) }}">
                                        <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                                        <span class="font-semibold text-gray-300">Writer:
                                            {{ $post->author->name }}</span>
                                        <p class="text-gray-600">{{ $post->content }}</p>
                                    </a>

                                    <div class="flex mt-3 space-x-3">
                                        @if (auth()->user()->hasRole('admin'))
                                            <a href="{{ route('admin.post.destroy', $post->id) }}"
                                                class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Edit</a>
                                            <form action="{{ route('admin.post.destroy', $post->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
