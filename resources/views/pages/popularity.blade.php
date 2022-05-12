@extends('layouts.master')

@section('title', 'Popularity |')
@section('menuPopularity', 'active')

@section('head')
<style>
    #title-text {
        font-size: 15px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    #desc-text {
        font-size: 12px;
        margin-bottom: 0px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
</style>
@endsection

@section('content')

<div class="container mt-4">

    <div id="carouselExampleIndicators" class="carousel carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner" style="border-radius: 10px">
            <div class="carousel-item active">
                <img src="{{ asset('/img/a.png')}}" class="d-block w-100"
                    style="height: 400px; object-fit: cover; object-position: center;" alt="...">
                <div class="carousel-caption d-none d-md-block text-white">
                    <h5>Maybe you like it!</h5>
                    <p>Digital Drawing</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('/img/b.png')}}" class="d-block w-100"
                    style="height: 400px; object-fit: cover; object-position: center;" alt="...">
                <div class="carousel-caption d-none d-md-block text-white">
                    <h5>How about this!</h5>
                    <p>Beautiful Arts</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('/img/c.png')}}" class="d-block w-100"
                    style="height: 400px; object-fit: cover; object-position: center;" alt="...">
                <div class="carousel-caption d-none d-md-block text-white">
                    <h5>Don't forget to see it!</h5>
                    <p><b>Wonderful Designing</b></p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <h4 class="mb-2" style="text-transform: capitalize">Popular Services</h4>
    <hr width="100px" size="7px">
    <div class="row g-2">
        @foreach ($services as $item)
        <div class="col-6 col-md-3 col-lg-2">
            <div class="card bg-light shadow mb-3" style="border-radius: 5px; overflow: hidden;">
                <div class="card-img-top service-photo" style="width: 100%">
                    <img style="height: 100%; width: 100%; object-fit: cover; object-position: center; background-color: gainsboro"
                        src="{{ asset('/img/uploads/'.$item['photo'])}}" alt="">
                </div>
                <div class="card-body" style="height: 158px">
                    <p class="badge rounded-pill bg-primary mb-2" style="font-size: 13px">#{{$loop->iteration}}</p>

                    <h6 id="title-text" class="mb-1"><a style="text-decoration: none"
                            href="{{ url("service/".$item['id']) }}">{{$item['service_name']}}</a></h6>

                    <p style="font-size: 16px; color: #05be70" class="mb-2"><b>Rp.
                            {{$item['price']}}</b></p>
                    <div style="text-overflow: ellipsis; overflow: hidden; white-space: normal">
                        <p id="desc-text">
                            {{$item['description']}}</p>
                    </div>

                </div>
                <div class=" card-footer text-muted">
                    <p class="mb-0" style="font-size: 12px">
                        <span class="badge rounded-pill bg-warning me-1"
                            style="font-size: 13px">{{$item['rating'] ?? '-'}}</span>
                        @for ($i = 0; $i < floor($item['rating']); $i++) <i class="bi bi-star-fill"
                            style="color: orange"></i>
                            @endfor

                            @for ($i = 0; $i < (5 - ((floor(5 - $item['rating'])) + floor($item['rating'])) ); $i++) <i
                                class="bi bi-star-half" style="color: orange"></i></i>
                                @endfor


                                @for ($i = 0; $i < floor(5 - $item['rating']); $i++) <i class="bi bi-star-fill"
                                    style="color: gainsboro"></i>
                                    @endfor
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function($){
        let photoWidth = document.getElementsByClassName('service-photo')[0].offsetWidth;
        $('.service-photo').css('height', photoWidth);
    });

    window.onresize = function(event) {
        let photoWidth = document.getElementsByClassName('service-photo')[0].offsetWidth;
        $('.service-photo').css('height', photoWidth);
    };
</script>
@endsection