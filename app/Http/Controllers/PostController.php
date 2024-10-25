<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Post;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;

class PostController extends Controller
{
    public function index(SearchRequest $searchRequest, PostRepository $postRepository): View
    {
        $search = Arr::get($searchRequest->validated(), 'search');
        $posts = $postRepository->get($search);

        return view('post.index', compact('posts'));
    }

    public function show(Post $post, CommentRepository $commentRepository): View
    {
        $comments = $commentRepository->getPostComments($post);

        return view('post.show', compact('post', 'comments'));
    }

}
