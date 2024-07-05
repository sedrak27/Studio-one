@extends('layout')

<?php

use Illuminate\Support\Facades\Auth;

$user = Auth::user();

?>

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('blocks.search_form')
                <div class="d-flex justify-content-between">
                    <h1>Posts</h1>

                    @if($user)
                        <div>
                            <a class="btn btn-primary" href="{{ url('/post-add') }}">Add post</a>
                        </div>
                    @endif

                </div>
                <div id="post" class="d-flex justify-content-around flex-lg-wrap"></div>

                <div id="pagination" class="mt-5 mb-5 col-lg-12 d-flex justify-content-center">
                    <div class="d-flex col-lg-5 justify-content-around">
                        <div id="pages" class="col-lg-12 d-flex justify-content-around"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/post/main.js')
@endsection
