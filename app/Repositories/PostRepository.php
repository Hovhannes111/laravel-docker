<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class PostRepository implements PostRepositoryInterface
{
    protected const CACHE_KEY = 'posts';
    public function get(?string $search = null, int $perPage = 5): LengthAwarePaginator
    {
        $cacheKey = self::CACHE_KEY . ($search ? ':' . md5($search) : '');

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($search, $perPage) {
            return Post::when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            })
                ->orderByDesc('id')
                ->paginate($perPage);
        });
    }

    public function create(array $data): Post
    {
        $post = Post::create([
            'title' => Arr::get($data, 'title'),
            'content' => Arr::get($data, 'content'),
            'user_id' => auth()->id(),
        ]);

        Cache::forget(self::CACHE_KEY);

        return $post;
    }

    public function update(Post $post, array $data): Post
    {
        $post->update([
            'title' => Arr::get($data, 'title'),
            'content' => Arr::get($data, 'content'),
        ]);

        Cache::forget(self::CACHE_KEY);

        return $post;
    }

    public function delete(Post $post): bool
    {
        $result = $post->delete();

        Cache::forget(self::CACHE_KEY);

        return $result;
    }
}
