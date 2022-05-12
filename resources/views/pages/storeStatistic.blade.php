@extends('layouts.master')

@section('title', "My Store Statistic |")

@section('content')
<div class="container mt-4">
    <h3>Store Statistic</h3>
    <hr width="100px" size="7px" />

    <div class="row g-2">
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card shadow mb-3" style="border-radius: 10px">
                <div class="card-body">
                    <h5 class="card-title">Store Rating</h5>

                    <h5 style="color: #f4473e">{{ $sellerRating ?? '-' }}</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card shadow mb-3" style="border-radius: 10px">
                <div class="card-body">
                    <h5 class="card-title">Total Sold</h5>

                    <h5 style="color: #f4473e"">{{ $totalSold ?? '-' }}</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card shadow mb-3" style="border-radius: 10px">
                <div class="card-body">
                    <h5 class="card-title">Total Income</h5>

                    <h5 style="color: #f4473e"">Rp. {{ $totalIncome ?? '-' }}</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card shadow mb-3" style="border-radius: 10px">
                <div class="card-body">
                    <h5 class="card-title">Total Service</h5>

                    <h5 style="color: #f4473e"">{{ count($seller->service) }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection