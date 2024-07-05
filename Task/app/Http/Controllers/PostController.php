<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Repositories\Post\PostRepository;
use App\Services\Post\IPostService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        private readonly IPostService $postService,
        private readonly PostRepository $postRepository,
    ){}

    public function index(): View
    {
        return view('post.index');
    }

    public function addForm(): View
    {
        return view('post.add');
    }

    public function add(PostRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->postService->add($data);

        return Redirect::to('/posts');
    }

    public function allPosts(): LengthAwarePaginator
    {
        //@TODO Handle getting paginated data from cache

        return $this->postRepository->getAll();
    }

    public function postComments(Request $request): JsonResponse
    {
        $postId = $request->route()->parameter('postId');

        $post = $this->postRepository->find($postId);

        return response()->json([
            'comments' => $post->comments()->with('user')->get()
        ]);
    }

    public function userPosts(Request $request): LengthAwarePaginator
    {
        $userId = $request->route()->parameter('userId');

        return $this->postRepository->getUserPosts($userId);
    }

    public function editForm(Request $request): View
    {
        $postId = $request->route()->parameter('postId');

        $post = $this->postRepository->find($postId);

        if (!$post || $post->user_id !== Auth::id()) {
            abort(404);
        }

        return view('post.add')->with(['post' => $post]);
    }

    public function update(PostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $postId = $request->route()->parameter('postId');

        $this->postService->update($postId, $data);

        return Redirect::to('/posts');
    }

    public function delete(Request $request): void
    {
        $postId = $request->route()->parameter('postId');

        $this->postService->delete($postId);
    }

    public function search(Request $request): \Illuminate\Pagination\LengthAwarePaginator
    {
        $param = $request->input('query');

        return $this->postService->searchPost($param);
    }
}
