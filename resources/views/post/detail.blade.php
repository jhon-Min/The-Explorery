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

                    @if($post->galleries->count())
                       <div class="border rounded mb-5">
                            <div class="row g-4 p-3">
                            @forelse ($post->galleries as $gallery)
                                <div class="col-6 col-md-4 col-lg-3">
                                    {{-- <img src="{{ asset('storage/gallery/'.$gallery->photo) }}" class="img-fluid rounded" alt=""> --}}
                                    <a class="venobox" data-gall="gallery" data-maxwidth="600px" href="{{ asset('storage/gallery/'.$gallery->photo) }}">
                                        <img src="{{ asset('storage/gallery/'.$gallery->photo) }}" class="img-fluid rounded" alt="image alt"/>
                                    </a>
                                </div>
                            @empty

                            @endforelse
                            </div>
                       </div>
                    @endif

                    <div class="mb-5">
                        <h4 class="text-center fw-bold mb-4">Users Comment</h4>
                        <div class="row justify-content-center">

                            <div class="col-lg-8">

                                <div class="comments">

                                    @forelse($post->comments as $comment)
                                    <div class="border rounded p-3 mb-3">
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="d-flex">
                                                <img src="{{ isset($comment->user->profile_photo) ? asset('storage/thumbnail/'.$comment->user->profile_photo) : asset('default-avatar.png') }}" class="user-img rounded-circle" alt="">
                                                <p class="mb-0 ms-2 small">
                                                    {{ $comment->user->name }}
                                                    <br>
                                                    <i class="fas fa-calendar"></i>
                                                    {{ $comment->created_at->diffforhumans() }}
                                                </p>
                                            </div>
                                            @can('delete',$comment)
                                            <form class="" method="post" action="{{ route('comment.destroy',$comment->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-outline-danger rounded-circle btn-sm">
                                                    <i class="fas fa-trash-alt "></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </div>

                                        <p class="mb-0">
                                            {{ $comment->text }}
                                        </p>
                                    </div>
                                    @empty
                                        <p class="text-center">
                                            There is no Comment
                                            @guest
                                                <a href="{{ route('login') }}">Login</a> to Comment
                                            @endguest
                                        </p>
                                    @endforelse

                                </div>

                    @auth
                    <form action="{{ route('comment.store') }}" method="post" id="comment-create" class="mb-4">
                        @csrf
                        <input type="hidden" name="post_id"  value="{{ $post->id }}">
                        <div class="form-floating mb-3">
                            <textarea class="form-control @error('text') is-invalid @enderror" name="text" placeholder="Leave a comment here" style="height: 150px" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Comments</label>
                            @error('text')
                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary">Comment</button>
                        </div>
                    </form>
                    @endauth

                    <div class="d-flex flex-column justify-content-between border p-4 rounded">
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
