@extends('master')

@section('title')
    Edit Profile
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center min-vh-100">
            <div class="col-12 col-lg-6 col xl-5">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset(auth()->user()->profile_photo) }}" alt="" class="profile-img border border-2 border-primary my-3 @error('profile_photo')
                            border border-2 border-danger
                        @enderror">
                            <p class="fw-bold h4">{{ auth()->user()->name }}</p>
                            <p class="mb-4">{{ auth()->user()->email }}</p>

                            <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="file" accept="image/jpeg,image/png" id="profile-input" class="d-none" name="profile_photo">

                                <div class="form-floating mb-5">
                                    <input type="text" value="{{ auth()->user()->name }}"  name="name" class="form-control @error('name') is-invalid @enderror" id="floatingInput" placeholder="User Name">
                                    <label for="floatingInput">Your name</label>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button class="btn btn-primary btn-lg">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
<script>
    let profile = document.querySelector(".profile-img");
    let input = document.querySelector("#profile-input");

    profile.addEventListener("click",_=>input.click())
    input.addEventListener("change",_=>{
        let file = input.files[0];
        let reader = new FileReader();
        reader.onload = function (){
            profile.src = reader.result;
        }
        reader.readAsDataURL(file);
    })
</script>
@endpush
