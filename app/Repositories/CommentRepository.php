<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Post;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class CommentRepository implements CommentRepositoryInterface
{
    protected const CACHE_KEY = 'post_comments_';
    public function getPostComments(Post $post, int $perPage = 5): LengthAwarePaginator
    {
        return Cache::remember(self::CACHE_KEY . $post->id, now()->addMinutes(10), function () use ($post, $perPage) {
            return $post->comments()->paginate($perPage);
        });
    }

    public function create(Post $post, array $data): Comment
    {
        $comment = $post->comments()->create([
            'user_id' => auth()->user()->id,
            'text' => Arr::get($data, 'text')
        ]);

        Cache::forget(self::CACHE_KEY . $post->id);

        return $comment;
    }

    public function update(Comment $comment, array $data): Comment
    {
        $comment->update($data);

        Cache::forget(self::CACHE_KEY . $comment->post_id);

        return $comment;
    }

    public function delete(Comment $comment): bool
    {
        $result = $comment->delete();

        Cache::forget(self::CACHE_KEY . $comment->post_id);

        return $result;
    }

}
