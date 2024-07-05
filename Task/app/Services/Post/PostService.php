<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Repositories\Post\IPostRepository;
use App\Services\Cache\ICacheService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class PostService implements IPostService
{
    public function __construct(
        private readonly IPostRepository $postRepository,
        private readonly ICacheService $cacheService
    ){}

    public function add(array $data): Post
    {
        $data['user_id'] = Auth::id();

        $post = $this->postRepository->create($data);

        $data['id'] = $post->id;

        $this->cacheService->createOrUpdate($data);

        return $post;
    }

    public function update(int $id, array $data): void
    {
        $this->postRepository->update($id, $data);

        $data['id'] = $id;

        $this->cacheService->createOrUpdate($data);
    }

    public function delete(int $id): void
    {
        $this->postRepository->delete($id);

        $this->cacheService->delete($id);
    }

    public function addComment(array $data): void
    {
        $data['user_id'] = Auth::id();

        $post = $this->postRepository->find($data['post_id']);

        $comment = $this->postRepository->createComment($post, $data);

        $cachedPost = $this->cacheService->getByKey($post->id);
        $cachedPost['comments'][$comment->id] = $comment->toArray();

        $this->cacheService->createOrUpdate($cachedPost);
    }

    public function searchPost(string $param): LengthAwarePaginator
    {
        return $this->postRepository->search($param);
    }
}
