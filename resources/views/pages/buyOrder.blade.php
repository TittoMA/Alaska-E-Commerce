@extends('layouts.master')

@section('title', 'Orders |')

@section('content')
<div class="container mt-4">

    <div class="row">
        <div class="col-md-3">
            <div class="card def-shadow br-card mb-2 ">
                <div class="card-header">Status</div>
                <a class="dropdown-item py-2" style="font-size: 14px" href="{{ route('order.index') }}">
                    All
                </a>
                <a class="dropdown-item py-2" style="font-size: 14px"
                    href="{{ route('order.filter', ['status' => 'waiting']) }}">
                    Waiting
                </a>
                <a class="dropdown-item py-2" style="font-size: 14px"
                    href="{{ route('order.filter', ['status' => 'accepted']) }}">
                    Accepted
                </a>
                <a class="dropdown-item py-2" style="font-size: 14px"
                    href="{{ route('order.filter', ['status' => 'in process']) }}">
                    In Process
                </a>
                <a class="dropdown-item py-2" style="font-size: 14px"
                    href="{{ route('order.filter', ['status' => 'done']) }}">
                    Done
                </a>
            </div>
        </div>

        <div class="col-md-9">
            <h4 class="my-3">Order List</h4>
            <div class="card br-card">
                <div class="card-body p-4">

                    @forelse ($orders as $item)

                    <div class="card br-card def-shadow mb-2">
                        <div class="card-body">
                            <div style="display: flex; align-items: center; margin-bottom: 10px;">
                                <p style="font-size: 13px; margin-bottom: 0">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y')}}
                                </p>

                                <p class="badge bg-warning ms-2" style="font-size: 12px; margin-bottom: 0">
                                    {{$item->status}}
                                </p>

                            </div>
                            <div class=" row">
                                <div class="col-md-6">
                                    <div class="mb-2 mb-md-0" style="display: flex">
                                        <div style="width: 85px; height: 85px; border-radius: 10px; overflow: hidden">
                                            <img style="height: 100%; width: 100%; object-fit: contain; object-position: center"
                                                src="{{ asset('/img/uploads/'.$item->service->photo)}}" alt="">
                                        </div>

                                        <div class="ms-3">
                                            <p style="font-size: 13px; margin-bottom: 5px">Order ID: {{ $item->id }}</p>
                                            <h6><a
                                                    href="{{ url("service/$item->id")}}">{{ $item->service->service_name }}</a>
                                            </h6>
                                            <p class="mb-1" style="font-size: 13px;"><i class="bi bi-shop me-1"
                                                    style="color: orange"></i>{{ $item->seller->store_name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p class="mb-1" style="font-size: 14px">Order Time</p>
                                    <p class="badge bg-info mb-1">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('h:i') }}</p>

                                </div>
                                <div class="col-md-3">
                                    <p class="mb-1" style="font-size: 15px">Total: </p>
                                    <h5 style="color: #05be70">Rp. {{ $item->price }}</h5>
                                </div>
                            </div>

                            @if (Str::lower($item->status) == 'done')
                            <div style="display: flex">
                                <a href="{{ route('order.completion', ['order' => $item->id]) }}"
                                    class="btn def-button mt-3 ms-auto" style="font-size: 13px">Finish and
                                    Review</a>
                            </div>
                            @endif
                        </div>
                    </div>

                    @empty
                    <h5>No Data</h5>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection