<?php

namespace App\Repositories\Post;

use App\Models\Comment;
use App\Models\Post;

use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository implements IPostRepository
{
    public function create(array $data): Post
    {
        $post = new Post($data);
        $post->save();

        return $post;
    }

    public function find(int $id): Post
    {
        return Post::find($id);
    }

    public function createComment(Post $post, array $data): Comment
    {
        $comment = new Comment($data);

        $post->comments()->save($comment);

        return $comment;
    }

    public function getAll(): LengthAwarePaginator
    {
        return Post::orderBy('created_at', 'desc')
            ->with('comments')
            ->paginate(6);
    }

    public function getUserPosts(int $userId): LengthAwarePaginator
    {
        return Post::where('user_id', '=', $userId)
            ->orderBy('created_at', 'desc')
            ->with('comments')
            ->paginate(6);
    }

    public function update(int $id, array $data): bool
    {
        return Post::where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return Post::find($id)->delete();
    }

    public function search(string $param): LengthAwarePaginator
    {
        return Post::where(function ($query) use ($param) {
            $query->whereRaw("MATCH(content) AGAINST(? IN NATURAL LANGUAGE MODE)", [$param]);

        })
            ->orWhere('title', 'like', '%' . $param . '%')
            ->with('comments')
            ->paginate(6);
    }
}
