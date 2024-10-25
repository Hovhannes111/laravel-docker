<?php

namespace App\Actions\Comment;

use App\Models\Comment;
use App\Models\Post;
use App\Repositories\CommentRepository;

class CreateCommentAction
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    public function execute(Post $post, array $data): Comment
    {
        return $this->commentRepository->create($post, $data);
    }
}
