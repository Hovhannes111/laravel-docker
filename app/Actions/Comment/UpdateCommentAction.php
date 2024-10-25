<?php

namespace App\Actions\Comment;

use App\Models\Comment;
use App\Models\Post;
use App\Repositories\CommentRepository;

class UpdateCommentAction
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    public function execute(Comment $comment, array $data): Comment
    {
        return $this->commentRepository->update($comment, $data);
    }
}
