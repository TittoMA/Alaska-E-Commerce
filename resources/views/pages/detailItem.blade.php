@extends('layouts.master')

@section('title', $service->service_name.' |')
@section('menuProduct', 'active')

@section('content')
<div class="container mt-4">
    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <div id="photo" class="justify-content-center" style="width: 100%; border-radius: 10px; overflow: hidden">
                <img style="height: 100%; width: 100%; object-fit: contain; object-position: center"
                    src="{{ asset('/img/uploads/'.$service->photo)}}" alt="">
            </div>

            <div class="card br-card shadow my-3">
                <div class="card-header">Store</div>
                <div class="card-body">
                    <div style="display: flex; align-items: center">
                        <img src="{{ asset('img/profile/'.$service->seller->user->photo_profile) }}" alt=""
                            style="height: 55px; width: 55px; border-radius: 10px; object-fit: cover; object-position: center; background-color: lightgray">
                        <div class="ms-3">
                            <p class="mb-0" style="font-size: 15px; font-weight: bold"><a
                                    href="{{ url('store/'.$service->seller->id) }}">{{$service->seller->store_name}}</a>
                            </p>
                            <p class="mb-0" style="font-size: 14px">By {{$service->seller->user->name}}</p>
                            <p class="mb-0" style="font-size: 14px">{{$service->seller->user->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card br-card def-shadow">
                <div class="card-body">
                    <p class="mb-2"><a href="{{ url('category/'.$service->category->category_name) }}"
                            style="color: orange">{{ $service->category->category_name }}</a></p>
                    <h5>{{$service->service_name}}</h5>
                    <p class="mb-3" style="font-size: 14px">
                        @for ($i = 0; $i < floor($rating); $i++) <i class="bi bi-star-fill" style="color: orange"></i>
                            @endfor

                            @for ($i = 0; $i < (5 - ((floor(5 - $rating)) + floor($rating)) ); $i++) <i
                                class="bi bi-star-half" style="color: orange"></i></i>
                                @endfor


                                @for ($i = 0; $i < floor(5 - $rating); $i++) <i class="bi bi-star-fill"
                                    style="color: gainsboro"></i>
                                    @endfor
                                    <span class="badge rounded-pill bg-primary ms-1"
                                        style="font-size: 13px">{{$rating}}</span></p>

                    <h4 style="color: #05be70"><b>Rp. {{$service->price}}</b></h4>

                    <p style="font-weight: bold; margin-bottom: 5px; margin-top: 15px">Description:</p>
                    <p style="font-size: 15px;">{{$service->description}}</p>

                    <hr class=" my-3" style="color:#cecece">

                    <p class="mb-2" style="font-size: 14px"><i class="bi bi-clock-fill me-2" style="color: orange"></i>
                        Estimated Time:
                        <span class="badge rounded-pill bg-primary ms-1"
                            style="font-size: 15px">{{$service->duration}}</span>
                    </p>
                    <p class="mb-2" style="font-size: 14px"><i class="bi bi-check2-square me-2"
                            style="color: orange"></i> Sold:
                        <span class="badge rounded-pill bg-primary ms-1"
                            style="font-size: 15px">{{$service->sold}}</span></p>

                    <form action="{{ route('order.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $service->id }}"">
                        <button type=" submit" class="btn def-button mt-4"><i class="bi bi-wallet-fill me-2"></i>
                        Order</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <hr class=" my-3" style="color:#cecece">

    <div class="card br-card def-shadow">
        <div class="card-body">
            <h4>Review</h4>
            <hr width="75px" size="7px" style="color:#ff9849; margin-bottom: 25px">
            @forelse ($service->sale as $item)

            <div class="mb-3" style="display: flex;">
                <img src="{{ asset('img/profile/'.($item->order->buyer->photo_profile ?? 'default_profile.png')) }}"
                    alt=""
                    style="height: 50px; width: 50px; border-radius: 10px; object-fit: cover; object-position: center; background-color: lightgray">
                <div class="ms-2">
                    <p class="mb-0" style="font-size: 15px;">{{ $item->order->buyer->name }}</a>
                    </p>
                    <p class="mb-1" style="font-size: 12px">
                        @for ($i = 0; $i < $item->rating; $i++)
                            <i class="bi bi-star-fill" style="color: orange"></i>
                            @endfor

                            @for ($i = 0; $i < (5 - round($item->rating)); $i++)
                                <i class="bi bi-star-fill" style="color: gainsboro"></i>
                                @endfor
                    </p>
                    <p class="mb-0" style="font-size: 15px; font-weight: bold">{{ $item->review }}</p>
                </div>
            </div>
            <hr class=" mb-3" style="color:#cecece">
            @empty
            <h5>no review yet</h5>
            @endforelse
        </div>
    </div>

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
</script>
@endsection