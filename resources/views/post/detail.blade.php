@extends('master')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
<div class="container">
   <div class="row justify-content-center">
        <div class="col-10 col-xl-8">

            <div class="post mb-4">
                <div class="row">
                    <h3 class="fw-bold mb-4">{{ $post->title }}</h3>
                    <img src="{{ asset('storage/cover/'. $post->cover) }}" class="cover-img mb-4 rounded-3 w-100"
                    alt="">
                    <p class="text-black-50 mb-5 post-detail">
                        {{ $post->description }}
                    </p>

                    <div class="d-flex flex-column justify-content-between border p-4 rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex">
                                <img src="{{ asset($post->user->profile_photo) }}"
                                    class="user-img rounded-circle" alt="">
                                <p class="mb-0 ms-2 small">
                                    {{ $post->user->name }}
                                    <br>
                                    <i class="fas fa-calendar"></i>
                                    {{ $post->created_at->format("d M Y") }}
                                </p>
                            </div>

                           <div>
                            @auth
                                @can('update', $post)
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-outline-secondary me-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                @endcan

                                @can('delete', $post)
                                <form action="{{ route('post.destroy', $post->id) }}" class="d-inline" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline-danger me-2">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                                @endcan
                            @endauth
                            <a href="{{ route('index') }}" class="btn btn-outline-primary">Read All</a>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
@endsection
