<?php

namespace App\Repositories\Post;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

interface IPostRepository
{
    public function create(array $data): Post;

    public function find(int $id): Post;

    public function createComment(Post $post, array $data): Comment;

    public function getAll(): LengthAwarePaginator;

    public function getUserPosts(int $userId): LengthAwarePaginator;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function search(string $param): LengthAwarePaginator;
}
