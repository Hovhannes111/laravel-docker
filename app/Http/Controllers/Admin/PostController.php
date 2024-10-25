<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Comment\DeleteCommentAction;
use App\Actions\Post\CreatePostAction;
use App\Actions\Post\DeletePostAction;
use App\Actions\Post\UpdatePostAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\DeleteCommentRequest;
use App\Http\Requests\DeletePostRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PostController extends Controller
{
    public function index(SearchRequest $searchRequest, PostRepository $postRepository): View
    {
        $search = Arr::get($searchRequest->validated(), 'search');
        $posts = $postRepository->get($search);

        return view('admin.post.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.post.create');
    }

    public function store(
        CreatePostRequest $createPostRequest,
        CreatePostAction $createPostAction
    ): RedirectResponse {
        $data = $createPostRequest->validated();
        $createPostAction->execute($data);

        return redirect()->route('admin.post.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post): view
    {
        $comments = $post->comments;
        return view('admin.post.edit', compact('post', 'comments'));
    }

    public function update(
        Post $post,
        UpdatePostRequest $updatePostRequest,
        UpdatePostAction $updatePostAction
    ): RedirectResponse {
        $data = $updatePostRequest->validated();
        $updatePostAction->execute($post, $data);

        return redirect()->back()->with('success', 'Post updated successfully.');
    }
    public function destroy(
        Post $post,
        DeletePostRequest $deletePostRequest,
        DeletePostAction $deletePostAction
    ): RedirectResponse {

        $deletePostAction->execute($post);

        return redirect()->route('admin.post.index')->with('success', 'Post deleted successfully.');
    }

    public function deleteComment(
        Post $post,
        Comment $comment,
        DeleteCommentRequest $deleteCommentRequest,
        DeleteCommentAction $deleteCommentAction
    ): RedirectResponse {
        $deleteCommentAction->execute($comment);

        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}
