<?php

namespace App\Repositories\Contracts;

use App\Models\Comment;
use App\Models\Post;

interface CommentRepositoryInterface
{
    public function create(Post $post, array $data): Comment;
    public function update(Comment $comment, array $data): Comment;
    public function delete(Comment $comment): bool;
}
