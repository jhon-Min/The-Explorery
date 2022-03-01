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

            <form action="{{ route('post.update', $post->id) }}" id="updatePost" method="POST" enctype="multipart/form-data">
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
                    <img src="{{ asset('storage/cover/'. $post->cover) }}" id="coverPreview" class="cover-img w-100 rounded @error('cover')
                        border border-danger
                    @enderror"
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

            </form>

            <div class=" border rounded p-3 mb-5">
               <div class="d-flex align-items-stretch">
                    <div class="d-flex justify-content-center align-items-center bg-light border rounded-3 border-secondary py-2 px-3" id="upload-ui" style="height: 150px">
                        <i class="fas fa-upload fs-4"></i>
                    </div>

                   <div class="ms-3 d-flex overflow-auto" style=" height: 150px;">
                        @forelse ($post->galleries as $gallery)
                            <div class="position-relative">
                                <form action="{{ route('gallery.destroy', $gallery->id) }}" class="position-absolute" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt fa-fw"></i>
                                    </button>
                                </form>
                                <img src="{{ asset('storage/gallery/' . $gallery->photo) }}" class="gallery-box border shadow-sm me-2" alt="">
                            </div>
                        @empty

                        @endforelse
                   </div>
               </div>

                <form action="{{ route('gallery.store') }}" id="gallery" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div>
                        <input type="file" id="galleryInput" class="d-none @error('galleries')
                            is-invalid
                        @enderror
                        @error('galleries.*')
                        is-invalid
                        @enderror" name="galleries[]" multiple>
                    </div>

                    @error('galleries')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    @error('galleries.*')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                </form>
            </div>

            <div class="text-center mb-5">
                <button class="btn btn-lg btn-primary" form="updatePost">
                    <i class="fas fa-message fa-fw"></i>
                    Update Post
                </button>
            </div>
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

    let uploadUi = document.getElementById("upload-ui");
    let galleryForm = document.getElementById("gallery");
    let input = document.getElementById("galleryInput");

    uploadUi.addEventListener("click", _ => input.click());
    input.addEventListener("change", _ => galleryForm.submit() )
</script>
@endpush

