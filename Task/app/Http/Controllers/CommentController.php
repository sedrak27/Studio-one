<?php

namespace App\Http\Controllers;

use App\Services\Post\IPostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(
        private readonly IPostService $postService
    ){}

    public function add(Request $request): RedirectResponse
    {
        $this->postService->addComment($request->all());

        return back();
    }
}
