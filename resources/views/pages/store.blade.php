@extends('layouts.master')

@section('title', $seller->store_name . " |")

@section('head')
<style>
    #header {
        position: relative;
        border-radius: 5px;
        overflow: hidden;
    }

    #img-header {
        position: absolute;
        top: 0;
        z-index: 1;
        height: 100%;
        width: 100%;
        object-fit: cover;
        object-position: center;
        background-color: gainsboro
    }

    #header-content {
        background-color: rgba(46, 24, 168, 0.295);
        display: flex;
        height: 100%;
        position: relative;
        z-index: 2;
        justify-content: center;
        align-items: center;
    }

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

    <div id="header" class="mb-4">
        <img id="img-header" src="{{ asset('img/header/'.$seller->header_photo) }}" alt="">

        <div id="header-content">
            <div>
                <h1 style="color: #fff">{{ $seller->store_name }}</h1>
                <p style="color: #fff">{{ $seller->user->email }}</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card br-card def-shadow mb-4">
                <div class="card-header">
                    Store Rating
                </div>
                <div class="card-body">
                    <h2 class="text-center mb-0" style="color: #f4473e">{{$sellerRating ?? '-'}}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card shadow mb-4" style="border-left-width: 5px; border-left-color: #f4473e">
                <div class="card-body">
                    <h4>About</h4>
                    <p>{{ $seller->about }}</p>
                </div>
            </div>
        </div>
    </div>

    <h2>Services</h2>
    <hr width="100px" size="7px">

    <div class="row g-2">
        @forelse ($seller->service as $item)

        @php
        $order = $item->order;
        $ratings = array();
        $averageRating = null;
        foreach ($order as $itemOrder) {
        $sale = $itemOrder->sale;
        if($sale){
        array_push($ratings, $sale->rating);
        }
        }
        if(count($ratings)) {
        $averageRating = array_sum($ratings)/count($ratings);
        }
        @endphp

        <div class="col-6 col-md-3 col-lg-2">
            <div class="card br-card def-shadow mb-3">
                <div class="card-img-top service-photo" style="width: 100%">
                    <img style="height: 100%; width: 100%; object-fit: cover; object-position: center; background-color: gainsboro"
                        src="{{ asset('/img/uploads/'.$item->photo)}}" alt="">
                </div>
                <div class="card-body" style="height: 140px">

                    <h6 id="title-text" class="mb-1"><a style="text-decoration: none"
                            href="{{ url("service/$item->id")}}">{{$item->service_name}}</a></h6>

                    <p style="font-size: 16px; color: #05be70" class="mb-2"><b>Rp.
                            {{$item->price}}</b></p>
                    <div style="text-overflow: ellipsis; overflow: hidden; white-space: normal">
                        <p id="desc-text">
                            {{$item->description}}</p>
                    </div>

                </div>
                <div class=" card-footer text-muted">
                    <p class="mb-0" style="font-size: 12px">
                        <span class="badge rounded-pill bg-warning me-1"
                            style="font-size: 13px">{{$averageRating ?? '-'}}</span>
                        @for ($i = 0; $i < floor($averageRating); $i++) <i class="bi bi-star-fill"
                            style="color: #f4473e"></i>
                            @endfor

                            @for ($i = 0; $i < (5 - ((floor(5 - $averageRating)) + floor($averageRating)) ); $i++) <i
                                class="bi bi-star-half" style="color: orange"></i></i>
                                @endfor


                                @for ($i = 0; $i < floor(5 - $averageRating); $i++) <i class="bi bi-star-fill"
                                    style="color: gainsboro"></i>
                                    @endfor
                    </p>
                </div>
            </div>
        </div>
        @empty
        <h4>No Service yet</h4>
        @endforelse
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function($){
        console.log("OOOO")
        let headerWidth = document.getElementById('header').offsetWidth;
        $('#header').css('height', headerWidth / 3);

        let photoWidth = document.getElementsByClassName('service-photo')[0].offsetWidth;
        $('.service-photo').css('height', photoWidth);
    });

    window.onresize = function(event) {
        let headerWidth = document.getElementById('header').offsetWidth;
        $('#header').css('height', headerWidth / 3);

        let photoWidth = document.getElementsByClassName('service-photo')[0].offsetWidth;
        $('.service-photo').css('height', photoWidth);
    };
</script>
@endsection