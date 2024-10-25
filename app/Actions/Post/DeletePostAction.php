<?php

namespace App\Actions\Post;

use App\Models\Post;
use App\Repositories\PostRepository;

class DeletePostAction
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function execute(Post $post): bool
    {
        return $this->postRepository->delete($post);
    }
}
