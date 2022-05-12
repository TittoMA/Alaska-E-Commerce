@extends('layouts.master')

@section('title', "Edit Service |")

@section('content')
<div class="container mt-4">
    <h3>Edit Service</h3>
    <hr width="100px" size="7px" />


    <form action="{{ route('myStore.updateService', ['service' => $service->id]) }}" method="POST"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row g-3">
            <div class="col-md-8 order-2 order-md-1">
                <div class="form-floating mb-3">
                    <input id="service-name" type="text" name="service_name"
                        class="form-control @error('service_name') is-invalid @enderror"
                        value="{{ old('service_name') ?? $service->service_name }}" placeholder="service_name">
                    <label for="service-name">
                        @error('service_name')
                        <strong class="text-danger">{{ $message }}</strong>
                        @else
                        Service Name
                        @enderror
                    </label>
                </div>

                <div class="form-floating mb-3">
                    <input id="price" type="number" name="price"
                        class="form-control @error('price') is-invalid @enderror"
                        value="{{ old('price') ?? $service->price }}" placeholder="price">
                    <label for="price">
                        @error('price')
                        <strong class="text-danger">{{ $message }}</strong>
                        @else
                        Price
                        @enderror
                    </label>
                </div>

                <div class="form-floating mb-3">
                    <textarea id="description" name="description" style="height: 120px"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="description">{{ old('description') ?? $service->description }}</textarea>
                    <label for="description">
                        @error('description')
                        <strong class="text-danger">{{ $message }}</strong>
                        @else
                        Description
                        @enderror
                    </label>
                </div>

                <div class="form-floating mb-3">
                    <select style="height: 65px" class="form-select @error('category') is-invalid @enderror"
                        id="category" name="category" aria-label="category">
                        @foreach ($categories as $item)
                        <option
                            {{old('category') == $item->id ? 'selected' : ($service->category_id == $item->id ? 'selected' : '')}}
                            value="{{$item->id}}">
                            {{$item->category_name}}
                        </option>
                        @endforeach
                    </select>
                    <label for="category">
                        @error('category')
                        <strong class="text-danger">{{ $message }}</strong>
                        @else
                        Category
                        @enderror
                    </label>
                </div>

                <div class="form-floating mb-3">
                    <input id="duration" type="text" name="duration"
                        class="form-control @error('duration') is-invalid @enderror"
                        value="{{ old('duration') ?? $service->duration }}" placeholder="duration">
                    <label for="duration">
                        @error('duration')
                        <strong class="text-danger">{{ $message }}</strong>
                        @else
                        Duration
                        @enderror
                    </label>
                </div>

                <div class="input-group">
                    <button type="submit" class="btn def-button ms-auto">
                        <i class="bi bi-check-circle-fill me-2"></i> Save
                    </button>
                </div>
            </div>

            <div class="col-md-4 order-1 order-md-2">
                <div class="card shadow mb-4">
                    <div class="card-header">Service Photo</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 col-md-12">
                                <div id="photo" class="mx-auto mb-3"
                                    style="width: 100%; height:100px; border-radius: 10px; overflow: hidden;">
                                    <img id="previewImg"
                                        src="{{ $service->photo ? asset('img/uploads/'. $service->photo) : "" }}" alt=""
                                        style="height: 100%; width: 100%; object-fit: cover; object-position: center; background-color: lightgray">
                                </div>
                            </div>

                            <div class="col-6 col-md-12">
                                <div>
                                    <label for="formFile" class="form-label">Upload Photo</label>
                                    <input class="form-control form-control-sm @error('photo') is-invalid @enderror"
                                        type="file" id="formFile" name="photo" onchange="loadFile(event)">

                                    @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function($){
        let photoWidth = document.getElementById('photo').offsetWidth;
        $('#photo').css('height', photoWidth)
    });

    window.onresize = function(event) {
        let photoWidth = document.getElementById('photo').offsetWidth;
        $('#photo').css('height', photoWidth)
    };

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