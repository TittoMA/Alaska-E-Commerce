@extends('layouts.master')

@section('title', 'Order |')

@section('content')

<div class="container mt-4">
    <h5 class="mb-3">Order Confirmation</h5>
    <div class="row g-2">
        <div class="col-md-5">
            <div class="card br-card def-shadow mb-3">
                <div class="card-body">
                    <div style="display: flex">
                        <div style="width: 150px; height: 150px; border-radius: 10px; overflow: hidden">
                            <img style="height: 100%; width: 100%; object-fit: contain; object-position: center"
                                src="{{ asset('/img/uploads/'.$service->photo)}}" alt="">
                        </div>

                        <div class="ms-3">
                            <h5>{{$service->service_name}}</h5>
                            <p class="mb-0" style="font-size: 14px"><i class="bi bi-shop me-1"
                                    style="color: orange"></i>
                                {{$service->seller->store_name}}</p>
                            <p class="mb-2" style="font-size: 14px"><i class="bi bi-clock-fill me-1"
                                    style="color: orange"></i>
                                Estimated Time:
                                <span
                                    style="font-weight: bold; font-size: 16px; color: orange">{{$service->duration}}</span>
                            </p>
                            <p class="mb-0" style="font-weight: bold">Total: </p>
                            <h4 style="color: #05be70">Rp. {{$service->price}}</h4>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-7">
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <textarea id="note" name="note" style="height: 120px"
                        class="form-control @error('note') is-invalid @enderror"
                        placeholder="note">{{ old('note') }}</textarea>
                    <label for="note">
                        @error('note')
                        <strong class="text-danger">{{ $message }}</strong>
                        @else
                        note for seller...
                        @enderror
                    </label>
                </div>

                <input type="hidden" name="service_id" value="{{$service->id}}">
                <input type="hidden" name="seller_id" value="{{$service->seller->id}}">
                <input type="hidden" name="price" value="{{$service->price}}">
                <button type="submit" class="btn def-button d-block ms-auto"><i
                        class="bi bi-check-circle-fill me-2"></i> Order!</button>
            </form>
        </div>
    </div>
</div>
@endsection