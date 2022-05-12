@extends('layouts.master')

@section('title', "My Store |")

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
</style>
@endsection

@section('content')

<div class="container mt-4">

    <div id="header" class="mb-4">
        <img id="img-header" src="{{ asset('img/header/'.$seller->header_photo) }}" alt="">

        <div id="header-content">
            <h1 style="color: white">{{ $seller->store_name }}</h1>
        </div>
    </div>

    @if (session()->has('message'))
    <div class="alert alert-{{Session::get('type', 'info')}} alert-dismissible fade show d-flex align-items-center"
        role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
            class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
            aria-label="Success:">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </svg>
        <div>
            {{Session::get('message')}}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row mb-5">
        <div class="col-md-3">
            <div class="card br-card def-shadow mb-4">
                <div class="card-header">Store Settings</div>

                <ul class="nav">
                    <a class="dropdown-item py-2" href="{{ route('seller.show', ['seller' => $seller->id]) }}">
                        View Store
                    </a>
                    <a class="dropdown-item py-2" href="{{ route('myStore.orders') }}">
                        Order List
                    </a>
                    <a class="dropdown-item  py-2" href="{{ route('myStore.addService') }}">
                        Add service
                    </a>
                    <a class="dropdown-item  py-2" href="{{ route('myStore.edit') }}">
                        Edit Store
                    </a>
                    <a class="dropdown-item  py-2" href="{{ route('myStore.statistic') }}">
                        Statistic
                    </a>
                </ul>
            </div>

            <div class="card br-card def-shadow mb-4">
                <div class="card-header">
                    Store Rating
                </div>
                <div class="card-body">
                    <h2 class="text-center mb-0" style="color: #f4473e"">{{$sellerRating ?? '-'}}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card def-shadow mb-4" style="border-left-width: 5px; border-left-color: #f4473e"">
                <div class="card-body">
                    <h4>About</h4>
                    <p>{{ $seller->about }}</p>
                </div>
            </div>
            <div class="card br-card def-shadow">
                <div class="card-body">
                    <h4>Your Service</h4>
                    <hr width="100px" size="7px" />

                    <div class="table-responsive">
                        <table class="table table-striped table-hove br-card">
                            <thead style="background: #f4473e; color: white">
                                <th>No.</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Sold</th>
                                <th>Rating</th>
                                <th style="text-align: center">Action</th>
                            </thead>
                            <tbody>
                                @if (isset($services))
                                @forelse ($services as $item)

                                @php
                                $order = $item->order;
                                $ratings = array();
                                foreach ($order as $itemOrder) {
                                $sale = $itemOrder->sale;
                                if($sale){
                                array_push($ratings, $sale->rating);
                                }
                                }
                                $averageRating = null;
                                if(count($ratings)) {
                                $averageRating = array_sum($ratings)/count($ratings);
                                }
                                @endphp

                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>{{$item->service_name}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->category->category_name}}</td>
                                    <td>{{$item->sold}}</td>
                                    <td>{{$averageRating ?? '-'}}</td>
                                    <td style="text-align: center"><a
                                            href="{{ route('myStore.editService', ['service' => $item->id]) }}"
                                            class="btn btn-warning">Edit</a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#confirmModal" data-bs-id="{{ $item->id }}">Delete</button>
                                    </td>
                                </tr>
                                @empty
                                <h4 class="mb-3 text-center">No Service Yet...</h4>
                                @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="labelModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('myStore.deleteService') }}" method="POST">
                @method('DELETE')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="labelModal">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure want to delete this item?</p>
                    <input id="inputId" type="hidden" name="id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function($){
        let headerWidth = document.getElementById('header').offsetWidth;
        $('#header').css('height', headerWidth / 3)
    });

    window.onresize = function(event) {
        let headerWidth = document.getElementById('header').offsetWidth;
        $('#header').css('height', headerWidth / 3)
    };

    var confirmModal = document.getElementById('confirmModal')
        confirmModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget

        var id = button.getAttribute('data-bs-id')
        
        var input = confirmModal.querySelector('#inputId')

        input.value = id
    })
</script>
@endsection