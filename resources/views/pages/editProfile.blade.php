@extends('layouts.master')

@section('title', 'Edit Profile |')

@section('content')
<script>
    var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function(){
        var preview = document.getElementById('previewImg');
        preview.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

</script>

<div class="container my-4">

    <div class="row justify-content-center">
        <div class="col-md-7 order-2 order-md-1">

            <h3>Edit Profile</h3>
            <hr width="100px" size="7px" />

            <div class="card shadow mb-4">
                <div class="card-header">{{ __('Profile Information') }}</div>

                <div class="card-body">
                    @if (session('status') == 'profile-information-updated')
                    <div class="alert alert-success" role="alert">
                        {{ __('Profile information saved successfully.') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ url('user/profile-information') }}">
                        @method('PUT')
                        @csrf

                        <div class="form-floating mb-3">
                            <input id="name" type="text" name="name"
                                class="form-control @error('name', 'updateProfileInformation') is-invalid @enderror"
                                placeholder="Name" value="{{ old('name') ?? Auth::user()->name }}" autocomplete="name"
                                autofocus>
                            <label for="name">
                                @error('name', 'updateProfileInformation')
                                <strong class="text-danger">{{ $message }}</strong>
                                @else
                                Name
                                @enderror
                            </label>

                        </div>

                        <div class="form-floating mb-3">
                            <input id="email" type="email" name="email"
                                class="form-control @error('email', 'updateProfileInformation') is-invalid @enderror"
                                placeholder="Email" value="{{ old('email') ?? Auth::user()->email }}"
                                autocomplete="email" required>
                            <label for="email">
                                @error('email', 'updateProfileInformation')
                                <strong class="text-danger">{{ $message }}</strong>
                                @else
                                Email address
                                @enderror
                            </label>
                        </div>

                        <div class="form-floating mb-3">
                            <input id="telephone" type="tel" name="phone_number"
                                class="form-control @error('phone_number', 'updateProfileInformation') is-invalid @enderror"
                                placeholder="Phone Number"
                                value="{{ old('phone_number') ?? Auth::user()->phone_number }}" autocomplete="tel">
                            <label for="telephone">
                                @error('phone_number', 'updateProfileInformation')
                                <strong class="text-danger">{{ $message }}</strong>
                                @else
                                Phone Number
                                @enderror
                            </label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea id="address" name="address" style="height: 100px" placeholder="Your Address"
                                class="form-control @error('address', 'updateProfileInformation') is-invalid @enderror">{{ old('address') ?? Auth::user()->address }}</textarea>
                            <label for="address">
                                @error('address', 'updateProfileInformation')
                                <strong class="text-danger">{{ $message }}</strong>
                                @else
                                Address
                                @enderror
                            </label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="gender" name="gender">
                                <option value="L"
                                    {{ old('gender') == 'L' ? 'selected' : (Auth::user()->gender == 'L' ? 'selected' : '') }}>
                                    Laki-laki
                                </option>
                                <option value="P"
                                    {{ old('gender') == 'P' ? 'selected' : (Auth::user()->gender == 'P' ? 'selected' : '') }}>
                                    Perempuan</option>
                            </select>
                            <label for="gender">
                                @error('gender', 'updateProfileInformation')
                                <strong class="text-danger">{{ $message }}</strong>
                                @else
                                Gender
                                @enderror
                            </label>
                        </div>

                        <div class="form-floating mb-3">
                            <input id="birth_date" type="date" name="birth_date"
                                class="form-control @error('birth_date', 'updateProfileInformation') is-invalid @enderror"
                                value="{{ old('birth_date') ?? Auth::user()->birth_date }}" autocomplete="bday-day">
                            <label for="birth_date">
                                @error('birth_date', 'updateProfileInformation')
                                <strong class="text-danger">{{ $message }}</strong>
                                @else
                                Birth Date
                                @enderror
                            </label>
                        </div>


                        <div class="input-group">
                            <button type="submit" class="btn def-button ms-auto">
                                <i class="bi bi-check-circle-fill me-2"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <h3>Change Password</h3>
            <hr width="100px" size="7px" />

            <div class="card shadow mb-4">
                <div class="card-header">{{ __('Password') }}</div>

                <div class="card-body">
                    @if (session('status') == 'password-updated')
                    <div class="alert alert-success" role="alert">
                        {{ __('Password updated successfully.') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ url('user/password') }}">
                        @method('PUT')
                        @csrf

                        <div class="input-group mb-3 row mx-0">
                            <label for="current_password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Current Password') }}</label>

                            <div class="col-md-8">
                                <input id="current_password" type="password"
                                    class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                    name="current_password" required autofocus>

                                @error('current_password', 'updatePassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group mb-3 row mx-0">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('New Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password"
                                    class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                    name="password" required autofocus>

                                @error('password', 'updatePassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group mb-3 row mx-0">
                            <label for="password_confirmation"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm New Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password"
                                    class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                    name="password_confirmation" required autofocus>

                                @error('password_confirmation', 'updatePassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group row mx-0">
                            <div class="col-md-6 d-flex justify-content-end ms-auto">
                                <button type="submit" class="btn def-button">
                                    <i class="bi bi-check-circle-fill me-2"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-5 order-1 order-md-2">
            <h3>Photo Profile</h3>
            <hr width="100px" size="7px" />

            <div class="card shadow mb-4">
                <div class="card-header">Profile Picture</div>

                <div class="card-body">

                    @if (session('status') == 'photo-updated')
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                            aria-label="Success:">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
                        {{ __('Photo Profile updated successfully.') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mx-auto mb-3"
                            style="height: 150px; width: 150px; border-radius: 10px; overflow: hidden;">
                            <img id="previewImg"
                                src="{{ asset('img/profile/'.(Auth::user()->photo_profile ?? 'default_profile.png')) }}"
                                alt=""
                                style="height: 100%; width: 100%; object-fit: cover; object-position: center; background-color: lightgray">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Change Photo</label>
                            <input class="form-control @error('photo') is-invalid @enderror" type="file" id="formFile"
                                name="photo" onchange="loadFile(event)">
                            @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <button type="submit" class="btn def-button ms-auto">
                                <i class="bi bi-check-circle-fill me-2"></i>Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection