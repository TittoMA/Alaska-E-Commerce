@extends('layouts.master')

@section('title', "Finish Order |")

@section('head')
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<style>
    div.stars {
        width: 245px;
        display: block;
        margin: auto;
    }

    input.star {
        display: none;
    }

    input.seller-star {
        display: none;
    }

    label.star {
        float: right;
        padding: 10px;
        font-size: 30px;
        color: #444;
        transition: all .2s;
    }

    label.seller-star {
        float: right;
        padding: 10px;
        font-size: 30px;
        color: #444;
        transition: all .2s;
    }

    input.star:checked~label.star:before {
        content: '\f005';
        color: #FD4;
        transition: all .25s;
    }

    input.star-5:checked~label.star:before {
        color: rgb(255, 236, 96);
    }

    input.star-1:checked~label.star:before {
        color: rgb(255, 0, 0);
    }

    label.star:hover {
        transform: rotate(-15deg) scale(1.3);
    }

    label.star:before {
        content: '\f006';
        font-family: FontAwesome;
    }



    input.seller-star:checked~label.seller-star:before {
        content: '\f005';
        color: #FD4;
        transition: all .25s;
    }

    input.seller-star-5:checked~label.seller-star:before {
        color: rgb(255, 236, 96);
    }

    input.seller-star-1:checked~label.seller-star:before {
        color: #F62;
    }

    label.seller-star:hover {
        transform: rotate(-15deg) scale(1.3);
    }

    label.seller-star:before {
        content: '\f006';
        font-family: FontAwesome;
    }
</style>
@endsection

@section('content')

<div class="container mt-4">
    <h3>Finish Order</h3>
    <hr width="100px" size="7px" />

    <div class="row">
        <div class="col-md-4">
            <form action="{{ route('order.addReview') }}" method="POST">
                @csrf
                <div class="form-floating mb-2">
                    <textarea id="review" name="review" style="height: 120px"
                        class="form-control @error('review') is-invalid @enderror"
                        placeholder="review">{{ old('review') }}</textarea>
                    <label for="review">
                        @error('review')
                        <strong class="text-danger">{{ $message }}</strong>
                        @else
                        Write your review
                        @enderror
                    </label>
                </div>

                <p class="mb-1">Rating for this service</p>
                @error('rating')
                <p class="text-danger mb-1">{{ $message }}</p>
                @enderror
                <div class="card mb-3" style="border-radius: 10px">
                    <div class="card-body p-0">
                        <div class="stars">
                            <input class="star star-5" id="star-5" type="radio" name="rating" value="5" />
                            <label class="star star-5" for="star-5"></label>
                            <input class="star star-4" id="star-4" type="radio" name="rating" value="4" />
                            <label class="star star-4" for="star-4"></label>
                            <input class="star star-3" id="star-3" type="radio" name="rating" value="3" />
                            <label class="star star-3" for="star-3"></label>
                            <input class="star star-2" id="star-2" type="radio" name="rating" value="2" />
                            <label class="star star-2" for="star-2"></label>
                            <input class="star star-1" id="star-1" type="radio" name="rating" value="1" />
                            <label class="star star-1" for="star-1"></label>
                        </div>
                    </div>
                </div>

                <p class="mb-1">Rating for the store</p>
                @error('store_rating')
                <p class="text-danger mb-1">{{ $message }}</p>
                @enderror
                <div class="card mb-3" style="border-radius: 10px">
                    <div class="card-body p-0">
                        <div class="stars">
                            <input class="seller-star seller-star-5" id="seller-star-5" type="radio" name="store_rating"
                                value="5" />
                            <label class="seller-star seller-star-5" for="seller-star-5"></label>
                            <input class="seller-star seller-star-4" id="seller-star-4" type="radio" name="store_rating"
                                value="4" />
                            <label class="seller-star seller-star-4" for="seller-star-4"></label>
                            <input class="seller-star seller-star-3" id="seller-star-3" type="radio" name="store_rating"
                                value="3" />
                            <label class="seller-star seller-star-3" for="seller-star-3"></label>
                            <input class="seller-star seller-star-2" id="seller-star-2" type="radio" name="store_rating"
                                value="2" />
                            <label class="seller-star seller-star-2" for="seller-star-2"></label>
                            <input class="seller-star seller-star-1" id="seller-star-1" type="radio" name="store_rating"
                                value="1" />
                            <label class="seller-star seller-star-1" for="seller-star-1"></label>
                        </div>
                    </div>
                </div>


                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <input type="hidden" name="price" value="{{ $order->price }}">
                <button type="submit" class="btn def-button">Submit</button>
            </form>
        </div>

        <div class="col-md-8">
            <div class="card br-card def-shadow mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-4 order-2 order-md-1">
                            <p class="badge bg-primary">
                                {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}
                            </p>
                            <p class="badge bg-warning">
                                {{ \Carbon\Carbon::parse($order->created_at)->format('h:i')}}</p>
                            <p style="font-size: 13px; margin-bottom: 10px">Order ID: {{ $order->id }}</p>
                            <h5>{{ $order->service->service_name }}</h5>
                            <p class="mb-0">Store: <span
                                    style="font-weight: bold">{{ $order->seller->store_name }}</span></p>
                            <p class="mb-2">Seller Name: <span
                                    style="font-weight: bold">{{ $order->seller->user->name }}</span>
                            </p>
                        </div>
                        <div class="col-6 col-md-3 order-4 order-md-2 d-flex">

                            <h5 class="my-auto" style="color: #05be70">Rp. {{ $order->price }}</h5>

                        </div>
                        <div class="col-6 col-md-3 order-1 order-md-3">
                            <img style="height: 150px; width: 150px; object-fit: contain; object-position: center; background-color: gainsboro"
                                src="{{ asset('img/uploads/'. $order->service->photo) }}" alt="">
                        </div>
                        <div class="col-6 col-md-2 order-3 order-md-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection