@extends('master')

@section('title')
{{ env('APP_NAME') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 col-xl-8">
            @auth
            <div class="border rounded-3 p-4 d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-black-50">
                    Welcome
                    <br>
                    <span class="fw-bold text-dark">{{ auth()->user()->name }}</span>
                </h4>
                <a href="{{ route('post.create') }}" class="btn btn-primary btn-lg">Create Post</a>
            </div>
            @endauth

            <div class="posts mb-5">
                @forelse($posts as $post)

                <div class="post mb-4">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="{{ asset('storage/cover/'. $post->cover) }}" class="cover-img rounded-3 w-100"
                                alt="">
                        </div>
                        <div class="col-lg-8">
                            <div class="d-flex flex-column justify-content-between h-350 py-4">
                                <div class="">
                                    <h4 class="fw-bold">{{ $post->title }}</h4>
                                    <p class="text-black-50">
                                        {{ $post->excerpt }}
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <img src="{{ isset($post->user->profile_photo) ? asset('storage/thumbnail/'.$post->user->profile_photo) : asset('default-avatar.png') }}"
                                            class="user-img rounded-circle" alt="">
                                        <p class="mb-0 ms-2 small">
                                            {{ $post->user->name }}
                                            <br>
                                            <i class="fas fa-calendar"></i>
                                            {{ $post->created_at->format("d M Y") }}
                                        </p>
                                    </div>
                                    <a href="{{ route('detail', $post->slug) }}" class="btn btn-outline-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @empty

                @endforelse
            </div>

            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
