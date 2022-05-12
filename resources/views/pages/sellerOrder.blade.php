@extends('layouts.master')

@section('title', 'Orders |')

@section('content')
<div class="container mt-4">
    <h3>Orders</h3>
    <hr width="100px" size="7px" />

    <div class="row">
        <div class="col-md-3">
            <div class="card shadow mb-2" style="border-radius: 10px; overflow: hidden;">
                <div class="card-header">Filter Status</div>
                <a class="dropdown-item py-2" href="{{ route('myStore.orders') }}">
                    All
                </a>
                <a class="dropdown-item py-2" href="{{ route('myStore.ordersFilter', ['status' => 'Waiting']) }}">
                    Waiting
                </a>
                <a class="dropdown-item  py-2" href="{{ route('myStore.ordersFilter', ['status' => 'Accepted']) }}">
                    Accepted
                </a>
                <a class="dropdown-item  py-2" href="{{ route('myStore.ordersFilter', ['status' => 'In Process']) }}">
                    In Process
                </a>
                <a class="dropdown-item  py-2" href="{{ route('myStore.ordersFilter', ['status' => 'Done']) }}">
                    Done
                </a>
                <a class="dropdown-item  py-2" href="{{ route('myStore.ordersFilter', ['status' => 'Completed']) }}">
                    Completed
                </a>
            </div>
        </div>

        <div class="col-md-9">
            @forelse ($orders as $item)

            <div class="card shadow mb-2" style="border-radius: 10px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-4 order-2 order-md-1">
                            <p class="badge bg-primary">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}
                            </p>
                            <p class="badge bg-warning">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('h:i')}}</p>
                            <p style="font-size: 13px; margin-bottom: 5px">Order ID: {{ $item->id }}</p>
                            <h5>{{ $item->service->service_name }}</h5>
                            <p class="mb-1" style="font-weight: bold">Note: {{ $item->note ?? '-'}}</p>
                            <p class="mb-0" style="font-size: 15px">Buyer: {{ $item->buyer->name }}</p>
                            <p class="mb-0" style="font-size: 15px">Email: {{ $item->buyer->email }}</p>
                        </div>
                        <div class="col-6 col-md-3 order-4 order-md-2 d-flex">

                            <h5 class="my-auto" style="color: #05be70">Rp. {{ $item->price }}</h5>

                        </div>
                        <div class="col-6 col-md-3 order-1 order-md-3">
                            <img style="height: 150px; width: 150px; object-fit: contain; object-position: center; background-color: gainsboro"
                                src="{{ asset('img/uploads/'. $item->service->photo) }}" alt="">
                        </div>
                        <div class="col-6 col-md-2 order-3 order-md-4">
                            @if (Str::lower($item->status) == 'waiting')
                            <button class="btn btn-danger mb-md-2 ms-auto" data-bs-toggle="modal"
                                data-bs-target="#orderModal" data-bs-text="decline" data-bs-orderId="{{$item->id}}"
                                data-bs-whatever="Declined">Decline</button>
                            <button class="btn btn-success mb-md-2 ms-auto" data-bs-toggle="modal"
                                data-bs-target="#orderModal" data-bs-text="accept" data-bs-orderId="{{$item->id}}"
                                data-bs-whatever="Accepted">Accept</button>

                            @elseif(Str::lower($item->status) == 'accepted')
                            <button class="btn btn-warning disabled mb-md-2 ms-auto">{{$item->status}}</button>
                            <button class="btn btn-primary mb-md-2 ms-auto" data-bs-toggle="modal"
                                data-bs-target="#orderModal" data-bs-text="process" data-bs-orderId="{{$item->id}}"
                                data-bs-whatever="In Process">Set Process</button>

                            @elseif(Str::lower($item->status) == 'in process')
                            <button class="btn btn-warning disabled mb-md-2 ms-auto">{{$item->status}}</button>
                            <button class="btn btn-primary mb-md-2 ms-auto" data-bs-toggle="modal"
                                data-bs-target="#orderModal" data-bs-text="finish" data-bs-orderId="{{$item->id}}"
                                data-bs-whatever="Done">Set to Done</button>

                            @else
                            <button class="btn btn-warning disabled mb-md-2 ms-auto">{{$item->status}}</button>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            @empty
            <h3>No Data</h3>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="orderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('myStore.orderStatus') }}" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h5 id="modalLabel" class="modal-title" style="text-transform: capitalize">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="order_id" id="inputId">
                    <input type="hidden" name="status" id="inputStatus">
                    <p id="modal-text" class="text-center mb-0"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-warning">Yes!</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var modal = document.getElementById('orderModal')
    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var status = button.getAttribute('data-bs-whatever')
        var text = button.getAttribute('data-bs-text')
        var orderId = button.getAttribute('data-bs-orderId')
        var modalTitle = modal.querySelector('.modal-title')
        var modalText = modal.querySelector('#modal-text')
        var modalInputId = modal.querySelector('#inputId')
        var modalInputStatus = modal.querySelector('#inputStatus')

        modalInputId.value = orderId;
        modalInputStatus.value = status;
        modalText.textContent =  'Are you sure want to '+ text +' this order?'
        modalTitle.textContent =  text +' confirmation'
    })
</script>

@endsection