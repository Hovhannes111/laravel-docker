<?php

namespace App\Actions\Post;

use App\Models\Post;
use App\Repositories\PostRepository;

class UpdatePostAction
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function execute(Post $post, array $data): Post
    {
        return $this->postRepository->update($post, $data);
    }
}
