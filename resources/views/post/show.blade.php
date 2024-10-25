<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg sm:rounded-lg mb-8 overflow-hidden">
                <div class="container mx-auto py-6">
                    <div class="border-b-4 border-gray-300 mb-4">
                        <h1 class="text-2xl font-bold text-center text-gray-800 mb-2">Writer:
                            {{ $post->author->name }}</h1>
                    </div>
                    <p class="px-5 text-gray-700 leading-relaxed">{{ $post->content }}</p>
                </div>
            </div>
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Comments</h2>

                @forelse ($comments as $comment)
                    <div class="mb-4 p-4 border rounded-md">
                        <p class="text-gray-800">{{ $comment->text }}</p>
                        <p class="text-sm text-gray-500 mt-2">By {{ $comment->user->name }} on
                            {{ $comment->created_at->format('M d, Y') }}</p>

                        @if (auth()->check() && auth()->user()->id === $comment->user_id)
                            <div class="flex justify-between items-center mt-2">
                                <button onclick="toggleEdit({{ $comment->id }})"
                                    class="text-blue-500 hover:underline">Edit</button>

                                <form
                                    action="{{ route('comment.destroy', ['post' => $post->id, 'comment' => $comment->id]) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-4">Delete</button>
                                </form>
                            </div>

                            <form id="edit-form-{{ $comment->id }}"
                                action="{{ route('comment.update', ['post' => $post->id, 'comment' => $comment->id]) }}"
                                method="POST" style="display: none;" class="mt-4">
                                @csrf
                                @method('PUT')
                                <textarea name="text" rows="2" class="w-full border-gray-300 rounded-md">{{ $comment->text }}</textarea>
                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Save</button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-600">No comments yet. Be the first to comment!</p>
                @endforelse

                <div class="mt-4">
                    {{ $comments->links() }}
                </div>

                @auth
                    <form action="{{ route('comment.store', ['post' => $post->id]) }}" method="POST" class="mt-8">
                        @csrf
                        @error('text')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        <textarea name="text" rows="3" placeholder="Add a comment..." class="w-full border-gray-300 rounded-md"></textarea>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Post Comment</button>
                    </form>
                @endauth
            </div>

        </div>
    </div>

    <script>
        function toggleEdit(commentId) {
            const form = document.getElementById('edit-form-' + commentId);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</x-app-layout>
