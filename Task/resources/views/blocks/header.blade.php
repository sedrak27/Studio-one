<?php

    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();

    $path = request()->path();
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand col-lg-1" href="{{ url('/') }}">STUDIO ONE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/posts') }}">Posts</a>
                </li>
                @if(!$user)
                    @if($path !== 'sign-in')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/sign-in') }}">Sign In</a>
                    </li>
                    @endif

                    @if($path !== 'sign-up')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/sign-up') }}">Sign Up</a>
                    </li>
                    @endif
                @else
                    <li class="nav-item">
                        <span id="user-posts" class="nav-link text-primary" style="cursor: pointer" data-href="{{ url("/users/{$user->id}/posts") }}">My posts</span>
                    </li>
                @endif
            </ul>

            @if($user)
                <div>
                    <a href="{{ url('/logout') }}">Logout</a>
                </div>
            @endif
        </div>
    </div>
</nav>

@vite('resources/js/post/main.js')
