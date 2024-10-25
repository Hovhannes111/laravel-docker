<?php

namespace App\Actions\Post;

use App\Models\Post;
use App\Repositories\PostRepository;

class CreatePostAction
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function execute(array $data): Post
    {
        return $this->postRepository->create($data);
    }
}
