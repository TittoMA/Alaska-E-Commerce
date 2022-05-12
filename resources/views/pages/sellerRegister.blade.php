@extends('layouts.master')

@section('title', 'Seller Registration |')

@section('content')

<div class="container mt-4 mb-5">
    <h2>Seller Registration</h2>
    <hr width="100px" size="7px" />

    <div>
        <form action="{{ route('seller.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="form-floating mb-3">
                        <input id="store-name" type="text" name="store_name"
                            class="form-control @error('store_name') is-invalid @enderror"
                            value="{{ old('store_name') }}" placeholder="Store" autocomplete="name" autofocus required>
                        <label for="store-name">
                            @error('store_name')
                            <strong class="text-danger">{{ $message }}</strong>
                            @else
                            Store Name
                            @enderror
                        </label>
                    </div>

                    <div class="form-floating mb-3">
                        <input id="provide" type="text" name="provide"
                            class="form-control @error('provide') is-invalid @enderror" value="{{ old('provide') }}"
                            placeholder="provide" required>
                        <label for="provide">
                            @error('provide')
                            <strong class="text-danger">{{ $message }}</strong>
                            @else
                            What do you sell?
                            @enderror
                        </label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea id="about" name="about" style="height: 120px" placeholder="Your about"
                            class="form-control @error('about') is-invalid @enderror">{{ old('about') }}</textarea>
                        <label for="about">
                            @error('about')
                            <strong class="text-danger">{{ $message }}</strong>
                            @else
                            About
                            @enderror
                        </label>
                    </div>

                </div>

                <div class="col-md-5">
                    <div class="card br-card def-shadow mb-4">
                        <div class="card-header">Header Photo</div>

                        <div class="card-body">
                            <div id="header-img" class="mx-auto mb-3"
                                style="width: 100%; height:100px; border-radius: 10px; overflow: hidden;">
                                <img id="previewImg" src="{{ asset('img/profile/default_profile.png') }}" alt=""
                                    style="height: 100%; width: 100%; object-fit: cover; object-position: center; background-color: lightgray">
                            </div>
                            <div>
                                <label for="formFile" class="form-label">Change Photo</label>
                                <input class="form-control" type="file" id="formFile" name="photo"
                                    onchange="loadFile(event)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn def-button">Create</button>
        </form>
    </div>

</div>
@endsection

@section('script')
<script>
    $(document).ready(function($){
        let headerWidth = document.getElementById('header-img').offsetWidth;
        $('#header-img').css('height', headerWidth / 3)
    });

    var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function(){
        var preview = document.getElementById('previewImg');
        preview.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>
@endsection