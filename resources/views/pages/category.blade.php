@extends('layouts.master')

@section('title', 'Category |')
@section('menuCategory', 'active')

@section('head')
<link href="{{ asset('/css/kategori.css') }}" rel="stylesheet">

<style>
    .img-wrap {
    text-align: center;
    display: block;
}

.img-wrap img {
    max-width: 100%;
}

.padding-y {
    padding-top: 32px;
    padding-bottom: 32px;
}

.list-lg li {
    margin-bottom: 10px;
}

.card-product {
    border-radius: 10px;
    margin-bottom: 1rem;
    /* btn-overlay-bottom */
}

.card-product:after {
    content: "";
    display: table;
    clear: both;
    visibility: hidden;
}

.card-product .img-wrap {
    border-radius: 0.2rem 0.2rem 0 0;
    overflow: hidden;
    position: relative;
    height: 220px;
    text-align: center;
}

.card-product .img-wrap img {
    max-height: 100%;
    max-width: 100%;
    width: auto;
    display: inline-block;
    -o-object-fit: cover;
    object-fit: cover;
}

.card-product .action-wrap {
    padding-top: 4px;
    margin-top: 4px;
}

.card-product:hover {
    -webkit-box-shadow: 0 4px 15px rgba(153, 153, 153, 0.3);
    box-shadow: 0 4px 15px rgba(153, 153, 153, 0.3);
    -webkit-transition: 0.5s;
    transition: 0.5s;
}

.price-new,
.price {
    margin-right: 5px;
}

.price-old {
    color: #999;
}

.icon-action {
    margin-top: 5px;
    float: right;
    font-size: 80%;
}

.card-header .title {
    margin-bottom: 0;
    line-height: 1.5;
}

.card-group-item {
    border-bottom: 1px solid #dee2e6;
}

.card-group-item .card-header {
    border-bottom: 0;
    background-color: #f9f9f9;
}

.card-group-item:last-child {
    border-bottom: 0;
}

/* ================= RATINGS ============== */
.label-rating {
    margin-right: 10px;
    display: inline-block;
    vertical-align: middle;
}
/* rating-list */
.rating-stars {
    margin-right: 10px;
    display: inline-block;
    vertical-align: middle;
    list-style: none;
    margin: 0;
    padding: 0;
    position: relative;
    line-height: 1;
    white-space: nowrap;
    clear: both;
}
.rating-stars i {
    font-size: 14px;
    color: #ccc;
    display: inline;
}
.rating-stars li {
    display: block;
    text-overflow: clip;
    white-space: nowrap;
    z-index: 1;
}
.rating-stars li.stars-active {
    z-index: 2;
    position: absolute;
    top: 0;
    left: 0;
    overflow: hidden;
}
.rating-stars li.stars-active i {
    color: orange;
}

</style>
@endsection

@section('content')

<section class="padding-y">
    <div class="container">

        <div class="row">
            <div class="col-sm-3">

                <form class="pb-3">
                    <div class="input-group">
                        <input class="form-control" style="border-radius: 25px" id="searchInput" placeholder="Search"
                            type="search">
                        <div class="input-group-append">
                            <button class="btn def-button ms-1" type="button" id="searchBtn"><i
                                    class="fa fa-search"></i></button>
                        </div>

                    </div>
                </form>

                <div class="card br-card def-shadow mb-4">
                    <article class="card-group-item">
                        <header class="card-header">
                            <a class="" aria-expanded="true" href="#" data-toggle="collapse" data-target="#collapse22">
                                <i class="icon-action fa fa-chevron-down"></i>
                                <h6 class="title">By Category</h6>
                            </a>
                        </header>

                        <div class="filter-content collapse show" id="collapse22">
                            <div class="card-body">
                                <ul class="list-unstyled list-lg">
                                    @forelse ($categories as $item)
                                    <li><a href="{{ url('category/'. $item->category_name) }}" class="mb-0">
                                            {{ $item->category_name }}</a>
                                    </li>
                                    @empty
                                    <li><a href="#"> # <span class="float-right badge badge-light round">142</span> </a>
                                    </li>
                                    @endforelse
                                </ul>
                            </div>
                            <!-- card-body.// -->
                        </div>
                        <!-- collapse .// -->
                    </article>
                    <div class="card">
                        <article class="card-group-item">
                            <header class="card-header">
                                <a aria-expanded="true" href="{{ route('sort.lowPrice') }}" data-toggle="collapse"
                                    data-target="#collapse22">
                                    <h6 class="title">Sort By Lowest Price</h6>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="card">
                        <article class="card-group-item">
                            <header class="card-header">
                                <a class="" aria-expanded="true" href="{{ route('sort.highPrice') }}"
                                    data-toggle="collapse" data-target="#collapse22">
                                    <h6 class="title">Sort By Highest Price</h6>
                                </a>
                            </header>
                        </article>
                    </div>
                </div>
            </div>
            <!-- col.// -->
            <main class="col-sm-9">
                @forelse ($services as $item)

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

                <article class="card card-product def-shadow">
                    <div class="card-body">
                        <div class="row">
                            <aside class="col-sm-3">
                                <div class="img-wrap mb-3 mb-md-0"><img style="height: 100%; width: 100%; object-fit: cover; object-position: center;" src="{{ asset('/img/uploads/'.$item->photo)}}">
                                </div>
                            </aside>
                            <!-- col.// -->
                            <article class="col-sm-6">
                                <h4 class="title"> {{$item->service_name}} </h4>
                                <div class="rating-wrap mb-2">
                                    <p class="mb-2" style="font-size: 14px">
                                        <span class="badge rounded-pill bg-warning me-1"
                                            style="font-size: 13px">{{$averageRating ?? '-'}}</span>
                                        @for ($i = 0; $i < floor($averageRating); $i++) <i class="bi bi-star-fill"
                                            style="color: orange"></i>
                                            @endfor

                                            @for ($i = 0; $i < (5 - ((floor(5 - $averageRating)) +
                                                floor($averageRating)) ); $i++) <i class="bi bi-star-half"
                                                style="color: orange"></i></i>
                                                @endfor


                                                @for ($i = 0; $i < floor(5 - $averageRating); $i++) <i
                                                    class="bi bi-star-fill" style="color: gainsboro"></i>
                                                    @endfor
                                    </p>
                                    <p style="font-size: 14px;">{{$item->sold}} Sold </p>
                                </div>
                                <!-- rating-wrap.// -->
                                <p> {{$item->description}} </p>
                            </article>
                            <!-- col.// -->
                            <aside class=" col-sm-3 border-left">
                                <div class="action-wrap">
                                    <div class="price-wrap h4">
                                        <span class="price"> Rp. {{$item->price}} </span>
                                    </div>
                                    <!-- info-price-detail // -->
                                    <br>
                                    <a href="{{ url("service/$item->id")}}" class="btn def-button"
                                        style="font-size: 16px">
                                        Detail</a>
                                </div>
                                <!-- action-wrap.// -->
                            </aside>
                            <!-- col.// -->
                        </div>
                        <!-- row.// -->
                    </div>
                    <!-- card-body .// -->
                </article>
                <!-- card product .// -->

                @empty
                <h3>No Data</h3>
                @endforelse
            </main>
            <!-- col.// -->
        </div>
    </div>
    <!-- container .//  -->
</section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $("#searchBtn").click(function() {
            let search =$("#searchInput").val();
            document.location = "/search/" + search;
        })
    })
</script>
@endsection