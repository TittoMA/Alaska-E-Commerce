@extends('layouts.master')

@section('title', "Edit Store |")

@section('content')
<div class="container mt-4">
    <h3>Edit Store</h3>
    <hr width="100px" size="7px" />

    <div class="row">
        <div class="col-md-6">
            <div class="card br-card def-shadow">
                <div class="card-header">Store Info</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('myStore.update') }}">
                        @method('PUT')
                        @csrf

                        <div class="form-floating mb-3">
                            <input id="store-name" type="text" name="store_name"
                                class="form-control @error('store_name') is-invalid @enderror"
                                value="{{ old('store_name') ?? $seller->store_name }}" placeholder="Store"
                                autocomplete="name" autofocus>
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
                                class="form-control @error('provide') is-invalid @enderror"
                                value="{{ old('provide') ?? $seller->provide }}" placeholder="provide">
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
                                class="form-control @error('about') is-invalid @enderror">{{ old('about') ?? $seller->about }}</textarea>
                            <label for="about">
                                @error('about')
                                <strong class="text-danger">{{ $message }}</strong>
                                @else
                                About
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
        </div>
        <div class="col-md-6">
            <div class="card br-card def-shadow mb-4">
                <div class="card-header">Header Photo</div>

                <div class="card-body">
                    <form action="{{ route('myStore.updateHeader') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div id="header-img" class="mx-auto mb-3"
                            style="width: 100%; height:100px; border-radius: 10px; overflow: hidden;">
                            <img id="previewImg" src="{{ asset('img/header/'.($seller->header_photo)) }}" alt=""
                                style="height: 100%; width: 100%; object-fit: cover; object-position: center; background-color: lightgray">
                        </div>
                        <div>
                            <label for="formFile" class="form-label">Change Photo</label>
                            <input class="form-control @error('photo') is-invalid @enderror" type="file" id="formFile"
                                name="photo" onchange="loadFile(event)">

                            @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group mt-3">
                            <button type="submit" class="btn def-button ms-auto">
                                <i class="bi bi-check-circle-fill me-2"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">

        </div>
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