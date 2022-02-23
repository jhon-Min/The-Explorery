@extends('master')

@section('title')
    Edit {{ $post->title }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 col-xl-8">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4>Edit Post</h4>
                <p class="mb-0">
                    <i class="fas fa-calendar me-1"></i>
                    {{ date('d M Y') }}
                </p>
            </div>

            <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-floating mb-4">
                    <input type="text" name="title" class="form-control @error('title')
                        is-invalid
                    @enderror" id="postTitle" value="{{ old('title', $post->title) }}" placeholder="no need">
                    <label for="postTitle">Post Title</label>
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <img src="{{ asset('storage/cover/'. $post->cover) }}" id="coverPreview" class="cover-img w-100 rounded"
                        alt="">
                    <input type="file" name="cover" class="d-none" id="cover">
                    @error('cover')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-floating mb-4">
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                        placeholder="Leave a comment here" id="floatingTextarea2"
                        style="height: 400px">{{ old('description', $post->description) }}</textarea>
                    <label for="floatingTextarea2">Share Your Experience</label>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="text-center mb-5">
                    <button class="btn btn-lg btn-primary">
                        <i class="fas fa-message fa-fw"></i>
                        Update Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push("scripts")
<script>
    let coverPreview = document.querySelector("#coverPreview");
    let cover = document.querySelector("#cover");
        coverPreview.addEventListener("click",_=>cover.click())
        cover.addEventListener("change",_=>{
            let file = cover.files[0];
            let reader = new FileReader();
            reader.onload = function (){
                coverPreview.src = reader.result;
            }
            reader.readAsDataURL(file);
        })
</script>
@endpush

