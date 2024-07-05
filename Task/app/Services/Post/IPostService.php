<?php

namespace App\Services\Post;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

interface IPostService
{
    public function add(array $data): Post;

    public function update(int $id, array $data): void;

    public function addComment(array $data): void;

    public function searchPost(string $param): LengthAwarePaginator;
}
