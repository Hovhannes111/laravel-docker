<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-5">
                <div class="container mx-auto py-8">
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.post.update', $post->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('title')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="content" id="content" rows="4" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Update
                                Post</button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <h3 class="text-lg font-bold">Comments</h3>
                        <ul class="divide-y divide-gray-200">
                            @forelse ($comments as $comment)
                                <li class="py-2 flex justify-between items-center">
                                    <div>
                                        <span class="font-semibold">{{ $comment->user->name }}:</span>
                                        <span class="text-gray-600">{{ $comment->text }}</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        @if (auth()->user()->hasRole('admin'))
                                            <form action="{{ route('admin.comment.destroy', $comment->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 hover:underline">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </li>
                            @empty
                                <li class="py-2">No comments available.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
