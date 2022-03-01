@extends('master')

@section('title')
    Change Password
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

                            <form action="{{ route('update-password') }}" method="POST">
                                @csrf

                                <div class="form-floating mb-3">
                                    <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="yourName" placeholder="old_password">
                                    <label for="yourName">Current Password</label>
                                    @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="yourName"  placeholder="password">
                                    <label for="yourName">New Password</label>
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="yourName"  placeholder="password_confirmation">
                                    <label for="yourName">Confirm Password</label>
                                    @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button class="btn btn-primary btn-lg">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

