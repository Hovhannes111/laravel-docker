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
                    <div class="flex justify-between px-5 border-b-4">
                        <h1 class="text-2xl font-bold text-center">Post List</h1>
                        <form method="GET" action="{{ route('post.index') }}" class="flex mb-6">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search post..."
                                class="text-blue-500 rounded-md border-blue-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <button type="submit"
                                class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Search</button>
                        </form>
                    </div>
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <ul class="divide-y divide-gray-200">
                            @foreach ($posts as $post)
                                <div class="p-3 cursor-pointer hover:text-blue-700">
                                    <a href="{{ route('post.show', $post->id) }}">
                                        <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                                        <span class="font-semibold text-gray-300">Writter:
                                            {{ $post->author->name }}</span>
                                        <p class="text-gray-600"> {{ $post->content }}</p>
                                    </a>
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
