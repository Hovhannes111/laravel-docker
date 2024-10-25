<?php

namespace App\Actions\Comment;

use App\Models\Comment;
use App\Models\Post;
use App\Repositories\CommentRepository;

class DeleteCommentAction
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    public function execute(Comment $comment): bool
    {
        return $this->commentRepository->delete($comment);
    }
}
